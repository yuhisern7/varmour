<?php
if (isset($_POST['servers'])) {
    $server = $_POST['servers'];
}
?>

<!DOCTYPE html>
<html>
<head>
<script language="JavaScript" type="text/javascript">

function add()
{
    var name = input.Name.value;
    var okay = false;
    var unique = true;
    for(i=0; i<document.getElementById("Names").length; i++)
    {
        var val = document.getElementById("Names")[i].value;
        if(name == val)
        {
            unique = false;
        }
    }
    if (name != "" && unique)
    {
        okay = true;
    }
    if(okay)
    {
        var item = name;
        var newOption = document.createElement("option");
        newOption.text = item;
        newOption.value = item;
        var select = document.getElementById("Names");
        select.add(newOption); 
        input.Name.value = "";
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

function remove()
{
  var elSel = document.getElementById('Names');
  var i;
  for (i = elSel.length - 1; i>=0; i--)
  {
    if (elSel.options[i].selected)
    {
      elSel.remove(i);
    }
  }
}

function submitAll2()
{
    var select1 = document.getElementById('Names');
    if (select1.options.length > 0) {
        var val = new Array();
        for(var i=0; i < select1.options.length; i++)
        {
            val.push(select1.options[i].value);
        }
        input.values.value = val.join(";");
        input.Name.value = "";
        document.getElementById("Name").disabled = true;
        document.getElementById("input").submit();
        document.getElementById("Name").disabled = false;
    }
    else {
        alert("Add a name of an address to delete");
    }
}
</script>
<head>
    <title>Delete Address</title>
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

<div id = "head"><b>DELETE ADDRESS</b></div>
<div id = "home"><a href="http://10.150.12.175/default.html">HOME</a></div>

<p align = "center"><u><b>Delete your address here</b></u></p>

<form name = "input" id = "input" action="http://10.150.12.175/webpageAddress.php" method="post">
<p align = "center"><b>Name (Add to box):</b> <input type="text" id= "Name"  name="Name" value=""><br>

<p align = "center"><B><u>Names</u></B> <br>
<p align = "center"><select id="Names" size="4" multiple = "multiple" style="width:300px">
</SELECT>

<p align = "center"><input type="button" value="ADD" onclick="add()"><input type="button" value="REMOVE" onclick="remove()"><input type="button" value = "DELETE" onclick = "submitAll2()">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "" name = "values">
<p align = "center" ><br> <input style = "visibility:hidden" type = "text" value = "delete" name = "action2">
<p align = "center" ><?php echo("<br><input type = 'text' style = 'visibility:hidden' name = 'server1' value = " . $server . ">"); ?>
</form>

</body>
</html>