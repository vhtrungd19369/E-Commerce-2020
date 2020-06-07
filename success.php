<?php require_once "./inc/header.php";?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid']=='order')
	{
		$customer_id = Session::get('customer_id');
		$insertOrder = $cr->insertOrder($customer_id);
		$delCart = $cr->del_all_data_cart($customer_id);
		header('Location:success.php');
	}
?>

<style type="text/css">
p.success_note{
    text_align: center;
    color:#AE05D0;
	font-size: 17px;
}
</style>
<form action="" method="POST">
	<div class="main">
    	<div class="content">
    		<div class="section group">
				<h2>Success Order</h2>

                <center>
					<?php
						$customer_id = Session::get('customer_id');
						$get_amount = $cr->getAmountPrice($customer_id);
						if($get_amount){
							$amount = 0;
							while($result = $get_amount->fetch_assoc()){
								$price = $result['price'];	//from Cart --> Cart<-sql
								$amount += $price;		// Sum = ALL result 
							}
						}
					?>
					<p class = "success_note">
						Total Price You Have Bought From HoangKimStore:
							<?php
								$vat = $amount * 0.1;
								$total = $vat + $amount;
									echo $total.' '.'VNĐ.';
							?>

						<br>
						We will contact as soon as possible. Please see your order details here
						<a href="orderdetails.php">Click Here</a>					
					</p>
				</center>

			</div><!-- div section group -->
		</div><!-- div content -->
	</div> <!-- div main -->
</form>	

<?php
	require_once "./inc/footer.php";
?>