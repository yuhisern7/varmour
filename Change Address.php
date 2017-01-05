<?php
if (isset($_POST['servers'])) {
    $server = $_POST['servers'];
}
?>

<!DOCTYPE html>
<html>
<head>
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

function submitAll1()
{
    if (input.Name.value != "" && input.Address.value != "") {
        document.getElementById("input").submit();
        input.Name.value = "";
        input.Address.value = "";
    }
    else {
        alert("Fill in the information");
    }
}
</script>

<head>
    <title>Change Address</title>
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

<div id = "head"><b>CHANGE ADDRESS</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>

<p align = "center"><u><b>Change your address here</b></u></p>


<form name = "input" id = "input" action="http://10.150.12.175/webpageAddress.php" method="post">
<p align = "center"><b>Name:</b> <input type="text" name="Name" value=""><br>
<p align = "center"><b>Type:</b> <select name="type" id = "type">
<option value="ipv4">ipv4</option>
<option value="mac-address">mac-address</option>
<option value="hostname">hostname</option>
</select><button type="button" onclick="display()">FORMAT</button><br>
<p align = "center"><b>New Address:</b> <input type="text" name="Address" value=""><input type= "button" value = "RANDOM" onclick = "randomAddress(this.form)"> <br>

<p align = "center"><input type="button" value="CHANGE" onclick = "submitAll1()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "change" name = "action1">
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'server' value = " . $server . ">"); ?>
</form>


</body>
</html>