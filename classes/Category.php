<?php
require_once "Database.php";
class Category extends Database
{
    //create categories
    public function createCategory($categoryname)
    {
        $sql = "SELECT * FROM category WHERE category_name = '$categoryname'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        if ($result->num_rows >= 1) {
            $msg = "<div class='alert alert-danger' role='alert'>This category exists already!</div>";
            $_SESSION['msg'] = $msg;
            header("location:create_c.php");
        } else {
            $sql = "INSERT INTO category(category_name) VALUES('$categoryname')";
            $result = $this->conn->query($sql);
            if ($result) {
                header("location:category.php");
            } else {
                die("Conection error: " . $this->conn->connect_error);
            }
        }
    }
    //get all categories
    public function getCategory()
    {
        $sql = "SELECT * FROM category ";
        $result = $this->conn->query($sql) or die("Conection error: " . $this->conn->connect_error);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    //get specific category
    public function getSpecificCategory($id)
    {
        $sql = "SELECT * FROM category WHERE category_id = $id";
        $result = $this->conn->query($sql) or die("Conection error: " . $this->conn->connect_error);
        $row = $result->fetch_assoc();
        return $row;
    }
    //edit category
    public function editCategory($newcategory,$id)
    {
        $sql = "UPDATE category SET category_name = '$newcategory' WHERE category_id = $id";
        $result = $this->conn->query($sql);
        if ($result) {
            header("location:category.php");
        } else {
            die("Conection error: " . $this->conn->connect_error);
        }
    }
    //delete admin
    public function deleteCategory($id){
        $sql = "DELETE FROM category WHERE category_id = $id";
        $result = $this->conn->query($sql);
        if($result){
            header("location:category.php");
        }else{
            die("Conection error: " . $this->conn->connect_error);
        }
    }
}
