<?php
    require_once "classes/User.php";
    session_start();
    $user = new User;
    $result = $user->getUser();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
<?php require_once "navbar_a.php"?>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email Adress</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Status</th>
                        <th><a href="create.php" class="btn btn-info btn-sm">Add New Admin</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($result as $key => $row){
                        $id = $row['user_id'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $status = $row['status'];
                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $username . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $firstname . "</td>";
                        echo "<td>" . $lastname . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=$id' class='btn btn-info'>Edit</a>";
                        echo "<a href='userAction.php?action=delete&id=$id' class='btn btn-danger'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>