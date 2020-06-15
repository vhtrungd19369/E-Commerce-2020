<?php
	// require_once "./inc/connectinc.php";

	require_once "./inc/header.php";
	// require_once "./inc/slider.php";
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$key = $_POST['keyword'];
        $search_product = $product->search_product($key);      
	}  
?>

<div class="main">
    <div class="content">
		<!-- -------------------------------------------------- -->

			<div class="content_top">
				<div class="heading">
					<h3>Category :  <?php echo $key ?> </h3>
				</div>

				<div class="clear"></div>
			</div>
	
		<!-- --------------------------------------------------------------- -->
		<div class = "section group">
			<?php
			if($search_product){
				while($result = $search_product->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a><img src="admin/upload/<?php echo $result['image']?>" width="200px" alt="" /></a>
					<h2><?php echo $result['productName']?> </h2>
					<p><?php echo $fm->textShorten($result['product_desc'],50);?></p>
					<p><span class="price"><?php echo $result['price'].' '.'VNĐ'?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
				}
			}	else
				{
				echo 'Category Not Avaiable';
				}
			?>
		</div>

		<!-- ------------------------------------------------------------ -->
    </div>
</div>

<?php
	require_once "./inc/footer.php";
?>