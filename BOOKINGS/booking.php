<?php
session_start();  

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to book a table!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any required fields are empty
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['booking_date']) || empty($_POST['booking_time']) || empty($_POST['selectedTable'])) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <style>
        /* Customizing the Go Back button color */
        .swal2-confirm {
            background-color: rgb(253, 57, 8) !important; /* Set the desired color */
            border-color: rgb(253, 57, 8) !important;   /* Ensure border matches */
        }
    </style>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Missing Information!',
                    text: 'Please fill in all fields and select a table.',
                    icon: 'error',
                    confirmButtonText: 'Go Back'
                }).then((result) => {
                    if (result.isConfirmed) {
                            history.back();
                    }
                });
            </script>
        </body>
        </html>";
        exit();
    } else {
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $booking_date = $_POST['booking_date'];
        $booking_time = $_POST['booking_time'];
        $selectedTable = $_POST['selectedTable'];
        $additional_notes = isset($_POST['additional_notes']) ? $_POST['additional_notes'] : '';

        
        $user_id = $_SESSION['user_id'];

        
        $conn = new mysqli("localhost", "root", "", "samgyup_paradise");

       
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $sqlCheckTable = "SELECT * FROM tables WHERE table_number = '$selectedTable' AND is_occupied = 1";
        $resultCheckTable = $conn->query($sqlCheckTable);

        if ($resultCheckTable->num_rows > 0) {
            // Inject SweetAlert script into the response
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Table Booking</title>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <style>
        /* Customizing the Go Back button color */
        .swal2-confirm {
            background-color: rgb(253, 57, 8) !important; /* Set the desired color */
            border-color: rgb(253, 57, 8) !important;   /* Ensure border matches */
        }
    </style>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: 'Table Already Booked!',
                        text: 'Sorry, please pick another table.',
                        confirmButtonText: 'Go Back'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            history.back();
                        }
                    });
                </script>
            </body>
            </html>";
            exit();        
         
        } else {
           
            $sqlInsertBooking = "INSERT INTO bookings (user_id, table_number, first_name, last_name, email, phone, booking_date, booking_time, additional_notes) 
                                 VALUES ('$user_id', '$selectedTable', '$first_name', '$last_name', '$email', '$phone', '$booking_date', '$booking_time', '$additional_notes')";

            if ($conn->query($sqlInsertBooking) === TRUE) {
                
                $sqlUpdateTable = "UPDATE tables SET is_occupied = 1 WHERE table_number = '$selectedTable'";

                if ($conn->query($sqlUpdateTable) === TRUE) {
                    echo "
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                        <style>
        /* Customizing the Go Back button color */
        .swal2-confirm {
            background-color: rgb(253, 57, 8) !important; /* Set the desired color */
            border-color: rgb(253, 57, 8) !important;   /* Ensure border matches */
        }
    </style>
                    </head>
                    <body>
                        <script>
                            Swal.fire({
                                title: 'Booking Successful!',
                                text: 'Your table has been booked successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'btable.php'; 
                                }
                            });
                        </script>
                    </body>
                    </html>";
                } else {
                    echo "Error updating table status: " . $conn->error;
                }
            } else {
                echo "Error: " . $sqlInsertBooking . "<br>" . $conn->error;
            }
        }

        $conn->close(); 
    }
}

?>
<script src="../BOOKINGS/bTable.js"></script>