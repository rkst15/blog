<?php
require_once "Database.php";
class User extends Database
{
    //create users
    public function createUser($username, $password, $confirm, $email, $firstname, $lastname, $status)
    {
        if ($password != $confirm) {
            $msg = "<div class='alert alert-danger' role='alert'>Confirm password is different from Password !</div>";
            $_SESSION['msg'] = $msg;
            header("location:create.php");
        } else {
            $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows >= 1) {
                $msg = "<div class='alert alert-danger' role='alert'>This username or email exists already!</div>";
                $_SESSION['msg'] = $msg;
                header("location:create.php");
            } else {
                $newpass = md5($password);
                $sql = "INSERT INTO users(username,email,password,status) VALUES('$username', '$email', '$newpass', '$status')";
                $result = $this->conn->query($sql);
                if ($result) {
                    $id = mysqli_insert_id($this->conn);
                    $sql = "INSERT INTO profile(user_id,firstname,lastname) VALUES('$id','$firstname','$lastname')";
                    $result = $this->conn->query($sql);
                    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>New account is created successfully!</div>";
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    if ($status == "admin") {
                        header("location:home_a.php");
                    } else {
                        header("location:home_u.php");
                    }
                } else {
                    die("Conection error: " . $this->conn->connect_error);
                }
            }
        }
    }

    //login users
    public function loginUser($useremail, $password, $status)
    {
        $newpass = md5($password);
        $sql = "SELECT * FROM users WHERE username = '$useremail' OR email = '$useremail' AND password = '$newpass' AND status = '$status'";
        $result = $this->conn->query($sql) or die("Conection error: " . $this->conn->connect_error);
        $row = $result->fetch_assoc();
        if ($result->num_rows === 1) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['username'] = $row['user_id'];
            if ($status == "admin") {
                header("location:home_a.php");
            } else {
                header("location:home_u.php");
            }
        } else {
            header("location:login.php");
        }
    }
    //get all users
    public function getUser()
    {
        $sql = "SELECT * FROM users INNER JOIN profile ON users.user_id = profile.user_id";
        $result = $this->conn->query($sql) or die("Conection error: " . $this->conn->connect_error);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    //get specific user
    public function getSpecificUser($id)
    {
        $sql = "SELECT * FROM users WHERE user_id = $id";
        $result = $this->conn->query($sql) or die("Conection error: " . $this->conn->connect_error);
        $row = $result->fetch_assoc();
        return $row;
    }

    //edit admin
    public function editAdmin($newuser, $newemail, $id)
    {
        $sql = "UPDATE users SET username = '$newuser', email = '$newemail' WHERE user_id = $id";
        $result = $this->conn->query($sql);
        if ($result) {
            header("location:admin.php");
        } else {
            die("Conection error: " . $this->conn->connect_error);
        }
    }

    //delete admin
    public function deleteAdmin($id)
    {
        $sql = "DELETE FROM users WHERE user_id = $id";
        $result = $this->conn->query($sql);
        if ($result) {
            header("location:admin.php");
        } else {
            die("Conection error: " . $this->conn->connect_error);
        }
    }

}
