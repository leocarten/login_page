<?php

        // In this php script, we populate the DB with all possible question inputs and answers. The actual session won't start until they login.

        function makeConnection($server, $user, $pass, $db){
            $conn = new mysqli($server, $user, $pass, $db);
            if ($conn->connect_error) {
                die("Connection to the database has failed.");
            }
            else{
                return $conn;
            }

        }

            function get_student_id_from_student_table($connection, $get_student_id_query){
                $student_id = 0;
                $result = mysqli_query($connection, $get_student_id_query);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        // Retrieve the student_id
                        $row = mysqli_fetch_assoc($result);
                        $student_id = $row['student_id'];
                        return $student_id;
                    } else {
                        echo "No matching record found.";
                    }
                }
            }
            
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if($_POST["fName"] != "" && $_POST["lName"] != "" && $_POST["password"] != "" && $_POST["passwordConfirmation"] != "" && $_POST["password"] == $_POST["passwordConfirmation"] && strlen($_POST["password"]) >= 8){ //success
                    $firstname = $_POST["fName"];
                    $lastname = $_POST["lName"];
                    $password = $_POST["password"];
                    $timestamp = time();
                    $created_at = date('Y-m-d H:i:s', $timestamp);

                    $hashed_password = hash('sha256', $password); // hash the password

                    // hide your password
                    include("/home/lmc1076/PHP-Includes/phpbook-vars.inc");

                    // make the connection
                    $connection = makeConnection("turing","lmc1076", $my_db_password, "Team2");

                    // start writing queries
                    $query = "INSERT INTO Students (first_name, last_name, password, created_at) VALUES ('$firstname', '$lastname', '$hashed_password', '$created_at')"; // create the account

                    // example of inserting data into the database
                    if (mysqli_query($connection, $query)) {  // insert the data into student table
                        echo "";
                    } else {
                        $error_messgage = 0;
                    }

                    // start the session with the users ID. the ID is the primary key, thus should be unique
                    session_start();
                    $_SESSION['student_id'] = $id;
                    // redirect them to a page IF SUCCESSFULL
                    header("Location: https://turing.plymouth.edu/~lmc1076/user_progress.php");
                    exit;


                }
                elseif($error_messgage == 0){ 
                    // REDIRECT THE USERS TO A PLACE TO LET THEM KNOW THE LOGIN FAILED
                    header('Location: https://turing.plymouth.edu/~lmc1076/error.php');
                    exit;
                }
                else{
                    header('Location: https://turing.plymouth.edu/~lmc1076/error.php');
                    exit;
                }
            }
        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa
7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcT
NXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <title>Account Verification</title>
        <link rel="stylesheet" href="styles.css">
        <script src="script.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    </head>
    <body>

    <section>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark" style="background-color: transparent!important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ethical Hacking Club</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupporte
dContent"aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
            </li>
            <li class="nav-item">
            <!-- <a class="nav-link" href="#">The contest</a> -->
            <a class="nav-link" aria-disabled="true">The contest</a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">The contest</a> -->
                <a class="nav-link disabled" aria-disabled="true">Events</a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">The contest</a> -->
                <a class="nav-link disabled" aria-disabled="true">Guest Speakers</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login
            </a>
            <ul class="dropdown-menu">
                <a class="nav-link" aria-disabled="true">Login</a>
                <li><hr class="dropdown-divider"></li>
                <a class="nav-link" aria-disabled="true">Create Account</a>
            </ul>
            </li>

        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
</section>

    </body>
<html>
