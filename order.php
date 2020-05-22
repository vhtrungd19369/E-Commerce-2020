<?php
    require_once "./inc/header.php";
    //require_once "./inc/slider.php";
?>
<?php
	$login_check = Session::get('customer_login');
	if($login_check == false){
		header('Location:login.php');
	}
?>
<style>
.order_page{}
.order_page h2{
        font-size:100px;
        line-height:130px;
        text-align:center;
        }
.order_page h2 span{
        display:block;
        color:red;
        font-size:170px;
        }
</style>
<div class="main">
    <div class="content">
        <div class="section group">		
            <div class="order_page">
                <h2><span>Order</span>Page</h2>
            </div>	
        </div>  	
        <div class="clear"></div>
    </div>
</div> 
<?php
    require_once "./inc/footer.php";
?>
