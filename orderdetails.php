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
	if(isset($_GET['customrId'])){
		$id			= $_GET['customrId'];
		$time		= $_GET['time'];
		$price		= $_GET['price'];
		$confirm	= $cr->productShiftConfirm($id, $time, $price);
	}
?>
<?php
	$login_check = Session::get('customer_login');
    if($login_check == false){
		header('Location:login.php');
	}
?>
<style type="text/css">
/* .box_left{
	width:100%;
	border:1px solid #666;
	padding: 4px;
} */
.tblone tr td{
	hight: 20px;
	line-height: 20px;
	text-align:center;
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

			 
					<div class="cartpage"> 
			    	
						<!-- ==================######===================== -->

						<table class="tblone">
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="20%">Price</th>
								<th width="5%">Quantity</th>
								<th width="25%">Date</th>
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
									<tr> <!--::::Row = 7 Frist::::-->
										<td><!--Row  SERIAL NO.--->
											<?php echo $i; ?>
										</td>

										<td><!--Row  PRODUCT NAME--->
											<?php echo $result['productName'] ?>
										</td>

										<td><!--Row  IMAGE--->
											<img src="admin/upload/<?php echo $result['image'] ?>" alt=""/>
										</td>

										<td><!--Row  PRICE--->
											<?php echo $result['price'].' '.'VNĐ' ?>
										</td>

										<td><!--Row  QUANTITY---->
											<?php echo $result['quantity']?>
										</td>

										<td><!--Row  DATE--->
											<?php echo $fm->formatDate($result['date_order'])?>
										</td>

										<td><!--Row  STATUS--->
											<?php
												if($result['status']=='0')
												{
													echo 'Pending...';
												}
												elseif($result['status']=='1')
												{
													echo 'Transported'; //VÂN CHUYỂN
												}
												else
												{
													echo "Delivered";
												}
											?>
										</td><!--End--Row = 7 Frist-->

										<?php  //-Row  ACTION-
											if($result['status'] == '1') { ?>
											<td>
												<a href="
													?customrId=<?php echo $result['id']; ?> &
													price=<?php 	echo $result['price']; ?> &
													time=<?php		echo $result['date_order']; ?>					
													">Confirm
												</a>
											</td>
												
										<?php } elseif ($result['status']=='2') { ?>
											<td>
												Received
											</td>

										<?php } elseif ($result['status']=='0') { ?>
											<td>
												N/A
											</td>
										<?php } ?> <!--end--Row  ACTION-->


									</tr>
								<?php
								}
							}	
							?>

						</table>

					</div><!-- END-div cartpage -->
			</div><!-- div section group -->
		</div><!-- div content -->	
	</div> <!-- div main -->
</form>	
<?php
	require_once "./inc/footer.php";
?>