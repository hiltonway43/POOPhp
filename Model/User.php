<?php
require_once('Config/Conection.php');
class User
{
    private $userId;
    private $userDoc;
    private $userName;
    private $userRol;
    private $userEmail;
    private $userPassword;
    private $userActive;

    function __construct() { }


    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function getUserId()
    {
        return $this->userId;
    }


    public function setUserDoc($userDoc)
    {
        $this->userDoc = $userDoc;
    }

    public function getUserDoc()
    {
        return $this->userDoc;
    }


    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserRol($userRol)
    {
        $this->userRol = $userRol;
    }
    public function getUserRol()
    {
        return $this->userRol;
    }

    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    }
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function setUserActive($userActive)
    {
        if (strcmp($userActive, 'on') == 0) {
            $this->userActive == 1;
        } elseif (strcmp($userActive, '1') == 0) {
            $this->userActive == 'checked';
        } elseif (strcmp($userActive, '0') == 0) {
            $this->userActive = 0;
        } else {
            $this->userActive = 0;
        }
    }
    public function getUserActive()
    {
        return $this->userActive;
    }


    public static function insert($user)
    {

        try {
            $db = Db::getConnect();
            $insert = $db->prepare('INSERT INTO usuario VALUES(:id, :doc, :usu, :rol, :email, :contrasena, :activo)');
            $insert->bindValue(':id', $user->getUserId());
            $insert->bindValue(':doc', $user->getUserDoc());
            $insert->bindValue(':usu', $user->getUserName());
            $insert->bindValue(':rol', $user->getUserRol());
            $insert->bindValue(':email', $user->getUserEmail());
            $insert->bindValue(':contrasena', $user->getUserPassword());
            $insert->bindValue(':activo', $user->getUserActive());
            $insert->execute();
        } catch (Exception $e) {
            echo 'Error: ', $e->getMessage();
        }

        /* $insert->execute( array(
            ':doc' => $user->getUserDoc(),
            ':usu' => $user->getUserName(),
            ':rol'  => $user->getUserRol(),
            ':email'  => $user->getUserEmail(),
            ':contrasena'  => $user->getUserPassword(),
            ':activo'  => $user->getUserActive()
           ));*/
    }

    public static function show()
    {
        $db = Db::getConnect();
        $listUsers = [];
        $show = $db->query('SELECT * FROM usuario');
        foreach ($show->fetchAll() as $user) {
            $users = new User();
            $users->setUserId($user['id']);
            $users->setUserDoc($user['ndoc']);
            $users->setUserName($user['name']);
            $users->setUserRol($user['rol']);
            $users->setUserEmail($user['email']);
            $users->setUserPassword($user['password']);
            $users->setUserActive($user['activo']);
            //$user['ndoc'], $user['usuario'], $user['rol'], $user['email'], $user['contrasena'], $user['activo']);
            $listUsers[] = $users;
        }
        return $listUsers;
    }

    public static function select($id)
    {
        $db = Db::getConnect();
        $listUsers = [];
        $select = $db->query('SELECT * FROM usuario WHERE id=:id');
        $select->bindValue(':id', $id);
        foreach ($select->fetchAll() as $user) {
            $users = new User();
            $users->setUserId($user['id']);
            $users->setUserDoc($user['ndoc']);
            $users->setUserName($user['name']);
            $users->setUserRol($user['rol']);
            $users->setUserEmail($user['email']);
            $users->setUserPassword($user['password']);
            $users->setUserActive($user['activo']);
            //  $users = new User($user['id'], $user['ndoc'], $user['usuario'], $user['rol'], $user['email'], $user['contrasena'], $user['activo']);
            $listUsers[] = $users;
        }
        return $listUsers;
    }

    public static function delete($id)
    {
        $db = Db::getConnect();
        $delete = $db->prepare('DELETE FROM usuario WHERE ndoc=:ndoc');
        $delete->bindValue(':ndoc', $id);
        $delete->execute();
    }

    public static function find($id)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT * FROM usuario WHERE ndoc=:ndoc');
        $select->bindValue(':id', $id);
        $select->execute();
        $user = $select->fetch();
        //$user = new User($user['id'], $user['ndoc'], $user['usuario'], $user['rol'], $user['email'], $user['contrasena'], $user['activo']);
        $users = new User();
        $users->setUserId($user['id']);
        $users->setUserDoc($user['ndoc']);
        $users->setUserName($user['name']);
        $users->setUserRol($user['rol']);
        $users->setUserEmail($user['email']);
        $users->setUserPassword($user['password']);
        $users->setUserActive($user['activo']);
        return $users;
    }

    public static function update($user)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE usuario SET usuario=:usu, rol=:rol ,email=:email, contrasena=:contrasena, activo=:activo  WHERE ndoc=:id');
        $update->bindValue(':id', $user->getUserDoc());
        $update->bindValue(':usu', $user->getUserName());
        $update->bindValue(':rol', $user->getUserRol());
        $update->bindValue(':email', $user->getUserEmail());
        $update->bindValue(':contrasena', $user->getUserPassword());
        $update->bindValue(':activo', $user->getUserActive());
        $update->execute();
    }
}
