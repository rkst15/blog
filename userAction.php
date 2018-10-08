<?php
require_once "classes/User.php";
$user = new User;
session_start();
//create user
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $status = $_POST['status'];
    $user->createUser($username, $password,$confirm,$email, $firstname, $lastname, $status);
}

//login admin
elseif(isset($_POST['login'])){
    $useremail = $_POST['useremail'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $user->loginUser($useremail,$password,$status);
}

//edit admin
elseif(isset($_POST['edit'])){
    $newuser = $_POST['newuser'];
    $newemail = $_POST['newemail'];
    $id = $_POST['id'];
    $user->editAdmin($newuser,$newemail,$id);
}

//delete admin
elseif ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $user->deleteAdmin($id);
}
