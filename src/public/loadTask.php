<?php

session_cache_limiter(false);
session_start();

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

require '../../vendor/autoload.php';

$app = new \Slim\App();

$container = $app->getContainer();
$container['base_upload_directory'] = '/home/kevin/SemesterV/TO2/Projekt/WprostDoGit/garcode/src/main/resources/studentExercises/';
$container['path_to_java_project'] = '/home/kevin/SemesterV/TO2/Projekt/WprostDoGit/garcode';
$container['execution_file'] = '/home/kevin/SemesterV/TO2/Projekt/WprostDoGit/studentInputApi/execCode.txt';
$app->post('/file/upload', function (Request $request, Response $response) {

    $basedirectory = $this->get('base_upload_directory');
    $executionpathdirectiory = $this->get('path_to_java_project');
    $executionfile = $this->get('execution_file');

    $executioncmd = file_get_contents($executionfile);

    $data = $request->getParsedBody();
    $taskid = $data['taskid'];


    $albumNr = $_SESSION['album_nr'];

    $directory = $basedirectory . DIRECTORY_SEPARATOR . $taskid;

    $uploadedFiles = $request->getUploadedFiles();
    $uploadedFile = $uploadedFiles['file'];

    $fileExtension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $newfileName = $albumNr . '.'  . $fileExtension;
    $filepath = $directory . DIRECTORY_SEPARATOR . $newfileName;

    if(!file_exists ($directory)){
        $response->write('<span style="color:red">Incorrect task id!</span>');
        return $response;
    }


    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $uploadedFile->moveTo($filepath);
        chmod($filepath,0777);
        exec("cd $executionpathdirectiory && $executioncmd $newfileName $taskid", $output);

        $response->write('<span style="color:green">Success! Score sent to your email</span>');
    }

    return $response;

});

$app->post('/logout', function (Request $request, Response $response) {

    session_unset();

    header('Location: /studentInputApi/loginPage');
    exit();

});


$app->run();
?>
