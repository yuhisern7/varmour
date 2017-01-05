<?php
if (isset($_POST['servers'])) {
    $server = $_POST['servers'];
}
?>

<!DOCTYPE html>
<html>
<head>
<script language="JavaScript" type="text/javascript">

function submitAll1()
{
     document.getElementById("see").submit();
}
</script>
<head>
    <title>See Address</title>
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
<div id = "head"><b>SEE ADDRESS</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>

<p align = "center"><u><b>View your address here</b></u></p>

<form name = "see" id = "see" action="http://10.150.12.175/webpage.php" method="post">
<p align = "center"><b>Type:</b> <select name="type", id = "type">
<option value="address">address</option>
<option value="address_group">address groups</option>
</select><input type="button" value = "VIEW" onclick = "submitAll1()"><br><br>
<p align = "center" > <?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'server' value = " . $server . ">"); ?>
</form>


</body>
</html>