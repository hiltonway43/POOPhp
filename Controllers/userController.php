<?php
class userController
{

    function __construct()
    {
    }

    function Index()
    {
        require_once('Views/User/login.php');
    }

    function Register()
    {
        require_once('Views/User/register.php');
    }

    function Insert()
    {
        $validation_errors = [];

        // Sanitize and Validate ndoc
        $ndoc = filter_input(INPUT_POST, 'ndoc', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($ndoc))) {
            $validation_errors[] = "Validation failed for field: ndoc - Reason: Required";
        }

        // Sanitize and Validate name
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($name))) {
            $validation_errors[] = "Validation failed for field: name - Reason: Required";
        }

        // Sanitize and Validate rol
        $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($rol))) {
            $validation_errors[] = "Validation failed for field: rol - Reason: Required";
        }
        // Add more specific rol validation if needed, e.g., checking against a list of valid roles.

        // Sanitize and Validate email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (empty(trim($email))) {
            $validation_errors[] = "Validation failed for field: email - Reason: Required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = "Validation failed for field: email - Reason: Invalid format";
        }

        // Sanitize and Validate password
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS); // Or FILTER_DEFAULT if no HTML special chars are expected
        if (empty($password)) { // Password can be empty if it's not being changed, but for insert it's usually required.
            $validation_errors[] = "Validation failed for field: password - Reason: Required";
        }

        // Sanitize and Validate activo
        $activo_raw = isset($_POST['activo']) ? $_POST['activo'] : '0'; // Default to '0' (inactive) if not present
        $activo = filter_var($activo_raw, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($validation_errors)) {
            foreach ($validation_errors as $error) {
                error_log($error);
            }
            return;
        }

        $user = new User();
        $user->setUserId(NULL);
        $user->setUserDoc($ndoc);
        $user->setUserName($name);
        $user->setUserRol($rol);
        $user->setUserEmail($email);
        $user->setUserPassword(password_hash($password, PASSWORD_DEFAULT));
        $user->setUserActive($activo);

        try {
            User::insert($user);
        } catch (Exception $e) {
            error_log("Error during user insertion: " . $e->getMessage());
        }
    }

    function Show()
    {
        $listUser = User::show();
        require_once('Views/');
    }


    function Select()
    {
        $id = $_GET['id'];
        $listUser = User::select($id);
        require_once('Views/');
    }

    function UpdateShow()
    {
        $id = $_GET['id'];
        $alumno = User::find($id); // Assumes $id here is ndoc
        require_once('Views/');
    }

    function Update()
    {
        $validation_errors = [];

        // Step 1: Get the identifier (ndoc) from POST data to find the existing user.
        // As per subtask: "assume `$_POST['id']` is indeed the document number (`ndoc`) that `User::find()` uses."
        $ndoc_to_find = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($ndoc_to_find))) {
            error_log("Update failed: Identifier 'id' (for ndoc) from POST is required to find the user.");
            // Consider redirecting or showing an error view
            return;
        }

        // Step 2: Fetch existing user
        $existingUser = User::find($ndoc_to_find);
        if (!$existingUser || !$existingUser->getUserId()) { // getUserId() should return the actual PK.
            error_log("Update failed: User with ndoc '{$ndoc_to_find}' not found.");
            // Consider redirecting or showing an error view
            return;
        }

        // Step 3: Sanitize and Validate all inputs from POST

        // Sanitize new ndoc (this is the value from the 'ndoc' field in the form)
        $new_ndoc_from_form = filter_input(INPUT_POST, 'ndoc', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($new_ndoc_from_form))) {
            $validation_errors[] = "Validation failed for field: ndoc - Reason: Required";
        }

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($name))) {
            $validation_errors[] = "Validation failed for field: name - Reason: Required";
        }

        $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($rol))) {
            $validation_errors[] = "Validation failed for field: rol - Reason: Required";
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (empty(trim($email))) {
            $validation_errors[] = "Validation failed for field: email - Reason: Required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = "Validation failed for field: email - Reason: Invalid format";
        }

        $password_from_form = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        // No validation for empty password here, as it's optional for update.

        $activo_raw = isset($_POST['activo']) ? $_POST['activo'] : (isset($_POST['active']) ? $_POST['active'] : '0');
        $activo = filter_var($activo_raw, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($validation_errors)) {
            foreach ($validation_errors as $error) {
                error_log($error);
            }
            // Optionally: set error message and redirect back to edit form.
            return;
        }

        // Step 4: Populate User object for update
        $user = new User();

        // Set the actual primary key from the existing user.
        // This is crucial if the model's update method is (or will be) changed to use the PK in WHERE clause.
        $user->setUserId($existingUser->getUserId());

        // Set the document number (potentially new).
        // The model's current User::update() uses this value in its WHERE clause.
        // This remains a point of concern if $new_ndoc_from_form is different from $ndoc_to_find.
        $user->setUserDoc($new_ndoc_from_form);

        $user->setUserName($name);
        $user->setUserRol($rol);
        $user->setUserEmail($email);
        $user->setUserActive($activo);

        // Step 5: Password logic using $existingUser
        if (!empty($password_from_form)) {
            $user->setUserPassword(password_hash($password_from_form, PASSWORD_DEFAULT));
        } else {
            $user->setUserPassword($existingUser->getUserPassword()); // Preserve old password hash
        }

        // Step 6: Try to update
        try {
            User::update($user);
            // Optionally: redirect to a success page or user list.
        } catch (Exception $e) {
            error_log("Error during user update: " . $e->getMessage());
            // Optionally: set error message and redirect back to edit form.
        }
    }

    function Delete()
    {
        $id = $_GET['id'];
        User::delete($id); // Assumes $id here is ndoc
        $this->Show();
    }

    function Find()
    {
        if (!empty($_POST['ndoc'])) {
            $id = $_POST['ndoc'];
            $user = User::find($id);
            $listaUsers[] = $user;

            require_once('Views/show.php');
        } else {
            $listaUsers = User::show();
            require_once('Views/User/show.php');
        }
    }

    function error()
    {
        require_once('Views/User/error.php');
    }
}
