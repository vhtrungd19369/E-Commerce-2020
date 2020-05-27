<?php
	include "./inc/header.php";
	// include "./inc/slider.php";
?>
<?php
	$login_check = Session::get('customer_login');
    if($login_check == false){
		header('Location:login.php');
	}
?>
<?php
	// if(!isset($_GET['proid']) || $_GET['proid']==NULL)
	// {
	// 	echo "<script>window.location = '404.php'</script>";
	// }
	// 	else
	// 	{
	// 		$id = $_GET['proid'];
	// 	}	
    $id = Session::get('customer_id');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save']))
    {
       $UpdateCustomers = $cs->update_customers($_POST, $id);
    }
?>

<style>
.tblone {width: 450px; margin: 0 auto;}
.tblone tr td{ text-align: justify;}
</style>

<div class="main">
	<div class="content">
		<div class="section group">
				<div class="content_top">
         
					<div class="heading">
						<h3>Update Profile Customer</h3>
					</div>
    
					<div class="clear"></div>        
				</div>
                        
            <form action="" method="POST"> 
                <?php
                if(isset($UpdateCustomers))
                {
                    echo '<td colspan="3">'.$UpdateCustomers.'</td>';
                }
            ?>

           <?php
                $id = Session::get('customer_id'); 
                $get_customers = $cs->show_customers($id);
                if($get_customers)    
            {
                while($result = $get_customers->fetch_assoc())
            {
            ?>
                <table class="tblone">
                    <tr>
						<td colspan="3"><h2>Your Profile Details</h2></td>
					</tr>
				
               
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="name" value="<?php echo $result['name']?>"></td>
                        </tr> 

                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><input type="text" name="city" value="<?php echo $result['city']?>"></td>
                        </tr> 

                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><input type="text" name="zipcode" value="<?php echo $result['zipcode']?>"></td>
                        </tr> 

                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input type="password" name="password" value="<?php echo $result['password']?>"></td>
                        </tr> 

                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="address" value="<?php echo $result['address']?>"></td>
                        </tr>  

                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="3"><input type="submit" name="save" value="Save"></td>
                        </tr>
                </table>
             <?php               
             }
            }
            ?> 
            </form>    
 	    </div>
    </div>

<?php
	include "./inc/footer.php";
?>