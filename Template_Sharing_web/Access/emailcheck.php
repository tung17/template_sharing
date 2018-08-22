<?php 
	$severname="localhost";
	$username="root";
	$password="";
	$dbname="template_sharing";
	$connect=mysqli_connect($severname,$username,$password,$dbname);
	$getall=mysqli_query($connect,"SELECT * FROM member");
	
	function test_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
							}
	function generateRandomString() {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 10; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	$email=$emailErr=$checkemail=$newpassword="";						
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

										
										$checkemail="1";

										break;
										
										
										
									}
									
								}
							}
					}	
		    		
						
				}
		
	if ($emailErr=="" && $checkemail=="1") {
					# code...
		
		$newpassword=generateRandomString();
		$passwordEncode=password_hash($newpassword,PASSWORD_DEFAULT);
		mysqli_query($connect,"UPDATE member SET Password='".$passwordEncode."' WHERE Email='".$email."' ");
		 require "PHPMailer/src/PHPMailer.php";
	    
	    require "PHPMailer/src/SMTP.php";
	    
	    
		
	    $nFrom = "no-reply@tempshare.com";    //mail duoc gui tu dau, thuong de ten cong ty ban
	    $mFrom = 'template4share@gmail.com';  //dia chi email cua ban 
	    $mPass = 'template123';       //mat khau email cua ban
	    
	    $mTo = $email;   //dia chi nhan mail
	    $mail = new PHPMailer\PHPMailer\PHPMailer();
	    $body             = 'Hello!<br>
	    We received a request to reset your account password.<br>
	    <strong>New password</strong>:'.$newpassword."<br>Please don't reply this email";   // Noi dung email
	    $title = 'Password Reset';   //Tieu de gui mail
	    $mail->IsSMTP();             
	    $mail->CharSet  = "utf-8";
	    $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
	    $mail->SMTPAuth   = true;    // enable SMTP authentication
	    $mail->SMTPSecure = "tls";   // sets the prefix to the servier
	    $mail->Host       = "smtp.gmail.com";    // sever gui mail.
	    $mail->Port       = 587;         // cong gui mail de nguyen
	    // xong phan cau hinh bat dau phan gui mail
	    $mail->Username   = $mFrom;  // khai bao dia chi email
	    $mail->Password   = $mPass;              // khai bao mat khau
	    $mail->SetFrom($mFrom, $nFrom);
	    $mail->Subject    = $title;// tieu de email 
	    $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
	    $mail->AddAddress($mTo);
	    // thuc thi lenh gui mail 
	    if(!$mail->Send()) {
	        echo "<script>swal(
				  'Oops...',
				  'Something went wrong!',
				  'error'
				)</script>";
	         
	    } else {
	         
	       
	        echo "<script>swal({
													  position: 'center',
													  type: 'success',
													  title: 'please check your email to get your new password',
													  showConfirmButton: true,
													  timer: 2500
													});
														</script>";
	    }




		}
	else{
		
		echo "<script>swal(
															  'Oops...',
															  'No account found with that email address',
															  'error'
															)</script>";
	}





 ?>
 