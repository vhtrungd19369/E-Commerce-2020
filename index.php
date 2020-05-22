<?php
	require_once "./inc/header.php";
	require_once "./inc/slider.php";
?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
<!--Feature Products-->
		<?PHP
		$product_featherd = $product->getproduct_feathered();
			if($product_featherd){
				while($result = $product_featherd ->fetch_assoc()){
		?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?proid=<?php echo $result['productId'] ?>">
					<img src="admin/upload/<?php echo $result['image']?>" alt="" />
				</a>
				<h2>
					<?php echo $result['productName']?>
				</h2>
				<p>
					<?php echo $fm->textShorten($result['product_desc'], 50)?>
				</p>
				<p>
					<?php echo $result['price']." "."VND"?>
				</p>
				<div class="button">
					<span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details" >
					Details
					</a></span>
				</div>
			</div>
		<?PHP
			}
		}
		?>		
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
<!--New Products-->
		<?PHP
			$product_new = $product->getproduct_new();
			if($product_new){
				while($result= $product_new->fetch_assoc()){
		?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?proid=<?php echo $result['productId'] ?>">
					<img src="admin/upload/<?php echo $result['image']?>" alt="" />
				</a>
				<h2>
					<?php echo $result['productName']?>
				</h2>
				<p>
					<?php echo $fm->textShorten($result['product_desc'], 50)?>
				</p>
				<p>
					<?php echo $result['price']." "."VND"?>
				</p>

				<div class="button">
					<span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details" >
						Details
					</a></span>
				</div>
				
			</div>
		<?PHP
				}
			}
		?>		
			</div>
    </div>
 </div>
<?php
	require_once "./inc/footer.php";
?>