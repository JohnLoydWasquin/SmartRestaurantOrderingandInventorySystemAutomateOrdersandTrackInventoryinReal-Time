<?php 

    include 'loginDB.php';

    if(isset($_POST['signUp'])){
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $checkEmail = "SELECT * FROM Users where email = '$email'";
        $result = $conn->query($checkEmail);
        if($result->num_rows>0){
            echo '<h1>The email already exists!</h1>';
        }else{
            $insertQuery = "INSERT INTO Users(firstName, lastName, email, password)
            VALUES('$fName', '$lName', '$email', '$password')";
            if($conn->query($insertQuery)==TRUE){
                header("Location: login.php");
            }else{
                echo 'Error:' . $conn->connect_error;
            }
        }
    }

    if(isset($_POST['signIn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header("Location: main.html");
            exit();
        }else{
            echo '<h1>Not found, incorrect email and password</h1>';
        }
    }
?>