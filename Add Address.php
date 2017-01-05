<?php
if (isset($_POST['servers'])) {
    $server = $_POST['servers'];
}
?>

<html>
<head>
<title>Add Address</title>
<script language="JavaScript" type="text/javascript">
function display()
{
    var x=document.getElementById("type").selectedIndex;
    if (document.getElementsByTagName("option")[x].value == "ipv4")
    {
        alert("Format is 0.0.0.0/00 \n Must be within the IP Range (Each octet is between 0-255) \n Netmask must be under 25");
        input.Address.value = "0.0.0.0/00";
    }
    else if (document.getElementsByTagName("option")[x].value == "mac-address")
    {
        alert("Format is 00:00:00:00:00:00");
        input.Address.value = "00:00:00:00:00:00";
    }
    else if (document.getElementsByTagName("option")[x].value == "hostname")
    {
       alert("Format is a site like \"www.somesite.com\"");
       input.Address.value = "";
    }
}

function randomMAC(frm)
{
    var hex = ["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"];
    var address = "";
    for (var i=0;i<6;i++)
    {
        var first = Math.floor(Math.random()*hex.length);
        var second = Math.floor(Math.random()*hex.length);
        address = address + hex[first] + hex[second];
        if(i<5)
        {
           address = address + ":";
        }
    }
    frm.Address.value = address;
}

function randomAddress(frm)
{
    var x=document.getElementById("type").selectedIndex;
    if (document.getElementsByTagName("option")[x].value == "ipv4")
    { 
       frm.Address.value = "10.1." + Math.floor(Math.random()*17) + "." + Math.floor(Math.random()*256) + "/16";
    }
    else if (document.getElementsByTagName("option")[x].value == "mac-address")
    {
       randomMAC(frm);
    }
    else if (document.getElementsByTagName("option")[x].value == "hostname")
    {
       frm.Address.value = "";
       alert("Unable to create a random \"hostname\" address");
    }
}
</script>

<script language="JavaScript" type="text/javascript">
function addI()
{
    var name = input.Name.value;
    var type = document.getElementsByTagName("option")[document.getElementById("type").selectedIndex].value;
    var address = input.Address.value;
    var okay = false;
    var unique = true;
    for(i=0; i<document.getElementById("Addresses").length; i++)
    {
        var val = document.getElementById("Addresses")[i].value;
        var n = val.substring(0,val.indexOf(" "));
        if(name == n)
        {
            unique = false;
        }
    }
    if (name != "" && type != "" && address != "" && unique)
    {
        okay = true;
    }
    if(okay)
    {
        var item = name + " " + type + " " + address;
        var newOption = document.createElement("option");
        newOption.text = item;
        newOption.value = item;
        var select = document.getElementById("Addresses");
        select.add(newOption); 
        input.Name.value = "";
        input.Address.value = "";
    }
    else if (!unique)
    {
        alert("Change name!");
        input.Name.value = "";
    }
    else 
    {
        alert("Fill out the information!");
    }
}

</script>

<script language="JavaScript" type="text/javascript">
function removeI()
{
  var elSel = document.getElementById('Addresses');
  var i;
  for (i = elSel.length - 1; i>=0; i--)
  {
    if (elSel.options[i].selected)
    {
      elSel.remove(i);
    }
  }
}
</script>

<script type="text/javascript">
function displayForm(c)
{
    if(c.value == "1")
    {
        document.getElementById("mysql").style.visibility = "visible";
        document.getElementById("input").style.visibility = "hidden";
    }
    else if(c.value =="2")
    {
        document.getElementById("mysql").style.visibility = "hidden";
        document.getElementById("input").style.visibility = "visible";
    }
    else
    {
    }
}

function submitAll1()
{
    if (document.getElementById("name").value!='' && document.getElementById("passwd").value !='' && document.getElementById("mysqlServer").value !='' && document.getElementById("table").value!='' && document.getElementById("database").value!='') {
        document.getElementById("mysql").submit();
        document.getElementById("name").value='';
        document.getElementById("passwd").value='';
        document.getElementById("mysqlServer").value='';
        document.getElementById("table").value='';
        document.getElementById("database").value='';
    }
    else {
        alert("Fill out all of the information")
    }
}
function submitAll2()
{
    var select1 = document.getElementById('Addresses');
    if (select1.options.length > 0) {
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        input.values.value = val.join(";");
        document.getElementById("Name").disabled = true;
        document.getElementById("type").disabled = true;
        document.getElementById("format").disabled = true;
        document.getElementById("random").disabled = true;
        document.getElementById("Address").disabled = true;
        document.getElementById("input").submit();
        document.getElementById("Name").disabled = false;
        document.getElementById("type").disabled = false;
        document.getElementById("format").disabled = false;
        document.getElementById("random").disabled = false;
        document.getElementById("Address").disabled = false;
        input.Name.value = "";
        input.Address.value = "";
    }
    else {
        alert("Add an addresses to add");
    }
}

</script>

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

<div id = "head"><b>ADD ADDRESS</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>

<p align = "center"><b><u>Input your address here</u></b></p>

<form><p align = "center">
<input type="radio" name="selection" value="1" onclick = "displayForm(this)">MySQL
<input type="radio" name="selection" value="2" onclick = "displayForm(this)">Input
<br>
<br></p>
</form>

<form name = "mysql" id = "mysql" action="http://10.150.12.175/webpageAddress.php" method = "post" style = "visibility:hidden" >
<p align = "center"><b> Name:</b>
<input type = "text" name = "Name" id = "name" value = ""></br>
<p align = "center"><b> Password: </b>
<input type = "password" name = "password" id = "passwd"> </br>
<p align = "center"><b> MySQL Server: </b>
<input type = "text" name = "mysqlServer" id = "mysqlServer"></br>
<p align = "center" ><b>Database:</b>
<input type = "text" value = "" id = "database" name = "database">
<p align = "center"> <b>Table:</b>
<input type = "text" value = "" id = "table" name = "table"> </br>
<input type="button" value = "SUBMIT" onclick = "submitAll1()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "add" name = "action1">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'server' value = " . $server . ">"); ?>
</form>

<form name = "input" id = "input" action="http://10.150.12.175/webpageAddress.php" method="post" style =  "visibility:hidden">
<p align = "center"><b>Name (Add to box):</b> <input type="text" id = "Name"  name="Name" value=""><br>

<p align = "center"><b>Type (Add to box):</b> <select name="type", id = "type">
<option value="ipv4">ipv4</option>
<option value="mac-address">mac-address</option>
<option value="hostname">hostname</option>
</select><button type="button" onclick="display()" id = "format">FORMAT</button><br>

<p align = "center"><b>Address (Add to box):</b> <input type="text" id = "Address" name="Address" value=""><input type= "button" id = "random"  value = "RANDOM" onclick = "randomAddress(this.form)"> <br>


<p align = "center"><B><u>Addresses</u></B> <br>
<p align = "center"><select id="Addresses" size="4" multiple = "multiple" style="width:300px">
</SELECT>

<p align = "center"><input type="button" value="ADD" onclick="addI()"><input type="button" value="REMOVE" onclick="removeI()"><input type="button" value = "SUBMIT" onclick = "submitAll2()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "add" name = "action2">
<p align = "center" ><?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'server1' value = " . $server . ">"); ?>
</form>

</body>
</html>