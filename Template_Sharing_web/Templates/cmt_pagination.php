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

$test="";
$output="";
$per_page=5;
$templateID=$_POST["templateID"];
$memberid=$_POST["memberid"];
//echo $templateID;
$cmt_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT Count(CommentID) AS ROWS FROM user_comment Where TemplateID=$templateID"))["ROWS"];
$cmt_pages=ceil($cmt_count /$per_page);

if(isset($_POST["cur_page"]))
{
	$page=$_POST["cur_page"];
}
else
{
	$page=1;
}

if($page < 1){
    $page = 1;
}else if($page > $cmt_pages){
    $page = $cmt_pages;
}
$start=($page-1)*$per_page;
if($start<0)
    $start=0;
$query="SELECT * FROM user_comment Where TemplateID=$templateID ORDER BY CommentID Desc LIMIT $start,$per_page";
$res=mysqli_query($conn,$query) ;
if(mysqli_num_rows($res)!= 0){
    while ($row=mysqli_fetch_array($res)){
        $query="SELECT Username AS users FROM member Where MemberID=$row[4]";
        $cmt_owner="";
        $temp_res=mysqli_query($conn,$query);
        if(mysqli_num_rows($temp_res)!=0)
        {
          $cmt_owner = mysqli_fetch_assoc($temp_res)["users"];
          
        }
        $like_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT Count(LikeID) AS likes FROM like_comment Where CommentID=$row[0]"))["likes"];
        $check_love = mysqli_fetch_assoc(mysqli_query($conn,"SELECT Count(LikeID) AS love FROM like_comment Where CommentID=$row[0] and MemberID=$memberid"))["love"];
    	$output.="<div class=\"cmt-item\">
                <em>".$row[1]."</em>
                <strong>".$cmt_owner."</strong>
                <p>".$row[2]."</p>
                <div class=\"cmt-thumb\">
                  <span class=\"glyphicon glyphicon-heart ";
        if($check_love!=0)
        {
            $output.="loved";
        }
        $output.="\" id=\"like_".$row[0]."\"></span> <span class=\"cmt-likes\">".$like_count."</span>
                </div>
              </div>";
    }
}
$output.="<div style=\"clear:both\"></div>";
if($cmt_pages!=0)
{
    $output.='<div class="page-x">
              <div class="pagination">
                <a id="prevpagi">&laquo;</a>';

    foreach(range(1, $cmt_pages) as $i){
        // Check if we're on the current page in the loop
        if($i == $page){
            $output.="<a class=\"active pagination-item\" href=\"#\">".$i."</a>";
        }else if($i == 1 || $i == $cmt_pages || ($i >= $page - 2 && $i <= $page + 2)){
            $output.="<a class=\"pagination-item\" href=\"#\">".$i."</a>";
        }
    }
                
                
                
    $output.=   '<a id="nextpagi">&raquo;</a>
    			</div>
            </div>';
    }
echo $output;
mysqli_close($conn);
//echo $test;
?>