
<?php
	require_once "./inc/header.php";
?>



<?php
$customer_id = Session::get('customer_id');
if(isset($_GET['proid']))
	{
		$productid = $_GET['proid'];
		$del = $product->Del_tbl_compare($productid, $customer_id);
	}
?>

<div class="main">
    <div class="content">
    	<div class="cartoption">	

		<div class="cartpage">
			<h2>Compare</h2>
				<table class="tblone">
					<tr>
						<th width="10%">No.</th>
						<th width="30%">Product Name</th>
						<th width="25%">Image</th>
						<th width="20%">Price</th>
						<th width="20%">Address</th>
						<th width="20%">Action</th>
					</tr>
					<?php
					$customer_id = Session::get('customer_id');
					$get_compare = $product->get_compare($customer_id);
					if($get_compare)
					{ 
						$i = 0;
						while($result = $get_compare->fetch_assoc())
						{  $i++;
							?>

							<tr>
								<td><?php echo $i ?></td>
								<td><a href="details.php?proid=<?php echo $result['productId']?>"></a><?php echo $result['productName'] ?></td>
								<td><img src="admin/upload/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo $result['price'] ?></td>

								<td>
									<a href="details.php?proid=<?php echo $result['productId']?>">
										View
									</a>
								</td>

								<td>
									<a onclick = "return confirm('Are you sure to dalete <?php echo $result['productName'] ?> ?')"
										href="?proid=<?php echo $result['productId']?>">
										Delete
									</a>
								</td>
							</tr>

						<?php
						}
					}
					?>	
				</table>
			</div> <!-- <div class="cartpage"> -->

			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			
			</div>
    	</div>  	
		
       	<div class="clear"></div>
    </div>
</div> 
<?php
	require_once "./inc/footer.php";
?>