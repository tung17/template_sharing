<?php 
				session_start();
				$severname="localhost";
				$username="root";
				$password="";
				$dbname="template_sharing";
				$connect=mysqli_connect($severname,$username,$password,$dbname);
                                if(isset($_GET["memberID"])&&($_SESSION['is_admin']==TRUE))
                                $getuser=mysqli_query($connect,"SELECT * FROM member where MemberID='".$_GET["memberID"]."'");
                                else
				$getuser=mysqli_query($connect,"SELECT * FROM member where Username='".$_SESSION['username']."'");
				$row=mysqli_fetch_array($getuser);
				
				$firstname=$lastname=$email="";
				$firstnameErr=$lastnameErr=$emailErr=$checkemail="";
				function test_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}
				
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
				// if (empty($_POST["email"])) {
				// 	# code...
				// 	$emailErr="email is not empty";
				// } else {
				// 	# code...
				// 	$email=test_input($_POST["email"]);
					
				// 	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  //     			$emailErr = "Invalid email format"; 
		  //   			}
		  //   		else{
		  //   			if (strlen($email)>100) {
				// 		# code...
				// 		$emailErr="max length of email is 100 ";
				// 		}
				// 		else{

				// 					$getall=mysqli_query($connect,"SELECT * FROM member");
									
				// 					while ($emailLoop=mysqli_fetch_array($getall)) {
				// 					# code...
									
				// 					if ($email==$emailLoop['Email']) {
				// 						# code...


				// 						$checkemail="The email is already in use";
				// 						echo "<script>alert('The email is already in use') </script>";
										
				// 					}
				// 				}
				// 			}
				// 	}	
		    		
						
				// }
				if ($firstnameErr=="" && $lastnameErr=="" ) {
					# code...
					mysqli_query($connect,
						"UPDATE member SET FirstName='".$firstname."',LastName='".$lastname."'
						 WHERE Username='".$row['Username']."' ");
					
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