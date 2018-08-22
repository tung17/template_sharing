<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Template</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/template.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <script src="../script/jquery.min.js"></script>
  <script src="../script/bootstrap.min.js"></script>
  
</head>
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
$file_name=basename(__FILE__, '.php');
$params["tid"]=$tid=$_GET["tid"];
$params["mode"]="";
$params["cate"]="";
$temp_query="SELECT * FROM template Where TemplateID=$tid";
$temp_res=mysqli_query($conn,$temp_query);
$temp_name;
$download_count=0;

if(mysqli_num_rows($temp_res)!=0)
{
  $row = mysqli_fetch_assoc($temp_res);
  $temp_name=$row["Name"];
  $link=$row["DownloadLink"];
  $download_count=$row["DownloadCounter"];
  $kindID=$row["KindID"];
  $cateID=$row["CategoryID"];
  $params["mode"]=(int)$row["KindID"]-1;
  $params["cate"]=$row["CategoryID"];
}
else{
  //ko co tid
}
mysqli_close($conn);
?>
<body id="temp_body">
	<?php
    include('../Header_Footer/header.php');
    $mode = $params['mode'];
    $cate = $params['cate'];
    echo "
      <script>
        var params = { 'mode': $mode, 'cate': $cate };
      </script>
    ";
  ?>
  
  <div id="content" class="container-fluid template_container">
    <div class="row">
      <div id="filter-side"></div>
        <script>
        $.post('./filter-side.php', { 'params': params }).done(function(result){
          $('#filter-side').replaceWith(result);
          });
        </script>
      <div class="col-sm-8 col-md-10">
        <div class="row">
          <?php
            include("./path-line.php");
          ?>
          
        </div>
        <div class="row">
          <div class="col-sm-12 temp_name">
            <h2><strong><?php echo $temp_name;?></strong></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 temp_image">
            
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active">
                  <img src="<?php echo $link ?>" alt="Preview Image #1" style="height: 100%; width: 100%;">
                  <div class="carousel-caption">
                    <p>Preview Image #1</p>
                  </div>
                </div>

                <div class="item">
                  <img src="<?php echo $link ?>" alt="Preview Image #2" style="height: 100%;width: 100%;">
                  <div class="carousel-caption">
                    <p>Preview Image #2</p>
                  </div>
                </div>

                <div class="item">
                  <img src="<?php echo $link ?>" alt="Preview Image #3" style="height: 100%;width: 100%;">
                  <div class="carousel-caption">
                    <p>Preview Image #3</p>
                  </div>
                </div>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            
            <!--
            <img class="img-responsive " src="img/wt1_1.jpg" alt="Template 1 Preview">
            <p>Preview Image #1</p>
            <img class="img-responsive " src="img/wt1_2.jpg" alt="Template 2 Preview">
            <p>Preview Image #2</p>
            <img class="img-responsive " src="img/wt1_3.jpg" alt="Template 3 Preview">
            <p>Preview Image #3</p>-->
          </div>
          <div class="col-sm-6 temp_decs">
            <br>
            <strong>Features</strong>
            <ul>
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
                 

                  $des_query="SELECT * FROM template_description Where TemplateID= $tid";
                  $res=mysqli_query($conn,$des_query) ;
                  if(mysqli_num_rows($res)!= 0){
                    while ($row=mysqli_fetch_array($res)){

                      echo"<li>".$row[1]."</li>";
                           
                    }
                  }
                  
                
                  mysqli_close($conn);
              ?>
              
            </ul>
            <div id="dl_btn">
              <button type="button" class="btn btn-success">
                <?php if(isset($_SESSION['username'])){
                        

                          echo"Download";
                        
                      }
                      else
                        echo"Login to Download";
                ?>
                
              </button>
            </div>
            <div id="dl_num">
              <p><span class="glyphicon glyphicon-download-alt"></span> <?php echo $download_count ?></p>

            </div>
            

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-md-8 col-sm-11 cmt">
      <h3><span class="glyphicon glyphicon-comment"></span> Comment</h3>
      <div class="commlist">
        <div id="cmts"> 
          
        </div>
        
        <form  action="#" method="post" id="cmt_form">

          <label class="cmtLabel">Type your comment</label>
          <textarea name="user_cmt" id="txtComment" maxlength="500"></textarea>
          <?php
            if (isset($_SESSION['username']))
            {
              echo "<input class=\"cmtBtn\" type=\"submit\" value=\"Send\">";
            }
            else
            {
              echo "<input class=\"cmtBtn\" type=\"submit\" value=\"Login to send\">";
            }
          ?>
          
        </form>
      </div>
    </div>
  
    <?php
      include "template_also_like.php";
    ?>

    
  </div>

	<?php include("../Header_Footer/footer.php"); ?>
<script>
  function load_comments(page){   
    $.ajax({
           type: "POST",
           url: "../Templates/cmt_pagination.php",
           data: { cur_page:page,memberid:<?php 
            if (isset($_SESSION['username'])) 
              echo $_SESSION["memberid"]; 
            else echo "1";?>,templateID:tempid}, // serializes the form's elements.
           success: function(data)
           {
               $("#cmts").html(data);
           }
         });
  }
  <?php
    if (isset($_SESSION['username']))
    {
      echo '
      $(document).on("click", ".glyphicon-heart", function() {
      var tmp=this.id.split("_");
      var t = parseInt(tmp[1]);
      $.ajax({
             type: "POST",
             url: "../Templates/processlike.php",
             data: { memberid: '.$_SESSION["memberid"].',commentID: tmp[1],type:"love"}, 
             success: function(data)
             {
                 //alert(data); // show response from the php script.
                 $("#parentid").val(t);
                load_comments($(".pagination-item.active").text());
             }
           });
      });
      $(document).on("click", ".glyphicon-heart.loved", function() {
          var tmp=this.id.split("_");
          var t = parseInt(tmp[1]);
          $.ajax({
                 type: "POST",
                 url: "../Templates/processlike.php",
                 data: { memberid: '.$_SESSION["memberid"].',commentID: tmp[1],type:"unlove"}, 
                 success: function(data)
                 {
                    $(this).removeClass("loved");
                    $("#parentid").val(t);
                    load_comments($(".pagination-item.active").text());
                     //alert(data); // show response from the php script.
                 }
               });
          $("#parentid").val(t);
          load_comments($(".pagination-item.active").text());          
      });';
    }
  ?>
    $(document).on("click", "#dl_btn button", function(e) {
      <?php
        if (isset($_SESSION['username']))
          echo "window.location = 'downloadfile.php?templateID='+tempid;";
        else
          echo"window.location.href = \"../Access/login.php\";";
      ?>
    });
    $(document).on("submit", "#cmt_form", function(e) {
      e.preventDefault();
      <?php
        if (isset($_SESSION['username']))
        {

          echo '
          $.ajax({
                   type: "POST",
                   url: "../Templates/processcmt.php",
                   data: { memberid:'. $_SESSION["memberid"] .', content: $(\'#txtComment\').val(),tid: tempid }, 
                   success: function(data)
                   {
                       load_comments(1);//alert(data); // show response from the php script.
                   }
                 });
            $("#txtComment").val("");';
        }
        else
          echo"window.location.href = \"../Access/login.php\";";
       ?> 
         
    });

$(document).on("click", ".cmtLabel", function() {
  $("#cmt_form").addClass("activ");
  
  });
$(document).on("blur", "#txtComment", function() {
  setTimeout(function() {
            $("#cmt_form").removeClass("activ");
        }, 5000);
  
  
  });



$(document).ready(function(){
  load_comments(1);
  
})
$(document).on("click", ".pagination-item", function(e) {
  e.preventDefault(); 
  //$("#cmt_form").addClass("activ");
  var x=$(this).text();
  load_comments(x);
  });
$(document).on("click", "#nextpagi", function(e) {
  var x=$(this).siblings(".active").text();
  var x=parseInt(x)+1;
  load_comments(x);
  });
$(document).on("click", "#prevpagi", function(e) {
  var x=$(this).siblings(".active").text();
  var x=parseInt(x)-1;
  load_comments(x);
  });
</script>
<script type="text/javascript">var tempid=<?php echo $tid?> ;</script>


</body>

</html>