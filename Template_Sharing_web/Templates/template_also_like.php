<?php
 
?>
<div class="row">

        <div class="col-sm-12 suggest">
          <h3>You may also like</h3>
          <div class="row">
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
               if(isset($temp_name))
                {

                  $also_query="SELECT * FROM template Where TemplateID!= $tid and CategoryID=$cateID and KindID=$kindID ORDER BY RAND() LIMIT 4";
                  $res=mysqli_query($conn,$also_query) ;
                  if(mysqli_num_rows($res)!= 0){
                    while ($row=mysqli_fetch_array($res)){
                      echo"<div class=\"col-sm-3 col-xs-6 sug_image\"><br>";
                      echo"<a href=\"./template_item.php?tid=".$row[0]."\"><img class=\"img-responsive\" src=\"".$row[2]."\" alt=\"Template Preview\"><br>".$row[1]."</a></div>";                 
                    }
                  }
                }
              
                mysqli_close($conn);
            ?>
          </div>
        </div>

</div>