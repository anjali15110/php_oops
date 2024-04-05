<?php
	include './include/crud.php';
	
	
		$show = new Show();
		$fetch = $show->showdata('crud');
		//print_r($fetch);
	
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$deleted = new Deleted();
		$data = $deleted->deleteddata('crud',$id);
		if($data){
			header('Location:show.php');
		}else{
			echo 'Data not deleted';
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>OOPS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		
	</style>
</head>
<body>
	
	
	<div class="container mt-5">
		<table class="table table-border">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Status</th>
					<th>Created Date</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			<tbody>
			<?php
				while($data = mysqli_fetch_assoc($fetch)){
			?>
				<tr>
					<td><?= $data['id']; ?></td>
					<td><?= $data['name']; ?></td>
					<td><?= $data['email']; ?></td>
					<td><?= $data['phone']; ?></td>
					<td><?= $data['status']; ?></td>
					<td><?= $data['createddate']; ?></td>
					<td><a href="update.php?id=<?= $data['id']; ?>" class="btn btn-info text-light">Edit</a></td>
					<td><a href="show.php?id=<?= $data['id']; ?>" class="btn btn-danger text-light">Delete</a></td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
	
	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	
	
	
</body>
</html>