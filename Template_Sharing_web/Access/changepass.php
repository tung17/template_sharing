<?php 
							session_start();
						   	$severname="localhost";
							$username="root";
							$password="";
							$dbname="template_sharing";
							$connect=mysqli_connect($severname,$username,$password,$dbname);
							$getuser=mysqli_query($connect,"SELECT * FROM member where Username='".$_SESSION['username']."'");
							$row=mysqli_fetch_array($getuser);
							
						    $currentpassword=$newpassword=$reconfirm="";
						    $currentpasswordErr=$newpasswordErr=$reconfirmErr=$checkpass="";
						    function test_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}
						   	
						   		# code...
						   		
								
					   		if (empty($_POST["currentpassword"])) {
								# code...
								$currentpasswordErr="username is not empty";
							} else {
								# code...
								$currentpassword=test_input($_POST["currentpassword"]);
								if (strlen($currentpassword)>50) {
									# code...
									$currentpasswordErr="max length of username is 50 ";
								}
								else{
									
										# code...
										

										if (password_verify($currentpassword,$row['Password'])==false) {
											# code...

											$currentpasswordErr="Current password does not match";
											echo "<script>swal(
												  'Oops...',
												  'Current password does not match',
												  'error'
												)</script>";
											
										}	

								}

							}
							if (empty($_POST["newpassword"])) {
								# code...
								$newpasswordErr="new password is not empty";
							} else {
								# code...
								$newpassword=test_input($_POST["newpassword"]);
								if (strlen($newpassword)>50) {
									# code...
									$newpasswordErr="max length of new password is 200 ";
								}
							}
							if (empty($_POST["reconfirm"])) {
								# code...
								$reconfirmErr="Re-enter is not empty";
							} else {
								# code...
								$reconfirm=test_input($_POST["reconfirm"]);
								if (strlen($reconfirm)>50) {
									# code...
									$reconfirmErr="max length of Re-enter is 200 ";
								}
							}
							if ($newpassword==$reconfirm) {
								# code...
								$checkpass=1;
							}
							else $checkpass=0;
							if ($currentpasswordErr=="" && $newpasswordErr=="" && $reconfirmErr=="" && $checkpass=1 ) {
								# code...
								$passwordEncode=password_hash($newpassword,PASSWORD_DEFAULT);
								mysqli_query($connect,
									"UPDATE member SET Password='".$passwordEncode."' WHERE Username='".$row['Username']."' ");
								echo "<script>swal({
													  position: 'center',
													  type: 'success',
													  title: 'Completed!',
													  showConfirmButton: true,
													  timer: 1500
													});
														</script>";
								

							}

								
						   		
						   	


			?>