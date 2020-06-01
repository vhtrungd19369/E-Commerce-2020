<?php require_once "./inc/header.php";?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
		$customer_id = Session::get('customer_id');
		$insertOrder = $cr->insertOrder($customer_id);
		$delCart = $cr->del_all_data_cart();
		header('Location:success.php');
	}
?>

<style type="text/css">
.box_left{
	width:50%;
	border:1px solid #666;
	float: left;
	padding: 4px;
}

.box_right{
	width:47%;
	bordoer: 1px solid #666;
	float: right;
	padding: 4px;
}

a.submit_order{
	width: 200px;
	margin:20px auto 0;
	text-align: center;
	padding: 5px;
	font-size:30px;
	display: block;
	background:#ff0000;
	color: #fff;
	border-radius: 3px;
}

</style>
<form action="" method="POST">
	<div class="main">
    	<div class="content">
    		<div class="section group">
				
				<div class="heading">
					<h3>Offline Payment</h3>
				</div>

				<div class="clear"></div>

				<div class="box_left"> 
					<div class="cartpage"> 
			    		<h2>Your Cart</h2>
						<?php
							if(isset($Update_quantity_cart)){
								echo $Update_quantity_cart;
							}
							if(isset($delcart)){
								echo $delcart;
							}
						?>

						<!-- ==================######===================== -->

						<table class="tblone">
							<tr>
								<th width="5%">Serial No.</th>
								<th width="15%">Product</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total</th>								
							</tr>
							
							<?php
							$get_product_cart = $cr->get_product_cart();
							if($get_product_cart)
							{
								$subtotal = 0;
								$qty = 0;
								$i = 0;
								while($result = $get_product_cart->fetch_assoc())
								{
									$i++;
								 ?>

									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result['productName'] ?></td>
										<td><?php echo $result['price'].' '.'VNĐ' ?></td>
										<td><?php echo $result['quantity']?></td>
										<td><?php $total = $result['price'] * $result['quantity'];
											echo $total.' '.'VNĐ';?>
										</td>
									</tr>

								 <?php
									$subtotal += $total; //giá trên header
									$qty = $qty + $result['quantity'];// sô lượng trên header
							 	}
							}	?>
						</table>	<!-- end-tblone-->

						<table style="float: right; text-align: left; margin: 5px" width="40%">	
							<?php
								$check_cart = $cr->check_cart();
									if ($check_cart){
								?>
									<tr>
										<th>Sub Total : </th>
										<td>
											<?php
												echo $subtotal.' '.'VNĐ';
												Session::set('sum', $subtotal);
												Session::set('qty', $qty);
											?>
										</td>
									</tr>

									<tr>
										<th>VAT</th>
										<td>10 % (<?php echo $vat = $subtotal * 0.1; ?>)</td>
									</tr>

									<tr>
										<th>Grand Total:</th>
										<td>
											<?php 
												$vat = $subtotal * 0.1;
												$gtotal = $subtotal + $vat;
												echo $gtotal.' '.'VNĐ';									
											?>
										</td>
									</tr>
								<?php
								}
								else{
									echo '<a href="index.php">You cart is Empty ! Please shopping Now . . .</a>';
								}
							?>
						</table>

					</div><!-- END-div cartpage -->
				</div><!-- END div - box_left -->

				<!-- ======================================= -->
			
				<div class="box_right">
					<div class="cartpage">
			    		<h2>Information</h2>
						
						<table class="tblone">
							<?php
							$id = Session::get('customer_id'); 
							$get_customers = $cs->show_customers($id);
							if($get_customers)
							{
								while($result = $get_customers->fetch_assoc())
								{
								?>
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
										<td><a href="editprofile.php">Update Profile</a></td>
									</tr>
						
								<?php	
								}	
							}	?>
						</table>		
					</div>	<!-- END div - cartpage -->
				</div>	<!-- END div - box_right -->

			   <!-- ============================================= -->
			
			</div><!-- div section group -->
		</div><!-- div content -->

			<!-- <input type="submit" class="submit_order" name="order" value="Order Now"> -->
		<center>
			<a href="?orderid=order" class="submit_order">Order Now</a>
		</center>
		
	</div> <!-- div main -->
</form>	


<?php
	require_once "./inc/footer.php";
?>