<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
	require_once ($filepath.'/../classes/customer.php');
	require_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cs = new Customer();
	if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
        echo "<script>window.location = 'inbox.php'</script>";
    }else{
        $id = $_GET['customerid'];
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
            
               <div class="block copyblock">
                   
                <?php
                $get_customer = $cs->show_customers($id);
                if($get_customer)
                {
                    while($result = $get_customer->fetch_assoc())
                    {
                     ?>
                     <form action ="" method="post">
                        <table class="form">					
                            <tr>
                                <td>Name : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="name" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Phone : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="phone" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>City : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" name="city" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Address : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" name="address" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Gender : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['gender'] ?>" name="gender" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Zipcode : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" name="zipcode" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>Email : </td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="email" class="medium" />
                                </td>
                            </tr>

                        </table>
                     </form>
                     <?php   
                    }
                }
              ?>
            
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>