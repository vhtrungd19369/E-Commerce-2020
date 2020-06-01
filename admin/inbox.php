<?php require 'inc/header.php';?>
<?php require 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
	require_once ($filepath.'/../classes/cart.php');
	require_once ($filepath.'/../helpers/format.php');
	$cr= new Cart();
	$fm = new Format();
?>

<?php
	if(isset($_GET['shiftid'])){
		$id			= $_GET['shiftid'];
		$time		= $_GET['time'];
		$price		= $_GET['price'];
		$shift		= $cr->productShifted($id, $time, $price);
	}
	
	if(isset($_GET['delproid'])){
		$id			= $_GET['delproid'];
		$time		= $_GET['time'];
		$price		= $_GET['price'];
		$delOrder	= $cr->delProductShifted($id, $time, $price);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php
						if(isset($shifted)){
							echo $shifted;
						}

						if(isset($delOrder)){
							echo $delOrder;
						}
					?>
                <div class="block">				  
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Order Time</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Cust. ID</th>
								<th>Address</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// $cr = new Cart();
							// $fm = new Format();
							$getOrder = $cr->getAllOrderProduct();
							if($getOrder)
							{
								$i = 0;
								while($result = $getOrder->fetch_assoc())
								{$i++;
							?>
								<tr class="odd gradeX">
									<!--+++++++++++++++++--Row = 7 Frist-+++++++++++++++++++++++++++++++++++++++++++-->
																
									<td><!--Row  SERIAL NO--->
										<?php echo $i; ?>
									</td>

									<td><!--Row  ORDER TIME--->
										<?php echo $fm->formatDate($result['date_order']) ?>
									</td>

									<td><!--Row  PRODUCT NAME--->
										<?php echo $result['productName']?>
									</td>

									<td><!--Row  QUANTITY--->
										<?php echo $result['quantity'] ?>
									</td>

									<td><!--Row  PRICE--->
										<?php echo $result['price'].' '.'VNĐ' ?>
									</td>

									<td><!--Row  CUSTOMER_ID----->
										<?php echo $result['customer_id'] ?>
									</td>
									
									<td><!--Row  ADDRESS-->
										<a href="customer.php?customerid=<?php echo $result['customer_id'] ?>
											">View Address
										</a>
									</td><!--::::End--Row = 7 Frist ::::::::-->

										<?php if($result['status']=='0') {?><!---Row  ACTION---->
										<td>
											<span><a href="
													?shiftid=<?php	echo $result['id']; ?>
													&price=<?php 	echo $result['price']; ?>
													&time=<?php		echo $result['date_order']; ?>					
													">Shifting <!--Đợi xửa lý sang vận chuyển-->
												</a></span> 
											</td>

										<?php } elseif($result['status']=='1') { ?>

											<td>
												Transport
												<!-- Đang vận chuyển -->
											</td>

										<?php } else { ?>
											
											<td>
												<a onclick = "return confirm('Are you sure to delete: <?php echo $result['productName'] ?> ?')" href="
														?delproid=<?php	echo $result['id']; ?>
														&price=<?php 	echo $result['price']; ?>
														&time=<?php		echo $result['date_order']; ?>					
														">Remove <!-- Xóa -->
											</td>
										
										<?php } ?>	
									  </tr>
								 <?php
							 	}
							}
							?>
							
						</tbody>
					</table>
			   </div> <!-- <div class="block"> -->
			</div> <!-- <div class="box round first grid"> -->
		</div> <!-- <div class="grid_10"> -->
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
