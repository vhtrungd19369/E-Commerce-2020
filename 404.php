
<?php
	require_once "./inc/connectinc.php";
?>
<?php
    require_once "./inc/header.php";
    require_once "./inc/slider.php";
?>
<style>
.notfound{}
.notfound h2{
        font-size:100px;
        line-height:130px;
        text-align:center;
        }
.notfound h2 span{
        display:block;
        color:red;
        font-size:170px;
        }
</style>
<div class="main">
    <div class="content">
        <div class="section group">		
            <div class="notfound">
                <h2><span>404</span>Not Found</h2>
            </div>	
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php
    require_once "./inc/footer.php";
?>