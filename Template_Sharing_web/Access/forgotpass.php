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
	<link rel="stylesheet" type="text/css" href="../css/forgotpass.css">
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="../css/header.css"/>
	<script src="../script/sweetalert2.min.js"></script>

	<script src="../script/jquery.min.js"></script>
    <script src="../script/bootstrap.min.js"></script>
    <script src="../script/jquery.validate.min.js"></script>
	
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
	                            <h1><strong>Having trouble signing in?</strong></h1>
	                            
	                        </div>
	                    </div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Forgot Password</h3>
	                            		<p> We'll send you a message with your new password  </p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-envelope-o"></i>
	                        		</div>
	                        		<div style="clear: both;"></div>
	                            </div>
	                    <div class="form-bottom">        
							<form  method="post" id="email-form">
									
			                        <div class="form-group">
			                    		<label >Email</label>
			                        	<input type="email" name="email" placeholder="Email..." class="form-control" id="form-email"
			                        	required="required" maxlength="100">
			                        </div>
			                    	
			                       
			                        <button type="submit" class="btn btn-success btn-block" id="register">Send!</button>
						                        
						    </form>
						    <div id="resultofemail"></div>
						    <script type="text/javascript">
						    			$('#email-form').validate(
						    			{
						    				rules:{
						    					
						    					email:{
						    						
						    						maxlength:100,
						    						
						    					}
						    					

						    				},
						    				messages:{
						    					
						    					email:{
						    						
						    						maxlength:"Max length of email is 100"
						    						
						    					}
						    				},
						    				submitHandler:function(){
						    					var url="emailcheck.php";
							    			
	 										
	 											var dta=$('#email-form').serializeArray();
	 											$.post(url,dta,function(data){
	 											$('#resultofemail').html(data);
	 											
							 					
	 											}
							 				);
						    					
								    		}
						    			});
						    			jQuery.validator.addMethod("email", function(value, element) {
									    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
									}, 'Please enter valid email address.');
							    		
						    	
						    	
				</script>
						    
						    


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