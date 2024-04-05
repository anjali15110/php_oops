<?php
	include './include/crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OOPS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		.red{
			border-color: #fe8686!important;
			box-shadow: 0 0 0 0.25rem rgb(253 13 13 / 25%)!important;
		}
		
		.green:focus{
			border-color: #86fead!important;
			box-shadow: 0 0 0 0.25rem rgb(41 181 6 / 25%)!important;
		}
	</style>
</head>
<body>
	<div class="container mt-5">
		<form action="index.php" method="POST">
			<div class="mb-3">
					<label for="name" class="form-label">Name:</label>
					<input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
					<div id="valid_name"></div>
			  </div>
			  <div class="mb-3 mt-3">
					<label for="email" class="form-label">Email:</label>
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
					<div id="valid_email"></div>
			  </div>
			  <div class="mb-3 mt-3">
					<label for="phone" class="form-label">Phone:</label>
					<input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
					<div id="valid_phone"></div>
					<div id="valid_phone_limit"></div>
			  </div>
			  <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
			  <button type="reset" class="btn btn-primary" >Reset</button>
		</form>
	</div>
	<div class="alert alert-success text-center" id="alertdata">
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function(){
			
			$('#name, #email, #phone').on('input', function() {
				$(this).closest('.mb-3').find('div').html('');
				$(this).removeClass('red').addClass('green');
			});
			
			$('#phone').on('input', function() {
					var phoneNumber = $(this).val();
					var limit = 10;

					if (phoneNumber.length > limit) {
						$(this).removeClass('green');
						$(this).addClass('red');
						$(this).closest('.mb-3').find('#valid_phone_limit').html('Phone number cannot exceed ' + limit +'characters').css("color","red");
						return false;
					} else {
						$('#valid_phone_limit').html('');
						$('#valid_phone_limit').removeClass('green');
					}
				});
		
			
			$('#submit').click(function(){
				var name = $('#name').val();
				var email = $('#email').val();
				var phone = $('#phone').val();
				
				
				if(name == ''){
					$('#valid_name').html('Please enter your name').css("color","red");
					$('#valid_name').siblings('input').addClass('red');
					return false;
				}else if(email == ''){
						$('#valid_email').html('Please enter your email').css("color","red");
						$('#valid_email').siblings('input').addClass('red');
						return false;
					}else if(phone == ''){
						$('#valid_phone').html('Please enter your phone number').css("color","red");
						$('#valid_phone').siblings('input').addClass('red');
						return false;
					}
			})
			
			$('#alertdata').hide();
			
		});
	</script>
	
	<?php
		if(isset($_POST['submit'])){
			// $name = $_POST['name'];
			// $email = $_POST['email'];
			// $phone = $_POST['phone'];
			// $date = date('Y-m-d');
			
			$data = [
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'phone' => $_POST['phone'],
				'createddate' => date('Y-m-d')
			];
			
			$create = new Create();
			$insertdata = $create->insertdata($data);
			if($insertdata){
				echo '<script>';
				echo "$('#alertdata').show();";
				echo "$('#alertdata').html('Data Submit Successfully');";
				echo "setTimeout(function(){
					$('#alertdata').remove();
				},3000)";
				echo '</script>';
				echo '<script>';
				echo "setTimeout(function(){
					<?php header('Location:index.php'); ?>
				},3000)";
				echo '</script>';
			}else{
				echo 'Data not saved';
			}
		}
	?>
	
</body>
</html>