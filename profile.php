<?php
	include "./inc/header.php";
?>
<?php
	$login_check = Session::get('customer_login');
    if($login_check == false){
		header('Location:login.php');
	}
?>

<style>
.tblone {width: 450px; margin: 0 auto;}
.tblone tr td{ text-align: justify;}
</style>

<div class="main">
	<div class="content">
		<div class="section group">
				<div class="content_top">
         
					<div class="heading">
						<h3>Profile Customer</h3>
					</div>
    
					<div class="clear"></div>        
				</div>
				
			<?php
				$id = Session::get('customer_id'); 
				$get_customers = $cs->show_customers($id);
				  if($get_customers)
				{
			 	while($result = $get_customers->fetch_assoc())
		  		{
			 ?>
				<table class="tblone">
					<tr>
						<td colspan="3"><h2>Your Profile Details</h2></td>
					</tr>
				
					<tr>
						<td width="20%">Name</td>
						<td width="5%">:</td>
						<td><?php echo $result['name']?></td>
					</tr> 

					<tr>
					   <td>City</td>
						<td>:</td>
						<td><?php echo $result['city']?></td>
					</tr> 

					<tr>
						<td>Zipcode</td>
						<td>:</td>
						<td><?php echo $result['zipcode']?></td>
					</tr> 

					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $result['email']?></td>
					</tr> 

					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $result['address']?></td>
					</tr>  

					<tr>
						<td>Gender</td>
						<td>:</td>
						<td><?php echo $result['gender']?></td>
					</tr>

					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $result['phone']?></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td colspan="3"> <a href="editprofile.php">Update Profile</a></td>
					</tr>
				</table>
			
			<?php
			}
			}
			?>  

		</div>
	</div>
</div>
<?php
	include "./inc/footer.php";
?>