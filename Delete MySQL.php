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
          document.getElementById("input").style.visibility = "hidden";
     }
     else if(c.value =="databases")
     {
          document.getElementById("users").style.visibility = "hidden";
          document.getElementById("databases").style.visibility = "visible";
          document.getElementById("tables").style.visibility = "hidden";
          document.getElementById("input").style.visibility = "hidden";
          window.location = document.URL.substring(0,document.URL.indexOf("#")) + '#databases1';
     }
     else if(c.value =="tables")
     {
          document.getElementById("users").style.visibility = "hidden";
          document.getElementById("databases").style.visibility = "hidden";
          document.getElementById("tables").style.visibility = "visible";
          document.getElementById("input").style.visibility = "hidden";
          window.location = document.URL.substring(0,document.URL.indexOf("#")) + '#tables1';
     }
     else if(c.value =="info")
     {
          document.getElementById("users").style.visibility = "hidden";
          document.getElementById("databases").style.visibility = "hidden";
          document.getElementById("tables").style.visibility = "hidden";
          document.getElementById("input").style.visibility = "visible";
          window.location = document.URL.substring(0,document.URL.indexOf("#")) + '#info1';
     }
     else
     {
         document.getElementById("users").style.visibility = "hidden";
         document.getElementById("databases").style.visibility = "hidden";
         document.getElementById("tables").style.visibility = "hidden";
         document.getElementById("input").style.visibility = "hidden";
     }
}

function addDB()
{
     var db = databases.dbname.value;
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
          databases.dbname.value = "";
     }
     else if (!unique)
     {
             alert("Change name!");
             databases.dbname.value = "";
     }
     else 
     {
             alert("Fill out the information!");
     }
}

function addU()
{
     var u = users.username.value;
     var s = users.uServer.value;
     var okay = false;
     var unique = true;
     for(i=0; i<document.getElementById("User").length; i++)
     {
           var val = document.getElementById("User")[i].value;
           var n = val.substring(0,val.indexOf(" "));     
           if(u == n)
           {
                if (val.substring(val.indexOf(" ") + 1) == s)
                {
                    unique = false;
                }
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
          users.username.value = "";
          users.uServer.value = "";
     }
     else if (!unique)
     {
          alert("Change name!");
          users.username.value = "";
     }
     else 
     {
          alert("Fill out the information!");
     }
}

function addT()
{
     var t = tables.tname.value;
     var d = tables.tdb.value;
     var okay = false;
     var unique = true;
     for(i=0; i<document.getElementById("Table").length; i++)
     {
           var val = document.getElementById("Table")[i].value;
           var n = val.substring(0,val.indexOf(" "));
           if(t == n)
           {
                if (val.substring(val.indexOf(" ") + 1) == d)
                {
                    unique = false;
                }
           }
     }
     if (t != "" && d != "" && unique)
     {
           okay = true;
     }
     if(okay)
     {
          var item = t + " " + d;
          var newOption = document.createElement("option");
          newOption.text = item;
          newOption.value = item;
          var select = document.getElementById("Table");
          select.add(newOption); 
          tables.tname.value = "";
          tables.tdb.value = "";
     }
     else if (!unique)
     {
          alert("Change name!");
          tables.tname.value = "";
     }
     else 
     {
          alert("Fill out the information!");
     }
}

function add()
{
     var name = input.iname.value;
     var db = input.idb.value;
     var table = input.itable.value;
     var okay = false;
     if (name != "" && db != "" && table != "")
     {
           okay = true;
     }
     if(okay)
     {
          var item = name + " "  + db + " " + table;
          var newOption = document.createElement("option");
          newOption.text = item;
          newOption.value = item;
          var select = document.getElementById("Name");
          select.add(newOption); 
          input.iname.value = "";
          input.idb.value = "";
          input.itable.value = "";
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

function removeT()
{
  var elSel = document.getElementById('Table');
  var i;
  for (i = elSel.length - 1; i>=0; i--)
  {
    if (elSel.options[i].selected)
    {
      elSel.remove(i);
    }
  }
}

function removeI()
{
  var elSel = document.getElementById('Name');
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
    var select1 = document.getElementById('User');
    if (select1.options.length > 0) {
        users.type1.value = document.getElementById("type").value;
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        users.values.value = val.join(";");
        document.getElementById("username").disabled = true;
        document.getElementById("uServer").disabled = true;
        document.getElementById("users").submit();
        document.getElementById("username").disabled = false;
        document.getElementById("uServer").disabled = false;
        users.username.value = "";
        users.uServer.value = "";
    }
    else {
        alert("Add something to delete");
    }
}

function submitAll2()
{
    var select1 = document.getElementById('Database');
    if (select1.options.length > 0) {
        databases.type2.value = document.getElementById("type").value;        
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        databases.values1.value = val.join(";");
        document.getElementById("dbname").disabled = true;
        document.getElementById("databases").submit();
        document.getElementById("dbname").disabled = false;
        databases.dbname.value = "";    
    }
    else {
        alert("Add something to delete");
    }
}

function submitAll3()
{
    var select1 = document.getElementById('Table');
    if (select1.options.length > 0) {
        tables.type3.value = document.getElementById("type").value;    
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        tables.values2.value = val.join(";");
        document.getElementById("tname").disabled = true;
        document.getElementById("tdatabase").disabled = true;
        document.getElementById("tables").submit();
        document.getElementById("tdatabase").disabled = false;
        document.getElementById("tname").disabled = false;
        tables.tname.value = "";    
    }
    else {
        alert("Add something to delete");
    }
}

function submitAll4()
{
    var select1 = document.getElementById('Name');
    if (select1.options.length) {
        input.type4.value = document.getElementById("type").value;
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        input.values3.value = val.join(";");
        document.getElementById("iname").disabled = true;
        document.getElementById("idb").disabled = true;
        document.getElementById("itable").disabled = true;
        document.getElementById("input").submit();
        document.getElementById("iname").disabled = false;
        document.getElementById("idb").disabled = false;
        document.getElementById("itable").disabled = false;
        input.iname.value = "";
        input.idb.value = "";
        input.itable.value = "";
    }
    else {
        alert("Add something to delete");
    }
}

function submitAll5()
{
    if (input.idb.value != "" && input.itable.value != "") {
        input.type4.value = document.getElementById("type").value;
        var select1 = document.getElementById('Name');
        input.values3.value = "whole" + " " + input.idb.value + " " + input.itable.value;
        document.getElementById("iname").disabled = true;
        document.getElementById("idb").disabled = true;
        document.getElementById("itable").disabled = true;
        document.getElementById("input").submit();
        document.getElementById("iname").disabled = false;
        document.getElementById("idb").disabled = false;
        document.getElementById("itable").disabled = false;
        input.iname.value = "";
        input.idb.value = "";
        input.itable.value = "";
    }
    else {
        alert("Fill in the database and table that you want to delete information from");
    }
}

</script>

<head>
    <title>Delete MySQL</title>
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

<div id = "head"><b>DELETE MySQL</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>
<p align = "center"><b><u>Delete MySQL tools here</u></b></p>

<form id = "see" action="http://10.150.12.175/webpageMySQL.php">
<p align = "center"><b>Type:</b> <select name="type", id = "type" onchange = "display(this)">
<option value="">Select one</option>
<option value="users">Users</option>
<option value="databases">Databases</option>
<option value="tables">Tables</option>
<option value="info">Info</option>
</select><br>

</form>

<form id = "users" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center"><b>Username (Add to box):</b> <input type = "text" value = "" id = "username" name = "username"> <br>
<p align = "center"><b>Server (Add to box):</b> <input type = "text" value = "" id = "uServer" name = "uServer"> <br>
<p align = "center"> <b><u>User</u></b><br><select id = "User" size = "4" multiple = "multiple" style = "width:300px"></select><br>
<p align = "center"><input type="button" value="ADD" onclick="addU()"><input type="button" value="REMOVE" onclick="removeU()"><input type = "button" value = "DELETE" onclick = "submitAll1()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "type1"><a name = "databases1"></a>
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "delete" name = "action1">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server' value = " . $server . ">"); ?>
</form>

<form id = "databases" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center"><b>Name (Add to box):</b> <input type = "text" value = "" id = "dbname" name = "dbname"> <br>
<p align = "center"> <b><u>Database</u></b><br><select id = "Database" size = "4" multiple = "multiple" style = "width:300px"></select><br>
<p align = "center"><input type="button" value="ADD" onclick="addDB()"><input type="button" value="REMOVE" onclick="removeDB()"><input type = "button" value = "DELETE" onclick = "submitAll2()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "type2"><a name = "tables1"></a>
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values1">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "delete" name = "action2">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names1' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password1' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server1' value = " . $server . ">"); ?>
</form>

<form id = "tables" action = "http://10.150.12.175/webpageMySQL.php" style = "visibility:hidden" method="post">
<p align = "center"><b>Name (Add to box):</b> <input type = "text" value = "" id = "tname" name = "tname"> <br>
<p align = "center"><b>Database (Add to box):</b> <input type = "text" value = "" id = "tdb" name = "tdb"> <br>
<p align = "center"> <b><u>Table</u></b><br><select id = "Table" size = "4" multiple = "multiple" style = "width:300px"></select><br>
<p align = "center"><input type="button" value="ADD" onclick="addT()"><input type="button" value="REMOVE" onclick="removeT()"><input type = "button" value = "DELETE" onclick = "submitAll3()">
<p align = "center" > <input style = "visibility:hidden" type = "text" value = "" name = "type3">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values2">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "delete" name = "action3">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names2' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password2' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server2' value = " . $server . ">"); ?>
</form>

<form name = "input" id = "input" action="http://10.150.12.175/webpageMySQL.php" method="post" style =  "visibility:hidden">
<p align = "center"><b><a name = "info1">Name (Add to box):</a></b> <input type="text" name="iname" id = "iname"  value=""><br>
<p align = "center"><b>Database (Add to box except when you want to delete whole):</a></b> <input type="text" name="idb" id = "idb"  value=""><br>
<p align = "center"><b>Table (Add to box except when you want to delete whole):</a></b> <input type="text" name="itable" id = "itable"  value=""><br>

<p align = "center"><B><u>Names</u></B> <br>
<p align = "center"><select id="Name" name = "Name" size="4" multiple = "multiple" style="width:300px">
</SELECT>

<p align = "center"><input type="button" value="ADD" onclick="add()"><input type="button" value="REMOVE" onclick="removeI()"><input type = "button" value = "DELETE WHOLE" onclick = "submitAll5()"><input type = "button" value = "DELETE" onclick = "submitAll4()">
<p align = "center" > <input style = "visibility:hidden" type = "text" value = "" name = "type4">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values3">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "delete" name = "action4">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Names3' value = " . $name . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Password3' value = " . $password . ">"); ?>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'Server3' value = " . $server . ">"); ?>
</form>


</body>
</html>