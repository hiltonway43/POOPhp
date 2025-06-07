
<?php

$controllers = array(
    'user' => ['Index', 'Insert', 'Update', 'Delete', 'Find', 'Select', 'UpdateShow','Show', 'Register' ,'Error']
);

if (array_key_exists($controller,  $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('user', 'Error');
    }
} else {
    call('user', 'Error');
}

function call($controller, $action)
{
    require_once('Controllers/' . $controller . 'Controller.php');

    switch ($controller) {
        case 'user':
            require_once('Model/User.php');
            $controller = new userController();
            break;
        default:
            // If the requested controller is not 'user' (or any other recognized controller),
            // default to showing an error page via the userController.
            require_once('Controllers/userController.php');
            require_once('Model/User.php'); // Ensure User model is available for userController
            $controller = new userController();
            $action = 'error'; // Explicitly set action to 'error'
            break;
    }
    $controller->{$action}();
}

?>