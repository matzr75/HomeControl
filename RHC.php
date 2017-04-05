<html>
<head>
<link href="Reinagl.css" rel="stylesheet" type="text/css">
</head>
<body>
<script>
function loadDoc(call) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", call, true);
  xhttp.send();
}

</script>
<div id="Navigation">
	<?php include("RHC_Navigation.php");?>
</div>
<div id="Content">
</div>

</body>
</html>
