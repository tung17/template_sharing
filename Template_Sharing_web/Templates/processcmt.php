<meta charset="utf-8">
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
$memberid=$_POST["memberid"];
$content=$_POST["content"];
$tid=$_POST["tid"];
if(strlen($content)>0){
	$result = mysqli_query($conn, "INSERT INTO user_comment(Content,TemplateID,MemberID) VALUES('$content','$tid','$memberid')");
}
mysqli_close($conn);

	//header("Location: web_template_item.php"); 
?>