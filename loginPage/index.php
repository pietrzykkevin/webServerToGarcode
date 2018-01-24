<?php

session_cache_limiter(false);
session_start();


if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true)){
    header("Location: /studentInputApi/src");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student login</title>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<div class="row">

    <div class="input ">
        <form class="theloginform" method="post" action="check_login/check" >
            <div>
                <label for="albumnr">student album number:</label>
                <input id="albumnr" class="validate" type="number" name="albumnr"  required/>
            </div>

            <div>
                <label for="password">Password:</label>
                <input id="password" class="validate" type="password" name="password" required/>
            </div>

            <div>
                <input type="submit" value="submit" id="submit"/>
            </div>

        </form>
    </div>

    <?php
        if(isset($_SESSION['error'])) echo $_SESSION['error'];
    ?>

    <div class="answer">
    </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="index.js"></script>
</body>
</html>

