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
$commentID=$_POST["commentID"];
$memberid=$_POST["memberid"];
$lovetype=$_POST["type"];
if($lovetype=="love")
{
	$temp_res=mysqli_query($conn,"SELECT * FROM like_comment Where CommentID=$commentID");
	if(mysqli_num_rows($temp_res)!=0)
	{
		$temp_res=mysqli_query($conn,"SELECT * FROM like_comment Where CommentID=$commentID and MemberID=$memberid");
		if(mysqli_num_rows($temp_res)==0)
		{
			
			$result = mysqli_query($conn, "INSERT INTO like_comment(MemberID,CommentID) VALUES('$memberid','$commentID')");
		}
		
		
	}
	else{
		$result = mysqli_query($conn, "INSERT INTO like_comment(MemberID,CommentID) VALUES('$memberid','$commentID')");
	}
}
else
{
	$result = mysqli_query($conn, "DELETE FROM like_comment Where CommentID=$commentID and MemberID=$memberid");
}


mysqli_close($conn);

	//header("Location: web_template_item.php"); 
?>