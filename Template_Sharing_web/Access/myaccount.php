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
	

	<link href="../css/footer.css" rel="stylesheet" type="text/css"/>
	<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	<link href="../css/myaccount.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">
	<script src="../script/sweetalert2.min.js"></script>
	<script src="../script/jquery.min.js"></script>
    <script src="../script/bootstrap.min.js"></script>
    <script src="../script/jquery.validate.min.js"></script>
    
</head>
<body>
	<?php 
	if (!isset($_SESSION['username'])) {
		# code...
		header("location:login.php");
	}
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


	


	
	 ?>
	<?php
			include('../Header_Footer/header.php');
	?>
	<!--code body-->
        <input type="text" value="<?php echo $_GET["memberID"]; ?>" id="none">
		<div class="container" id="myaccount">
						<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-justified" role="tablist" id="myTab">
			  <li class="active "><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
			  <li><a href="#changepass" role="tab" data-toggle="tab">Change Password</a></li>
			  
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane active in fade" id="profile">
			  	<form  method="post" id="info-form">
			  						<div class="form-group">
			                    		<label  >Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-control" id="form-username" readonly="readonly" value="<?php echo $row["Username"] ?>"> 
			                        </div>
									<div class="form-group">
			                    		<label >First Name</label>
			                        	<input type="text" name="firstname" placeholder="First name..." class="form-control" id="form-firstname"
			                        	value="<?php echo $row["FirstName"]   ?>">
			                        </div>
			                        <div class="form-group">
			                    		<label >Last Name</label>
			                        	<input type="text" name="lastname" placeholder="Last name..." class="form-control" id="form-lastname"
			                        	 value="<?php echo $row["LastName"] ?>">
			                        </div>
			                        <div class="form-group">
			                    		<label >Email</label>
			                        	<input type="email" name="email" placeholder="Email..." class="form-control" id="form-email" readonly="readonly"
			                        	value="<?php echo $row["Email"] ?>">
			                        </div>
			                        <button  type="submit" class="btn btn-success  btn-block" id="editbtn">Edit</button>
						                        
				</form>
				
				<div id="resultofedit"></div>
				<script type="text/javascript">
						    			$('#info-form').validate(
						    			{
						    				rules:{
						    					firstname:{
						    						required:true,
						    						maxlength:50

						    					},
						    					lastname:{
						    						required:true,
						    						maxlength:50
						    					},
						    					email:{
						    						
						    						maxlength:100,
						    						
						    					},
						    					

						    				},
						    				messages:{
						    					firstname:{
						    						required:"Please enter your first name",
						    						maxlength:"Max length of first name is 50"

						    					},
						    					lastname:{
						    						required:"Please enter your last name",
						    						maxlength:"Max length of last name is 50"
						    					},
						    					email:{
						    						
						    						maxlength:"Max length of email is 100"
						    						
						    					}
						    				},
						    				submitHandler:function(){
                                                                                        var urladmin = $('#none').val();
                                                                                        if(urladmin!=="")
                                                                                        {
						    					var url="editaccount.php?memberID=" + urladmin;
                                                                                        console.log(url);
                                                                                    }
	 										else
                                                                                            url="editaccount.php";
	 										var dta=$('#info-form').serializeArray();
	 										$.post(url,dta,function(data){
	 												$('#resultofedit').html(data);
	 											
							 					
	 											}
							 				);
						    					
								    		}
						    			});
						    			jQuery.validator.addMethod("email", function(value, element) {
									    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
									}, 'Please enter valid email address.');
							    	// 	$("#editbtn").click(function(event) {
							    	// 	/* Act on the event */
							    	// 	// $.ajaxSetup ({
							     //  //   		cache: false
							    	// 	// });
							    		
							    		
							    		
							    			
							    	// 		var url="editaccount.php";
							    			
	 										
	 										// var dta=$('#info-form').serializeArray();
	 										// $.post(url,dta,function(data){
	 										// 		$('#resultofedit').html(data);
	 											
							 					
	 										// 	}
							 				// );
							    		

						    		// });
						    	
						    	
				</script>		    
						    
			  </div>
			  <div class="tab-pane fade" id="changepass">
			  	<form  method="post" id="changepass-form" >
			  						<div class="form-group">
			                    		<label  >Current password</label>
			                        	<input type="password" name="currentpassword" placeholder="Current password..." class="form-control" id="currentpassword">
			                        </div>
									<div class="form-group">
			                    		<label >New password</label>
			                        	<input type="password" name="newpassword" placeholder="New password..." class="form-control" id="newpassword">
			                        </div>
			                        <div class="form-group">
			                    		<label >Confirm new password</label>
			                        	<input type="password" name="reconfirm" placeholder="Confirm new password..." class="form-control" 
			                        	id="reconfirm">
			                        </div>
			                        <button  type="submit" class="btn btn-success  btn-block" id="changebtn">Change</button>
			                        
			    </form>
			    
			    <div id="resultofpass"></div>
			    <script type="text/javascript">
						    			$('#changepass-form').validate(
						    			{
						    				rules:{
						    					currentpassword:{
						    						required:true,
						    						maxlength:50

						    					},
						    					newpassword:{
						    						required:true,
						    						maxlength:50
						    					},
						    					reconfirm:{
						    						required:true,
						    						maxlength:50,
						    						equalTo:"#newpassword"
						    					},

						    				},
						    				messages:{
						    					currentpassword:{
						    						required:"Please enter your current password",
						    						maxlength:"Max length of current password is 50"

						    					},
						    					newpassword:{
						    						required:"Please enter your new password",
						    						maxlength:"Max length of new password is 50"
						    					},
						    					reconfirm:{
						    						required:"Please confirm your new password",
						    						maxlength:"Max length of new password is 50",
						    						equalTo:"Please enter the same password as above"
						    					}
						    				},
						    				submitHandler:function(){
						    					var newpassword=$("#newpassword").val();
									    		var reconfirm=$("#reconfirm").val();
									    		if (newpassword != reconfirm) {
									    			alert("New password does not match the confirm password ");

									    		}
									   
									    		else
									    		{
									    			   var urladmin = $('#none').val();
                                                                                        if(urladmin!=="")
                                                                                        {
						    					var url="changepass.php?memberID=" + urladmin;
                                                                                        console.log(url);
                                                                                    }
	 										else
									    			var url="changepass.php";
									    			
			 										
			 										var dta=$('#changepass-form').serializeArray();
			 										$.post(url,dta,function(data){
			 												$('#resultofpass').html(data);
			 											
									 					
			 											}
									 				);
									    		}
								    		}
						    			});
							    		
						    	
						    	
				</script>
				
			  </div>
			  
			</div>
		</div>
	
	<?php
			include('../Header_Footer/footer.php');
	?>
</body>
</html>