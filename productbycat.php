<?php
	// require_once "./inc/connectinc.php";

	require_once "./inc/header.php";
	// require_once "./inc/slider.php";
?>
<?php
    $cat = new Category();
	if(!isset($_GET['catid']) || $_GET['catid']==NULL){
        echo "<script>window.location = '404.php'</script>";
    }else{
        $id = $_GET['catid'];
    }
    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// 	$catName = $_POST['catName'];
    //     $updateCat = $cat->update_caterogy($catName,$id);      
	// }  
?>

<div class="main">
    <div class="content">
		<!-- -------------------------------------------------- -->
		<?php 
			$name_cat = $cat->getcatbyId($id);
			if($name_cat){
				while($result_name = $name_cat->fetch_assoc()){
		?>
			<div class="content_top">
				<div class="heading">
					<h3>Category :  <?php echo $result_name['catName'] ?> </h3>
				</div>

				<div class="clear"></div>
			</div>
		<?php
			}
		}
		?>
		<!-- --------------------------------------------------------------- -->
		<div class = "section group">
			<?php
			$productbycat = $cat->get_product_by_cat($id);
			if($productbycat){
				while($result = $productbycat->fetch_assoc()){
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