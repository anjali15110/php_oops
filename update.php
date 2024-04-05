<?php
	include './include/crud.php';
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		//echo $id;
		$edit = new Edit();
		$fetch = $edit->editdata('crud',$id);
		$data = mysqli_fetch_assoc($fetch);
		//print_r($data);
	}
	
?>

<?php
	if(isset($_POST['submit'])){
		$data = [
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'phone' => $_POST['phone'],
			'updateddate' => date('Y-m-d')
		];
		
		$id = $_POST['id'];
		
		$update = new Update();
		$updatedata = $update->updatedata('crud', $data, $id);
		
		if($updatedata){
			header('Location:show.php');
		}else{
			echo 'Data not saved';
		}
	}
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
		<?php
			if(isset($_GET['id'])){
		?>
		<form action="update.php" method="POST">
			<div class="mb-3">
					<label for="name" class="form-label">Name:</label>
					<input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?= $data['name']; ?>">
					<div id="valid_name"></div>
			  </div>
			  <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>">
			  <div class="mb-3 mt-3">
					<label for="email" class="form-label">Email:</label>
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $data['email']; ?>">
					<div id="valid_email"></div>
			  </div>
			  <div class="mb-3 mt-3">
					<label for="phone" class="form-label">Phone:</label>
					<input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="<?= $data['phone']; ?>">
					<div id="valid_phone"></div>
					<div id="valid_phone_limit"></div>
			  </div>
			  <button type="submit" class="btn btn-primary" id="update" name="submit" >Submit</button>
		</form>
		<?php
			}
		?>
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
			
		});
	</script>

	
</body>
</html>