<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'?>
<?php
    $brand = new Brand();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delbrand = $brand->del_brand($id);
	} 
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>brand List</h2>
                <div class="block">
					<?php 
                        if(isset($delbrand)){
                            echo $delbrand;
                        }
                    ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_brande = $brand->show_brand();
							if($show_brande){
								$i=0;
								while($result = $show_brande->fetch_assoc()){
									$i++;					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName'] ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId']?>">Edit</a>
							 || <a onclick = "return confirm('Are you sure to delete: <?php echo $result['brandName']?> ? ')" href="?delid=<?php echo $result['brandId']?>">Delete</a></td>
						</tr>
						<?php
					}
						}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>