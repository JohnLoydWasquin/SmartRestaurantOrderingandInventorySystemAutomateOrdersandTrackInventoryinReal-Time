<?php
    session_start();
    require_once 'mainDB.php';
    
    if(isset($_POST['signUp'])){
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $phoneNumber = $_POST['tNumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $checkEmail = "SELECT * FROM Users where email = '$email'";
        $result = $conn->query($checkEmail);
        if($result->num_rows>0){
            echo '<h1>The email already exists!</h1>';
        }else{
            $insertQuery = "INSERT INTO Users(firstName, lastName, PhoneNumber, email, password)
            VALUES('$fName', '$lName', '$phoneNumber', '$email', '$password')";
            if($conn->query($insertQuery)==TRUE){
                header("Location: login.html");
            }else{
                echo 'Error:' . $conn->$exception;
            }
        }
    }

    if(isset($_POST['signIn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header("Location: main.html");
            exit();
        }else{
            echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>

        Swal.fire({
            title: 'Error!',
            text: 'Incorrect password or email try again!',
            icon: 'error',
            confirmButtonText: 'okay'
            }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'login.html';
            }
        });
        </script>
        </body>
        </html> ";
        }
    }
?>