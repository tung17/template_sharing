<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/access.css">
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">
	<script src="../script/jquery.min.js"></script>
	<script src="../script/bootstrap.min.js"></script>
	<script src="../script/sweetalert2.min.js"></script>
	<link href="../css/footer.css" rel="stylesheet" type="text/css"/>
	<link href="../css/header.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<?php 
	if (isset($_SESSION['username'])) {
		# code...
		header("location:../Homepage/homepage.php");
	}
	$severname="localhost";
	$username="root";
	$password="";
	$dbname="template_sharing";
	$connect=mysqli_connect($severname,$username,$password,$dbname);

	$getall=mysqli_query($connect,"SELECT * FROM member");
	 ?>
	<?php
			include('../Header_Footer/header.php');
	?>
	<div id="login">
		<div class="inner-bg">
			<div class="container">
				 <div class="row">
	                        <div class="col-sm-8 col-sm-offset-2 text-center text">
	                            <h1><strong>Great to have you back!</strong></h1>
	                            <div class="description">
	                            	<p style="color: white">
		                            	You can sign in to this website with your existing  account
	                            	</p>
	                            </div>
	                        </div>
	                    </div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to our site</h3>
	                            		<p>Enter your username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                        		<div style="clear: both;"></div>
	                            </div>
	                    <div class="form-bottom">        
							<form  method="post" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			                    	<div class="form-group">
			                    		<label >Username</label>
			                        	<input type="text" name="username"  class=" form-control" id="username" required="required" maxlength="50">
			                        </div>
			                        <div class="form-group">
			                        	<label >Password</label>
			                        	<input type="password" name="password"  class=" form-control" id="password" required="required"
			                        	maxlength="50">
			                        </div>
			                       	<input type="hidden" name="redirurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
			                        <div class="dropdown" id="dropdown-login">
									  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-link">
									    Option
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dLabel">
									    <li><a href="register.php">Register</a></li>
									    <li class="divider"></li>
									    <li><a href="forgotpass.php">Forgot password</a></li>
									  </ul>
									</div>
			                       	

			                        <button type="submit" class="btn btn-success btn-block btnform" >Login!</button>

						    </form>
						    <?php 
						    $username=$password=$checklogin=$url="";
						    function test_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}
						   	if ($_SERVER["REQUEST_METHOD"]=="POST") {
						   		# code...
						   		$username=test_input($_POST["username"]);
						   		$password=test_input($_POST["password"]);
						   		while ($check=mysqli_fetch_array($getall)) {
											# code...
											if ($username==$check['Username'] && password_verify($password,$check['Password'])==true) {
												# code...
												$getuser=mysqli_query($connect,"SELECT * FROM member where Username='".$username."'");
												$row=mysqli_fetch_array($getuser);
												$_SESSION["signed_in"]=true;
												$_SESSION["is_admin"]=$row['IsAdmin'];
												$_SESSION["username"]=$username;
												$_SESSION["f_name"]=$row["FirstName"];
												$_SESSION["l_name"]=$row["LastName"];
												$_SESSION["memberid"]=$row["MemberID"];
												if(isset($_REQUEST['redirurl'])) 
													   $url = $_REQUEST['redirurl']; // holds url for last page visited.
													else 
													   $url = "../Homepage/homepage.php"; // default page for 
												

													
												$checklogin=1;
												
												
											}


											
										}
								if ($checklogin!=1) {
									# code...
									echo "<script>swal(
										  'Oops...',
										  'Username or Password do not match',
										  'error'
										)</script>";
								}
								else {
													echo "<script>swal({
													  position: 'center',
													  type: 'success',
													  title: 'Logged in successfully',
													  showConfirmButton: true,
													  timer: 1500
													}).then(function(){
														window.location.href = '".$url."';
													}
												);
														</script>";
									

									

									

									
									


								}

						   	}


						     ?>
						</div>
					</div>
				</div>
				 <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login text-center">
                        	<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-1 btn-link-1-facebook" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-1 btn-link-1-twitter" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>

                        	</div>
                        </div>
                    </div>
			</div>
		</div>
	</div>
	<?php
			include('../Header_Footer/footer.php');
	?>
</body>
</html>