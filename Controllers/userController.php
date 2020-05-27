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
        $user = new User();
        $_POST['id']=NULL;
        $user->setUserId($_POST['id']);
        $user->setUserDoc($_POST['ndoc']);
        $user->setUserName($_POST['name']);
        $user->setUserRol($_POST['rol']);
        $user->setUserEmail($_POST['email']);
        $user->setUserPassword($_POST['password']);
        $user->setUserActive($_POST['activo']);
        User::insert($user);

        // $this->Show();
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
        $alumno = User::find($id);
        require_once('Views/');
    }

    function Update()
    {
        $user = new User($_POST['id'], $_POST['ndoc'], $_POST['name'], $_POST['rol'], $_POST['email'], $_POST['cpassword'], $_POST['active']);
        User::update($user);
        $this->Show();
    }
    function Delete()
    {
        $id = $_GET['id'];
        User::delete($id);
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
