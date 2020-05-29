<?php
	require_once "./inc/connectinc.php";
?>

<!DOCTYPE HTML>
<head>
<title>HOÀNG-KIM Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  	<div class="wrap">

  		<!-- DIV header_top  -->
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>

			<div class="header_top_right">

			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>

			  	<!--  Vỏ Hàng -->
				<div class="shopping_cart">
					<div class="cart">
						<a  href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
  								<!-- xu li box -->
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
								<!-- END- xu li box-->
							</span>
						</a>
					</div>
			    </div>
				<!--  END - Vỏ Hàng -->
			
				<div class="login">
				
					<!-- <a href="login.php">Login</a> -->
					<?php
						$login_check = Session::get('customer_login');
						if($login_check == false)
						{	?>
							<a href="login.php">LogIn</a>
							<?php
						}
						else 
					 	{ ?>
							<a href="?customer_id=<?php Session::get('customer_id')?>">LogOut</a>	
						 <?php
						} 
					?>
								
				</div>

		 		<div class="clear"></div>

	 		</div><!-- DIV header_top_right  -->
	
	  		<div class="clear"></div>
 		</div>
		<!-- DIV header_top  -->
									
		<div class="menu">
		<ul id="dc_mega-menu-orange" class="dc_mm-orange">
			<li><a href="index.php">Home</a></li>
			<li><a href="products.php">Products</a> </li>
			
			<?php
			$check_cart = $cr->check_cart();
			if($login_check == true){
				echo '<li><a href="cart.php">Cart</a></li>';
			}else{
				echo '';
			}
			?>

			<?php
			$customer_id = Session::get('customer_id');
			$check_order = $cr->check_order($customer_id);
			if($login_check == true){
				echo '<li><a href="orderdetails.php">Ordered</a></li>';
			}else{
				echo '';
			}
			?>

			<?php
			$login_check = Session::get('customer_login');
			if($login_check == false){
				echo '';
			}else{
				echo '<li><a href="profile.php">Profile</a></li>';
			}
			?>
				<li><a href="contact.php">Contact</a> </li>
			<div class="clear"></div>
		</ul>
		</div>