<div id="header">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<img src="../images/homepage/logo.svg" alt="" height="50"/>
		  <?php 
		  if (isset($_SESSION['username']))
		  {
		  echo '<strong style="color:white;">HELLO</strong>';
		  }
		  ?>
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		</div>
		<div class="navbar-collapse collapse" id="main-menu">
			<ul class="nav navbar-nav">
				<li><a href="../Homepage/homepage.php" class="btn btn-lg"><span class="glyphicon glyphicon-home fa-lg"></span></a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><strong>TEMPLATES</strong><span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="../Templates/?mode=0"><strong>WEB TEMPLATES</strong></a></li>
					<li><a href="../Templates/?mode=1"><strong>PRESENTATION TEMPLATES</strong></a></li>
				  </ul>
				</li>
                                <?php 
                                if(isset($_SESSION["is_admin"]))
                                if ($_SESSION["is_admin"]==TRUE)
                                    echo '<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><strong>ADMIN</strong><span class="caret"></span></a>
				  <ul class="dropdown-menu">
                                        <li><a href="../Admin_Pages/list_member.php"><strong>LIST OF MEMBERS</strong></a></li>
					<li><a href="../Admin_Pages/resources_management.php"><strong>LIST OF TEMPLATES</strong></a></li>
				  </ul>
				</li>';
                                ?>
			</ul>
			<ul class="nav navbar-nav">
			<li>
			<div class="search" align="center">
					<div class="all-item">
						<select>
							<option>Web</option>
							<option>Presentation</option>
						</select>
					</div>
				<div class="drop_contend">
					<input id="contend" type="text" name="search" value="" placeholder="search" onkeyup="showHint(this.value)">
				  <div class="contend">
					  <p id="txtHint">
						  
					  </p>
				  </div>
				</div>
					<a href="#" id="search"><img src="../images/homepage/search.png"></a>
			</div>
			</li>
			</ul>
		  <ul class="nav navbar-nav navbar-right">
                          <?php 
			  if (isset($_SESSION['username']))
                          {
                            echo '<li><a href="../Access/myaccount.php"><strong>PROFILE</strong></a></li>';
                            echo '<li><a href="../Admin_Pages/sign_out.php"><span class="glyphicon glyphicon-off"></span><strong>SIGN OUT</strong></a></li>';
                          }
			  else 
                            {
                                echo '<li style="float: right;"><a href="../Access/login.php"><span class="glyphicon glyphicon-user"></span> <strong>SIGN IN</strong></a></li>';
                            }                      
			  ?>
		  </ul>
		</div>
	</nav>
</div>
<script>
            var test =document.getElementsByTagName("select");
            var contend = document.getElementById("contend");
            var search=document.getElementById("search");
    function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        if(test[0].value == "Web")
        xmlhttp.open("GET", "../Homepage/showhint_template.php?x=Web&q=" + str, true);
        else
         xmlhttp.open("GET", "../Homepage/showhint_template.php?x=Presentation&q=" + str, true);   
        xmlhttp.send();
    }   
}
function take_data(data)
{
    var x = document.getElementById(data);
    var y = document.getElementById("contend");
    y.value = x.innerHTML;
    document.getElementById("txtHint").innerHTML = "";
}
search.onclick = function()
{
    if(test[0].value == "Web")
    {
        search.href = "../Templates/search_result.php?mode=0&name=" + contend.value;
    }
    else
    {
        search.href = "../Templates/search_result.php?mode=1&name=" + contend.value;
    }
}
</script>        