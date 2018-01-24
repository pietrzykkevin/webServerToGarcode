<?php

session_cache_limiter(false);
session_start();

use Slim\Http\Request;
use Slim\Http\Response;


require('../../vendor/autoload.php');
//require('../dbconnection/connect.php');

$app = new \Slim\App();



$app->post('/check', function (Request $request, Response $response){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Studentdatabase";


    $connection = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($connection->connect_errno != 0) {
        $response->write("Connection nr: ". $connection->connect_errno . " Connection failed: " . $connection->connect_error);
    }
    else {

        $data = $request->getParsedBody();
        $inputalbumnr = $data['albumnr'];
        $inputpassword = $data['password'];

        $inputalbumnr = htmlentities($inputalbumnr, ENT_QUOTES, "UTF-8");
        $inputpassword = htmlentities($inputpassword, ENT_QUOTES, "UTF-8");

        //$sql = "SELECT * FROM students WHERE album_nr=$inputalbumnr AND pass='$inputpassword'";

        if($result = @$connection->query(
            sprintf("SELECT * FROM students WHERE album_nr=%s AND pass='%s'",
            mysqli_real_escape_string($connection, $inputalbumnr),
            mysqli_real_escape_string($connection, $inputpassword)))){

            $nrofstudents = $result->num_rows;

            if($nrofstudents > 0){

                $_SESSION['loggedin'] = true;

                $row = $result->fetch_assoc();

                $_SESSION['album_nr'] = $row['album_nr'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];


                unset($_SESSION['error']);

                $result->free_result();

                header("Location: /studentInputApi/src");
                //$response->withRedirect("/studentInputApi/src");
                $connection->close();
                exit();

            }
            else{

                $connection->close();
                $_SESSION['error'] = '<span style="color:red">Incorrect album number or password!</span>';
                header("Location: /studentInputApi/loginPage");
                exit();
                $response->write('<span style="color:red">Incorrect album number or password!</span>');


            }
        }
        else{

            $response->write("incorrect query");

        }


    }

    return $response;



});

$app->run();
?>
