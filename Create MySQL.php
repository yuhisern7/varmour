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
     if(c.value == "users")
     {
          document.getElementById("users").style.visibility = "visible";
          document.getElementById("databases").style.visibility = "hidden";
          document.getElementById("tables").style.visibility = "hidden";
     }
     else if(c.value =="databases")
     {
          document.getElementById("users").style.visibility = "hidden";
          document.getElementById("databases").style.visibility = "visible";
          document.getElementById("tables").style.visibility = "hidden";
          window.location = document.URL.substring(0,document.URL.indexOf("#")) + '#databases1';
     }
     else if(c.value =="tables")
     {
          document.getElementById("users").style.visibility = "hidden";
          document.getElementById("databases").style.visibility = "hidden";
          document.getElementById("tables").style.visibility = "visible";
          window.location = document.URL.substring(0,document.URL.indexOf("#")) + '#tables1';
     }
     else
     {
         document.getElementById("users").style.visibility = "hidden";
         document.getElementById("databases").style.visibility = "hidden";
         document.getElementById("tables").style.visibility = "hidden";
     }
}

function addDB()
{
     var db = users.dAccess.value;
     var okay = false;
     var unique = true;
     for(i=0; i<document.getElementById("Database").length; i++)
     {
           var val = document.getElementById("Database")[i].value;
           if(db == val)
           {
                unique = false;
            }
     }
     if (db != "" && unique)
     {
           okay = true;
     }
     if(okay)
     {
          var item = db;
          var newOption = document.createElement("option");
          newOption.text = item;
          newOption.value = item;
          var select = document.getElementById("Database");
          select.add(newOption); 
          users.dAccess.value = "";
     }
     else if (!unique)
     {
             alert("Change name!");
             users.dAccess.value = "";
     }
     else 
     {
             alert("Fill out the information!");
     }
}

function addU()
{
     var u = databases.uAccess.value;
     var s = databases.uServer.value;
     var okay = false;
     var unique = true;
     for(i=0; i<document.getElementById("User").length; i++)
     {
           var val = document.getElementById("User")[i].value;
           var n = val.substring(0,val.indexOf(" "));
           if(u == n)
           {
                unique = false;
           }
     }
     if (u != "" && s != "" && unique)
     {
           okay = true;
     }
     if(okay)
     {
          var item = u + " " + s;
          var newOption = document.createElement("option");
          newOption.text = item;
          newOption.value = item;
          var select = document.getElementById("User");
          select.add(newOption); 
          databases.uAccess.value = "";
          databases.uServer.value = "";
     }
     else if (!unique)
     {
             alert("Change name!");
             databases.uAccess.value = "";
     }
     else 
     {
             alert("Fill out the information!");
     }
}

function removeDB()
{
  var elSel = document.getElementById('Database');
  var i;
  for (i = elSel.length - 1; i>=0; i--)
  {
    if (elSel.options[i].selected)
    {
      elSel.remove(i);
    }
  }
}

function removeU()
{
  var elSel = document.getElementById('User');
  var i;
  for (i = elSel.length - 1; i>=0; i--)
  {
    if (elSel.options[i].selected)
    {
      elSel.remove(i);
    }
  }
}

function submitAll1()
{
    if (users.username.value != "" && users.passwd.value != "" && users.server.value != "") {
        users.type1.value = document.getElementById("type").value;
        var select1 = document.getElementById('Database');
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        users.values.value = val.join(";");
        document.getElementById("dAccess").disabled = true; 
        document.getElementById("users").submit();
        document.getElementById("dAccess").disabled = false;
        users.username.value = "";
        users.server.value = "";
        users.dAccess.value = "";
    }
    else {
        alert("Fill out the information (Excluding ones that need to go to the box)");
    }
}

function submitAll2()
{
    if (databases.dbname.value != "") {
        databases.type2.value = document.getElementById("type").value;
        var select1 = document.getElementById('User');
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        databases.values1.value = val.join(";");
        document.getElementById("uAccess").disabled = true;
        document.getElementById("uServer").disabled = true;
        document.getElementById("databases").submit();
        document.getElementById("uAccess").disabled = false;
        document.getElementById("uServer").disabled = false;
        databases.dbname.value = "";
        databases.uAccess.value = "";
        databases.uServer.value = "";  
    }
    else {
        alert("Fill out the information (Excluding ones that need to go to the box)");
    }
}


function submitAll3()
{
    if (tables.tname.value != "" && tables.tdatabase.value != "") {
        tables.type3.value = document.getElementById("type").value;
        document.getElementById("tables").submit();
        tables.tname.value = "";
        tables.tdatabase.value = "";
    }
    else {
        alert("Fill out the information");
    }
}

</script>

<head>
    <title>Create MySQL</title>
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

<div id = "head"><b>CREATE MySQL</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>

<p align = "center"><b><u>Create MySQL tools here</u></b></p>

<form id = "choice" action="webpage.php">
<p align = "center"><b>Type:</b> <select name="type", id = "type" onchange = "display(this)">
<option value="">Select one</option>
<option value="users">Users</option>
<option value="databases">Databases</option>
<option value="tables">Tables</option>
</select>
<br>
</form>

<form id = "users"  action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method = "post">
<p align = "center"><b>Username:</b> <input type = "text" value = "" id = "username" name = "username"> <br>
<p align = "center"><b>Password:</b> <input type = "password" value = "" id = "passwd" name = "passwd"> <br>
<p align = "center"><b>Server: </b> <input type = "text" value = "" id = "server" name = "server"> <br>
<p align = "center"><b>Database Access (Add to box):</b> <input type = "text" value = "" id = "dAccess" name = "dAccess"> <br>
<p align = "center"> <b><u>Database</u></b><br><select id = "Database" size = "4" multiple = "multiple" style = "width:300px"></select><br>
<p align = "center"><input type="button" value="ADD" onclick="addDB()"><input type="button" value="REMOVE" onclick="removeDB()"><input type="button" value = "CREATE" onclick = "submitAll1()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "type1"><a name = "databases1"></a>
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "create" name = "action1">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server' value = " . $server . ">"); ?>
</form>

<form id = "databases" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center"><b>Name:</b> <input type = "text" value = "" id = "dbname" name = "dbname"> <br>
<p align = "center"><b>User Access (Add to box):</b> <input type = "text" value = "" id = "uAccess" name = "uAccess"> <br>
<p align = "center"><b>User Server (Add to box):</b> <input type = "text" value = "" id = "uServer" name = "uServer"> <br>
<p align = "center"> <b><u>User</u></b><br><select id = "User" size = "4" multiple = "multiple" style = "width:300px"></select><br>
<p align = "center"><input type="button" value="ADD" onclick="addU()"><input type="button" value="REMOVE" onclick="removeU()"><input type="button" value = "CREATE" onclick = "submitAll2()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "type2">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values1">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "create" name = "action2">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names1' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password1' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server1' value = " . $server . ">"); ?>
</form>

<form id = "tables" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center"><b><a name = "tables1">Name:</a></b> <input type = "text" value = "" id = "tname" name = "tname"> <br>
<p align = "center"><b>Database:</b> <input type = "text" value = "" id = "tdatabase" name = "tdatabase"> <br>
<input type="button" value = "CREATE" onclick = "submitAll3()">
<p align = "center" > <input style = "visibility:hidden" type = "text" value = "" name = "type3">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "create" name = "action3">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names2' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password2' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server2' value = " . $server . ">"); ?>
</form>

</body>

</html>
