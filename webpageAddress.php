<?php
    for($i = 1; $i <= 2; $i++){
        if (isset($_POST['action' . $i])) {
            $action = $_POST['action' . $i];
        }
    }
    
    for($i = 0; $i <= 1; $i++){
        if ($i == 0)
            $i = "";
        if (isset($_POST['server' . $i])) {
            $server = $_POST['server' . $i];
        }
    }
    
    if($action == "add"){
        $mysqlAdd = FALSE;
        if(isset($_POST['mysqlServer']))
            $mysqlAdd = TRUE;
        if($mysqlAdd){
            $username = $_POST['Name'];
            $password = $_POST['password'];
            $mysqlServer = $_POST['mysqlServer'];
            $database = $_POST['database'];
            $table = $_POST['table'];
            $command = "python -c 'import curlAddress; curlAddress.addAddressMySQL(" . '"' . $server . '"' . "," . '"' . $mysqlServer . '"' . "," . '"' . $username . '"' . "," . '"' . $password . '"' . "," . '"' . $database . '"' . "," . '"' . $table . '"' . ")'";
            echo("<p align = 'center'>" . "Output: ");
            passthru($command, $output);
            if($output == "done"){
                echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
            }
            else {
                echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
            }
        }
        if(!$mysqlAdd){
            $dataAdd = $_POST['values'];
            $command = "python -c 'import curlAddress; curlAddress.addAddress(" . '"' . $server . '"' . "," . '"' . $dataAdd . '"' . ")'";
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
    
    if($action == "delete"){
        $dataDelete = $_POST['values'];
        $command = "python -c 'import curlAddress; curlAddress.deleteAddress(" . '"' . $server . '"' . "," . '"' . $dataDelete . '"' . ")'";
        echo("<p align = 'center'>" . "Output: ");
        passthru($command, $output);
        if($output == "done"){
            echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
        }
        else {
            echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
        }
    }
    
    if($action == "change"){
        $nameChange = $_POST['Name'];
        $typeChange = $_POST['type'];
        $addressChange = $_POST['Address'];
        $command = "python -c 'import curlAddress; curlAddress.changeAddress(" . '"' . $server . '"' . "," . '"' . $nameChange . '"' . "," . '"' . $typeChange . '"' . "," . '"' . $addressChange . '"' . ")'";
        echo("<p align = 'center'>" . "Output: ");
        passthru($command, $output);
        if($output == "done"){
            echo("<br> <p align = 'center'>" . "The action is complete. Please return to the home screen if you want to do something else.");
        }
        else {
            echo("<br> <p align = 'center'>" . "There seems to be an error. Please check to see that you have filled out all the appropriate text areas.");
        }
    }
    
    if($action == "view"){
        $dataView = $_POST['type'];
        $command = "python -c 'import curlAddress; curlAddress.getAddress(" . '"' . $server . '"' . "," . '"' . $dataView . '"' . ")'";
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