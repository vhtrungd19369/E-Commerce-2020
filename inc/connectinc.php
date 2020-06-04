
<?php
    require_once "lib/session.php";
    Session::init();
?>
<?php require_once 'lib/database.php';?>
<?php require_once 'helpers/format.php';?>
<?php
spl_autoload_register(
	function($class){ require_once "classes/".$class.".php"; }
)
?>

<?php
	$db = new Database();
	$fm = new Format();
	$cr = new Cart();
	$us = new User();
	$ct = new Category();
	$cs = new Customer();
	$product = new product();
?>

<?php
	if(isset($_GET['customer_id'])){
	$delCart = $cr->del_all_data_cart();
		Session::destroy();
	}
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>