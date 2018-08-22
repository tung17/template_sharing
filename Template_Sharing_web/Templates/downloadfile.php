<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname="template_sharing";

//connection to the database
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$templateID=$_GET["templateID"];

$temp_res=mysqli_query($conn,"SELECT * FROM template Where TemplateID=$templateID");
if(mysqli_num_rows($temp_res)!=0)
{
	
	$row = mysqli_fetch_assoc($temp_res);
	$file=$row["DownloadLink"];
	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    ob_clean();
	    flush();
	    readfile($file);
	    exit;
	}
	else{
		die('file not found');
	}
}
mysqli_close($conn);
?>