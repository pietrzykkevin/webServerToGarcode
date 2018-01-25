<?php

session_cache_limiter(false);
session_start();


if(!isset($_SESSION['loggedin'])){
    header("Location: /studentInputApi/loginPage");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student submit exercise form</title>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="sendTaskForm.css">
</head>
<body>


<div class="row">


    <div class="input col s6">
        <div class="studentData">



            <?php
                echo "<h5> Hello " . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "</h5>";
                echo "<h6>Your email: " . $_SESSION['email'] . "</h6>";
            ?>

        </div>
        <form class="logoutform" method="post" action="public/logout">
            <div>
                <input type="submit" value="logout" id="logout"/>
            </div>
        </form>
            <form class="theform" method="post" action="public/file/upload" enctype="multipart/form-data" >
            <div>
                <label for="taskid">Task ID</label>
                <input id="taskid" class="validate" type="number" name="taskid"  required/>
            </div>

            <div>
                <label for="file">File</label>
                <input id="file" class="validate" type="file" name="file" accept='text/*' required/>
            </div>

            <div>
                <input type="submit" value="submit" id="submit"/>
            </div>
        </form>

        <div class="programOutput">

        </div>

    </div>

    <div class="output col s6">
        <div class="fileoutput">

            <label>File Data</label>
            <pre class="outputfilecontent"></pre>


        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="sendTaskForm.js"></script>
</body>
</html>


