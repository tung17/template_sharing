<?php 
session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/access.css">
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">
	<script src="../script/jquery.min.js"></script>
	<script src="../script/sweetalert2.min.js"></script>
	<script src="../script/bootstrap.min.js"></script>
	<link href="../css/footer.css" rel="stylesheet" type="text/css"/>
	<link href="../css/header.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<?php 

	$severname="localhost";
	$username="root";
	$password="";
	$dbname="template_sharing";
	$connect=mysqli_connect($severname,$username,$password,$dbname);

	
	 ?>
	<?php
			include('../Header_Footer/header.php');
	?>
	<div id="login">
		<div class="inner-bg">
			<div class="container">
				 <div class="row">
	                        <div class="col-sm-8 col-sm-offset-2 text-center text">
	                            <h1><strong>Great to see you here!</strong></h1>
	                            <div class="description">
	                            	<p style="color: white">
		                            	Create an account to browse all items
	                            	</p>
	                            </div>
	                        </div>
	                    </div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                        		<div style="clear: both;"></div>
	                            </div>
	                    <div class="form-bottom">        
							<form  method="post" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group">
			                    		<label >First Name</label>
			                        	<input type="text" name="firstname" placeholder="First name..." class="form-control" id="form-firstname" required="required" maxlength="50"
			                        	value="<?php
			                        	if($_SERVER["REQUEST_METHOD"]=="POST") 
			                        	echo $_POST['firstname']; ?>" 
			                        	>
			                        </div>
			                        <div class="form-group">
			                    		<label >Last Name</label>
			                        	<input type="text" name="lastname" placeholder="Last name..." class="form-control" id="form-lastname"
			                        	required="required" maxlength="50"
										value="<?php
			                        	if($_SERVER["REQUEST_METHOD"]=="POST") 
			                        	echo $_POST['lastname']; ?>"
			                        	>
			                        </div>
			                        <div class="form-group">
			                    		<label >Email</label>
			                        	<input type="email" name="email" placeholder="Email..." class="form-control" id="form-email"
			                        	required="required" maxlength="100"
										value="<?php
			                        	if($_SERVER["REQUEST_METHOD"]=="POST") 
			                        	echo $_POST['email']; ?>"
			                        	>
			                        </div>
			                    	<div class="form-group">
			                    		<label  >Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-control" id="form-username"
			                        	required="required" maxlength="50"
										value="<?php
			                        	if($_SERVER["REQUEST_METHOD"]=="POST") 
			                        	echo $_POST['username']; ?>"
			                        	>
			                        </div>
			                        <div class="form-group">
			                        	<label> Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class=" form-control" id="form-password"
			                        	required="required" maxlength="50"
										value="<?php
			                        	if($_SERVER["REQUEST_METHOD"]=="POST") 
			                        	echo $_POST['password']; ?>"
			                        	>
			                        </div>
			                        <div class="form-group">
			                    		<label  >Re-enter</label>
			                        	<input type="password" name="reEnter" placeholder="Re-enter..." class="form-control" id="form-re-enter"
			                        	required="required" maxlength="50"
										value="<?php
			                        	if($_SERVER["REQUEST_METHOD"]=="POST") 
			                        	echo $_POST['reEnter']; ?>"
			                        	>
			                        </div>
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
			                       
			                        <button type="submit" class="btn btn-success btn-block btnform" id="register">Register!</button>
						                        
						    </form>
						    <script type="text/javascript">
						    	
							    		$("#register").click(function(event) {
							    		/* Act on the event */
							    		var password=$("#form-password").val();
							    		var reEnter=$("#form-re-enter").val();
							    		if (password != reEnter) {
							    			
							    			swal(
												  'Oops...',
												  'Password does not match the confirm password ',
												  'error'
												);

							    		}

						    		});
						    	
						    	
						    </script>
						    <?php 
							$firstname=$lastname=$email=$username=$password=$reEnter=$checkpass=$checkuser=$checkemail="";
							$firstnameErr=$lastnameErr=$emailErr=$usernameErr=$passwordErr=$reEnterErr="";
							function test_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}

							if ($_SERVER["REQUEST_METHOD"]=="POST") {
								# code...
								if (empty($_POST["firstname"])) {
									# code...
									$firstnameErr="first name is not empty ";
								} else {
									# code...
									$firstname=test_input($_POST["firstname"]);
									if (strlen($firstname)>50) {
										# code...
										$firstnameErr="max length of firstname is 50  ";
									}
								}
								if (empty($_POST["lastname"])) {
									# code...
									$lastnameErr="last name is not empty";
								} else {
									# code...
									$lastname=test_input($_POST["lastname"]);
									if (strlen($lastname)>50) {
										# code...
										$lastnameErr="max length of last name is 50 ";
									}
								}
								if (empty($_POST["username"])) {
									# code...
									$usernameErr="username is not empty";
								} else {
									# code...
									$username=test_input($_POST["username"]);
									if (strlen($username)>50) {
										# code...
										$usernameErr="max length of username is 50 ";
									}
									else{
										$getall=mysqli_query($connect,"SELECT * FROM member");
										while ($checkusername=mysqli_fetch_array($getall)) {
											# code...

											if ($username==$checkusername['Username']) {
												# code...


												$checkuser="The username is already in use";
															echo "<script>swal(
															  'Oops...',
															  'The username is already in use',
															  'error'
															)</script>";
												
											}
										}
									}

								}
								if (empty($_POST["password"])) {
									# code...
									$passwordErr="password is not empty";
								} else {
									# code...
									$password=test_input($_POST["password"]);
									if (strlen($password)>50) {
										# code...
										$passwordErr="max length of password is 200 ";
									}
								}
								if (empty($_POST["reEnter"])) {
									# code...
									$reEnterErr="Re-enter is not empty";
								} else {
									# code...
									$reEnter=test_input($_POST["reEnter"]);
									if (strlen($reEnter)>50) {
										# code...
										$reEnterErr="max length of Re-enter is 200 ";
									}
								}
								if ($password==$reEnter) {
									# code...
									$checkpass=1;
								}
								else $checkpass=0;
								if (empty($_POST["email"])) {
									# code...
									$emailErr="email is not empty";
								} else {
									# code...
									$email=test_input($_POST["email"]);
									
									if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						      			$emailErr = "Invalid email format"; 
						    			}
						    		else{
							    			if (strlen($email)>100) {
											# code...
											$emailErr="max length of email is 100 ";
											}
											else{

													$getall=mysqli_query($connect,"SELECT * FROM member");
													
													while ($emailLoop=mysqli_fetch_array($getall)) {
													# code...
													
													if ($email==$emailLoop['Email']) {
														# code...


														$checkemail="The email is already in use";
														echo "<script>swal(
															  'Oops...',
															  'The email is already in use',
															  'error'
															)</script>";
														
													}
												}
											}
									}	
						    		
										
								}
								if ($checkpass==1 && $checkuser==""&& $checkemail=="" && $firstnameErr == "" && $lastnameErr == "" && $emailErr == "" && $usernameErr == "" && 
									$passwordErr == "" && $reEnterErr == "" ) {
									# code...
									$JoinDate=date("Y/m/d");
									$IsAdmin=0;
									$passwordEncode=password_hash($password,PASSWORD_DEFAULT);

									$check=mysqli_query($connect,"INSERT INTO member (JoinDate,IsAdmin,FirstName,LastName,Email,Username,Password)
									 VALUES ('".$JoinDate."','".$IsAdmin."','".$firstname."','".$lastname."','".$email."'
									 ,'".$username."','".$passwordEncode."')");
									echo "<script>swal({
													  position: 'center',
													  type: 'success',
													  title: 'Completed',
													  showConfirmButton: true,
													  timer: 1500
													}).then(function(){
														window.location.href = 'login.php';
													}
												);
														</script>";




								}
								
								


								
							}


							 ?>


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