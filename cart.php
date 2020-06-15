
<?php
	require_once "./inc/header.php";
?>

<?php
	$login_check = Session::get('customer_login');
	if($login_check == false){
		header('Location:login.php');
	}
?>

<?php
if(isset($_GET['cr_id']))
	{
		$cartid = $_GET['cr_id'];
		$delcart = $cr->Del_product_cart($cartid);
	}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
{	
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];	
	$Update_quantity_cart = $cr->Update_quantity_Cart($quantity, $cartId);
	if($quantity == 0)
	{
		$delcart = $cr->Del_product_cart($cartId);
        return $delcart;
	}
}
?>

<div class="main">
    <div class="content">
    	<div class="cartoption">	

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
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php
							$get_product_cart = $cr->get_product_cart();
							if($get_product_cart)
							{
								$subtotal = 0;
								$qty = 0;
								while($result = $get_product_cart->fetch_assoc())
								{ 
								 ?>

								 <tr>
									<td height=”100px″><?php echo $result['productName'] ?></td>
									<td height=”100px″><img src="admin/upload/<?php echo $result['image']?>" alt="" height=”100″ width=”100″ /></td>
									<td height=”100px″><?php echo $result['price'] ?></td>

									<td height=”100px″>
										<form action="" method="post">
											<input type="hidden" name="cartId" value="<?php echo $result['cartId']?>"/>
											<input type="number" name="quantity" min = "0" value="<?php echo $result['quantity'];?>"/>
											<input type="submit" name="submit" value="Update"/>
										</form>
									</td>

									<td height=”100px″>
										<?php
											$total = $result['price'] * $result['quantity'];
											echo $total;
										?>
									</td>

									<td height=”100px″><a onclick = "return confirm('Are you sure to dalete <?php echo $result['productName'] ?> ?')"
											href="?cr_id=<?php echo $result['cartId']?>">
											Delete
										</a>
									</td>
								 </tr>

							 	 <?php
									$subtotal += $total; //giá trên header
									$qty = $qty + $result['quantity'];// sô lượng trên header
							 	}
							}
							?>					
							
						</table>

						<table style="float:right;text-align:left;" width="40%">
						<?php
							$check_cart = $cr->check_cart();
  								if ($check_cart){
						 ?>
							
								<tr>
									<th>Sub Total : </th>
									<td><?php
											echo $subtotal;
											Session::set('sum', $subtotal);
											Session::set('qty', $qty);
										?>
									</td>
								</tr>
								<tr>
									<th>VAT : </th>
									<td>10 %</td>
								</tr>
								<tr>
									<th>Grand Total :</th>
									<td><?php 
											$vat = $subtotal * 0.1;
											$gtotal = $subtotal + $vat;
											echo $gtotal;									
										?>
									</td>
								</tr>
						<?php
						}else{
							echo '<a href="index.php">You want shopping Now . . .</a>';
						}
						?>
						</table>

				</div>

				<div class="shopping">
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
					<div class="shopright">
						<a href="payment.php"> <img src="images/check.png" alt="" /></a>
					</div>
				</div>
    		</div>  	
       		<div class="clear"></div>
    	</div>
	</div> 
<?php
	require_once "./inc/footer.php";
?>