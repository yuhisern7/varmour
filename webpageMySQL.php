<?php
    for($i = 1; $i <= 4; $i++){
        if (isset($_POST['action' . $i])) {
            $action = $_POST['action' . $i];
        }
    }
    
    for($i = 0; $i <= 3; $i++){
        if ($i == 0)
            $i = "";
        if (isset($_POST['Names' . $i])) {
            $username = $_POST['Names' . $i];
            $password = $_POST['Password' . $i];
            $server = $_POST['Server' . $i];
        }
    }
    
    $type = "";
    for($i = 0; $i <= 4; $i++){
        if ($i == 0)
            $i = "";
        if (isset($_POST['type' . $i])) {
            $type = $_POST['type' . $i];
        }
    }
    if($type == ""){
        if(isset($_POST['types'])){
            $type = $_POST['types'];
        }
    }
    
    for($i = 0; $i <= 3; $i++){
        if ($i == 0)
            $i = "";
        if (isset($_POST['values' . $i])) {
            $data = $_POST['values' . $i];
        }
    }
    
    if($action == "create"){        
        if($type == "users"){
            $userCreate = $_POST['username'];
            $passwordCreate = $_POST['passwd'];
            $serverCreate = $_POST['server'];
            $command = "python -c 'import connectMySQL; connectMySQL.createUser(" . '"' . $userCreate . '"' . "," . '"' . $passwordCreate . '"' . "," . '"' . $serverCreate . '"' . "," . '"' . $data . '"' . ")'";
            echo("<p align = 'center'>" . "Output: ");
            passthru($command, $output);
            if($output == "done"){
                echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
            }
            else {
                echo("<br> <p align = 'center'>" . "There is already a user with that name. Please try again.");
            }
        }
        
        else if($type == "databases"){
            $databaseName = $_POST['dbname'];
            $command = "python -c 'import connectMySQL; connectMySQL.createDatabase(" . '"' . $databaseName . '"' . "," . '"' . $data . '"' . ")'";
            echo("<p align = 'center'>" . "Output: ");
            passthru($command, $output);
            if($output == "done"){
                echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
            }
            else {
                echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
            }
        }
        
        else if($type == "tables"){
            $tableName = $_POST['tname'];
            $tableDB = $_POST['tdatabase'];
            $command = "python -c 'import connectMySQL; connectMySQL.createTable(" . '"' . $server . '"' . "," . '"' . $username . '"' . "," . '"' . $password . '"' . "," . '"' . $tableDB . '"' . "," . '"' . $tableName . '"' . ")'";
            echo("<p align = 'center'>" . "Output: ");
            passthru($command, $output);
            if($output == "done"){
                echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
            }
            else {
                echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
            }
        }
    }
    
    if($action == "add"){
        $fileAdd = FALSE;
        for($i = 1; $i <= 2; $i++){
            if (isset($_POST['file' . $i])) {
                $file = $_POST['file' . $i];
                $fileAdd = TRUE;
            }
        }
        
        for($i = 0; $i <= 1; $i++){
            if($i == 0)
                $i = "";
            if (isset($_POST['tables' . $i])) {
                $tables = $_POST['tables' . $i];
                $databases = $_POST['databases' . $i];
            }
        }

        $dataAdd = $_POST['values'];
        $command = "python -c 'import connectMySQL; connectMySQL.insertData(" . '"' . $server . '"' . "," . '"' . $username . '"' . "," . '"' . $password . '"' . "," . '"' . $databases . '"' . "," . '"' . $tables . '"' . "," . '"' . $file . '"' . "," . '"' . $data . '"' . ")'";
        echo("<p align = 'center'>" . "Output: ");
        passthru($command, $output);
        if($output == "done"){
            echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
        }
        else {
            echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
        }
    }
    
    if($action == "delete"){
        $command = "python -c 'import connectMySQL; connectMySQL.deleteMySQL(" . '"' . $type . '"' . "," . '"' . $data . '"' . ")'";
        echo("<p align = 'center'>" . "Output: ");
        passthru($command, $output);
        if($output == "done"){
            echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
        }
        else {
            echo("<br> <p align = 'center'>" . "The name of the " . $type . " you want to delete has already been deleted or is not a part of the database. Please return to the home screen if you want to do something else");
        }
    }
    
    if($action == "view"){
        $databaseSee = "";
        $tableSee = "";
        for($i = 0; $i <= 1; $i++){
            if($i == 0)
                $i = "";
            if (isset($_POST['database' . $i])) {
                $tableSee = $_POST['table' . $i];
                $databaseSee = $_POST['database' . $i];
            }
        }
        $command = "python -c 'import connectMySQL; connectMySQL.seeMySQL(" . '"' . $type . '"' . "," . '"' . $databaseSee . '"' . "," . '"' . $tableSee . '"' . ")'";
        echo("<p align = 'center'>" . "Output: ");
        $dataSeen = null;
        exec($command, $dataSeen, $output);
        echo("<p align = 'center'><pre>" . var_export($dataSeen, TRUE) . "</pre></p>");
        if($output == "done"){
            echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
        }
        else {
            echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
        }
    }
    
?>

<!DOCTYPE html>

<html>

<head>
    <title>Address Processing</title>
<style type = "text/css">
body {
    background:white;
    margin: 44px
}
div#home {
    background:gray;
    color:white;
    padding:8px;
    position:fixed;
    top:0px;
    left:0px;
    width:5%
}
div#head {
    background:black;
    color:white;
    padding:8px;
    text-align:center;
    position:fixed;
    top:0px;
    left:0px;
    width:100%
}
</style>
</head>
<body>

<div id = "head"><b>ADDRESS PROCESSING</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>

</body>
</html>