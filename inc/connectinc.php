<?php
    require_once "lib/session.php";
    Session::init();
?>

<?php require_once 'lib/database.php';?>
<?php require_once 'helpers/format.php';?>
<?php spl_autoload_register
	(
		function($class)
		{
			require_once "classes/".$class.".php";
		}
	)
?>

<?php
	$db = new Database();
	$fm = new Format();
	$cr = new Cart();
	$us = new User();
	$ct = new Category();
	$product = new product();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>