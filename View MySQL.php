<?php
    $server = $_POST['server1'];
    $name = $_POST['Name'];
    $password = $_POST['password'];
?>

<!DOCTYPE html>
<html>
<head>
<script language="JavaScript" type="text/javascript">
function display(c)
{
     if(c.value == "users" || c.value == "databases")
     {
         document.getElementById("table").style.visibility = "hidden";
         document.getElementById("info").style.visibility = "hidden";
         document.getElementById("see").style.visibility = "visible";  
     }
     else if(c.value == "tables")
     {
          document.getElementById("table").style.visibility = "visible";
          document.getElementById("info").style.visibility = "hidden";
          document.getElementById("see").style.visibility = "hidden";
     }
     else if(c.value =="info")
     {
          document.getElementById("table").style.visibility = "hidden";
          document.getElementById("info").style.visibility = "visible";
          document.getElementById("see").style.visiblity = "hidden";
          window.location = document.URL.substring(0,document.URL.indexOf("#")) + '#info1';
     }
     else
     {
         document.getElementById("table").style.visibility = "hidden";
         document.getElementById("info").style.visibility = "hidden";
         document.getElementById("see").style.visibility = "hidden";
     }
}

function submitAll1()
{
    if (table.database.value != "") {
        table.type.value = document.getElementById("types").value;
        document.getElementById("table").submit();
        table.database.value = "";
    }
    else {
        alert("Fill out all of the information");
    }
}

function submitAll2()
{
    if (info.database1.value != "" && info.table1.value != "") {
        info.type1.value = document.getElementById("types").value;
        document.getElementById("info").submit();
        info.database1.value = "";
        info.table1.value = "";
    }
    else {
        alert("Fill out all of the information");
    }
}

function submitAll3()
{
     document.getElementById("select").submit();
}

</script>
<head>
    <title>View MySQL</title>
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

<div id = "head"><b>VIEW MySQL</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>
<p align = "center"><u><b>View MySQL tools here</b></u></p>

<form id = "select" action="http://10.150.12.175/webpageMySQL.php" method="post">
<p align = "center"><b>Type:</b> <select name="types" id = "types" onchange = "display(this)">
<option value="">Select one</option>
<option value="users">Users</option>
<option value="databases">Databases</option>
<option value="tables">Tables</option>
<option value="info">Info</option>
</select>
<input type = "button" name = "see"  id = "see" value = "VIEW" onclick = "submitAll3()" style = "visibility:hidden">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "view" name = "action1">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server' value = " . $server . ">"); ?>
</form>

<form name = "table" id = "table" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center" ><b>Database:</b> <input type = "text" value = "" id = "database" name = "database">
<input type = "button" value = "VIEW" onclick = "submitAll1()">
<p align = "center" > <input style = "visibility:hidden" type = "text" value = "" name = "type">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "view" name = "action2">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names1' value = " . $name . ">"); ?><a name = "info1"></a>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password1' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server1' value = " . $server . ">"); ?>
</form>

<form name = "info" id = "info" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center" ><b>Database:</b> <input type = "text" value = "" id = "database1" name = "database1">
<p align = "center"> <b>Table:</b> <input type = "text" value = "" id = "table1" name = "table1">
<input type = "button" value = "VIEW" onclick = "submitAll2()">
<p align = "center" > <input style = "visibility:hidden" type = "text" value = "" name = "type1">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "view" name = "action3">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names2' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password2' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server2' value = " . $server . ">"); ?>
</form>

</body>
</html>
