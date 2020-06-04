<?php
	include "./inc/header.php";
?>

<?php
$filepath = realpath(dirname(__FILE__));
	require_once ($filepath.'./classes/cart.php');
	require_once ($filepath.'./helpers/format.php');
	$cr = new Cart();
	$product = new product();
	$fm = new Format();
?>

<?php
if(!isset($_GET['proid']) || $_GET['proid']==NULL)
{
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['proid']; 
}


// $customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
{
	$quantity = $_POST['quantity'];	
	$AddtoCart = $cr->add_to_cart($quantity, $id);
}


$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare']))
{
	$proId = $_POST['productid'];	
	$insertCompare = $product->insertCompare($proId, $customer_id);
}

?>

<div class="main">
    <div class="content">
    	<div class="section group">
		<div class="cont-desc span_1_of_2">

			<?PHP
			$get_product_details = $product->get_details($id);
			if($get_product_details)
			{
				while($result_details = $get_product_details->fetch_assoc())
				{
				 	?>
						<div class="grid images_3_of_2">
							<img src="admin/upload/<?php echo $result_details['image']?>" alt="" />
						</div>

						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?></h2>
							<p><?php echo $fm->textShorten($result_details['product_desc'], 80) ?></p>					
							
						<div class="price">
							<p>Price:<span><?php echo $result_details['price']." "."VND" ?></span></p>
							<p>Category:<span><?php echo $result_details['catName'] ?></p>
							<p>Brand:<span><?php echo $result_details['brandName'] ?></p>
						</div>

						<div class="add-cart">
							<form action="" method="POST">
								<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							</form>	
						</div>

						<!--   style = "color:red; font-size:18px;" -->
			
						<span>
							<?php
							if(isset($AddtoCart))
							{
								echo $AddtoCart;
							}
							?>
						</span>	

						<span>
							<?php
							if(isset($insertCompare))
								{
									echo $insertCompare;
								}
							?>
						</span>	

						<div class="add-cart">
							<form action="" method="POST">
								<input type="hidden" class="buyfield" name="productid" value="<?php echo $result_details['productId']; ?>"/>
								<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
							</form>
						</div>
					
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $fm->textShorten($result_details['product_desc'], 2000) ?></p>
						</div>
				
					<?PHP 
				}
			} ?>
			</div>

			<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
						$get_category = $ct->show_category_frontend();
							if($get_category){
								while($result_allcat = $get_category->fetch_assoc()){
						?>			
							<li><a href="productbycat.php?catid=<?php echo $result_allcat['catId']?>"><?php echo $result_allcat['catName']?></a></li>
						<?php
							}
						}
						?>
    				</ul>    	
 			</div>
 		</div>
 	</div>
</div>
<?php
	include "./inc/footer.php";
?>