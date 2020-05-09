
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
            # code...
            break;
    }
    $controller->{$action}();
}

?>