<html>
<head>

<title>Client SOAP</title>
<style type=text/css>
		


</style>

</head>
<body background ="background.jpg">
<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
?>
<input type="button" id="BACK" value="BACK" onclick="location.href = 'http://ec2-54-169-41-122.ap-southeast-1.compute.amazonaws.com/topic/index.html';" class="btn btn-default"/>
<!-- EDIT SERVICE -->
<h1> Edit Book By Name Service </h1>
<?php
  	if($_POST['submit_edit'] == "Submit") {
		$from_name=$_POST['from_name'];
		$to_name=$_POST['to_name'];
        $client = new nusoap_client("http://ec2-54-169-41-122.ap-southeast-1.compute.amazonaws.com/topic/WebServiceServer.php?wsdl",true); 
        $params = array(
			'from_name'=>$from_name,
			'to_name'=>$to_name
			);
        $data = $client->call("EditXML",$params); 
        echo $data;
    }
?>
<form method="POST">
	<p>From Book Name: 
	<INPUT type="text" name="from_name" size="50" maxlength="100">
	TO:
	<INPUT type="text" name="to_name" size="50" maxlength="100"> </p>
	<INPUT type="submit" name="submit_edit" value="Submit">
	<br>
	
</form>
<!-- EDIT SERVICE -->

</body>
</html>
