<?php require_once "./inc/header.php";?>
<?php
	// if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
	// 	$customer_id = Session::get('customer_id');
	// 	$insertOrder = $cr->insertOrder($customer_id);
	// 	$delCart = $cr->del_all_data_cart();
	// 	header('Location:success.php');
	// }
?>
<?php
	$login_check = Session::get('customer_login');
    if($login_check == false){
		header('Location:login.php');
	}
?>
<style type="text/css">
.box_left{
	width:100%;
	border:1px solid #666;
	padding: 4px;
}

</style>
<form action="" method="POST">
	<div class="main">
    	<div class="content">
    		<div class="section group">
				
				<div class="heading">
					<h3>Your Details Ordered</h3>
				</div>

				<div class="clear"></div>

				<div class="box_left"> 
					<div class="cartpage"> 
			    		<h2>Your Cart</h2>
						<!-- ==================######===================== -->

						<table class="tblone">
							<tr>
								<th width="10%">No</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="10%">Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>	
							</tr>
							
							<?php
							$customer_id = Session::get('customer_id');
							$get_cart_ordered = $cr->get_product_order($customer_id);
							if($get_cart_ordered)
							{
								$i = 0;
								$qty = 0;
								while($result = $get_cart_ordered->fetch_assoc())
								{
									$i++;
								 ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result['productName'] ?></td>
										<td><img src="admin/upload/<?php echo $result['image'] ?>" alt=""/></td>
										<td><?php echo $result['price'].' '.'VNĐ' ?></td>
										<td><?php echo $result['quantity']?></td>
										<td><?php echo $fm->formatDate($result['date_order'])?></td>

										<td>
											<?php
											if($result['status']=='0'){
												echo 'Pending...';
											}else{
												echo 'Processed';
											}
											?>
										</td>

											<?php
												if($result['status'] =='0')
												{
												 ?>
													<td>
														<?php echo 'N/A';?>
													</td>
												<?php

												}
											else
											{
												?>	
													<td>
														<a onclick="return confirm('Are you want to delete?')" href="<?php echo $result['cartId']?>
															">Xóa
														</a>
													</td>
												<?php
											}
											?>
									</tr>
								 <?php
							 	}
							}	
							?>

						</table>

					</div><!-- END-div cartpage -->
				</div><!-- END div - box_left -->

			
			</div><!-- div section group -->
		</div><!-- div content -->

		
	</div> <!-- div main -->
</form>	


<?php
	require_once "./inc/footer.php";
?>