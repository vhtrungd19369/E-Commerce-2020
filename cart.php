
<?php
	require_once "./inc/connectinc.php";
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
	if($quantity == 0){
		$delcart = $cr->Del_product_cart($cartId);
        return $delcart;
		}
		
}
?>

<?php
	require_once "./inc/headerCart.php";
	// require_once "./inc/slider.php";
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
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								while($result = $get_product_cart->fetch_assoc()){ 
								?>
								<tr>
									<td><?php echo $result['productName'] ?></td>
									<td><img src="admin/upload/<?php echo $result['image']?>" alt=""/></td>
									<td><?php echo $result['price'] ?></td>
									<td>
										<form action="" method="post">
											<input type="hidden" name="cartId" value="<?php echo $result['cartId']?>"/>
											<input type="number" name="quantity" min = "0" value="<?php echo $result['quantity'];?>"/>
											<input type="submit" name="submit" value="Update"/>
										</form>
									</td>
									<td>
										<?php
											$total = $result['price'] * $result['quantity'];
											echo $total;
										?>
									</td>
									<td><a onclick = "return confirm('Are you sure to dalete <?php echo $result['productName'] ?> ?')"
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
						<?php
							$check_cart = $cr->check_cart();
  								if ($check_cart){
						?>
							<table style="float:right;text-align:left;" width="40%">
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
							</table>

							<table style="float:right;text-align:left;" width="40%">
								<!-- <div> Vỏ Hàng </div> -->
								<div class="shopping_cart">
									<div class="cart">
										<a href="#" title="View my shopping cart" rel="nofollow">
											<span class="cart_title">Cart</span>
											<span class="no_product">
											
												<?php
												$check_cart = $cr->check_cart();
													if ($check_cart){
														$sum = Session::get("sum");
														$qty = Session::get("qty");
														echo $sum.' '.'vnđ'.'  || '.'Qty:'.$qty; //$qty bên trang cart.php
													}else{
														echo 'Emply';
													}
												?>
											
											</span>
										</a>
									</div>
								</div>
							</table>

						<?php
						}else{
							echo 'You cart is Empty ! Please shopping Now . . .';
						}
						?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div> 
<?php
	require_once "./inc/footer.php";
?>