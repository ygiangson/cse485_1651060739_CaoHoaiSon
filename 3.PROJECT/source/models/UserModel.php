<?php
require_once 'Model.php';
class UserModel extends Model
{
    public $connection;


    public function __construct()
    {
        $this->connection = $this->openConnect();
    }

    // get all user
    public function getAllUser()
    {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this ->connection, $sql);
        return $result;
    }

    //get user with role user
    public function getUsersWithRole($role)
    {
        $sql ="SELECT * FROM users WHERE role = '$role'";
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }

    // thêm người dùng
    public function addUserModel($username, $email, $role,$password,$activation_code, $status)
    {
        $sql = "INSERT INTO users (id, username, email, role, password, created_at, activation_code, status)
         VALUES (NULL, '$username', '$email', '$role', '$password', NOW(), '$activation_code', '$status')";
        return $result = mysqli_query($this -> connection,$sql);
    }
    // thêm admin
    public function addAdminModel($username, $email, $role,$password,$activation_code, $status)
    {
        $sql = "INSERT INTO users (id, username, email, role, password, created_at, activation_code, status)
         VALUES (NULL, '$username', '$email', '$role', '$password', NOW(), '$activation_code', '$status')";
         echo $sql;
        return $result = mysqli_query($this -> connection,$sql);
    }
    public function selectOnerUser($idUser)
    {
        $sql = "SELECT * FROM users WHERE id = $idUser";
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }
    public function updateUser($username,$email,$status,$role,$userID)
    {
        $sql = "UPDATE `users` 
                SET `username` = '$username', `email` = '$email', `status` = '$status', `role` = '$role'
                WHERE `users`.`id` = '$userID'";
                // echo $sql;
        $result = mysqli_query($this ->connection ,$sql);
        return $result;
    }
    public function deleteUser($idUser)
    {
        $sql = "DELETE FROM `users` WHERE `users`.`id` = $idUser";
        echo $sql;
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }


}