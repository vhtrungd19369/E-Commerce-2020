<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../lib/database.php');
    require_once ($filepath.'/../helpers/format.php');
?>

<?php

class Cart{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();

        $productName    = $result['productName'];
        $price          = $result['price'];
        $image          = $result['image'];

            // TEST Product Already Added !!!
        $check_query = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $get_Pro = $this->db->select($check_query);
        if($get_Pro){
            $msg = "<span class='success'>
                        Product Already Added !
                    <span>";
            return $msg;
        }
        else
        {

            $query = "INSERT INTO tbl_cart
                            (
                                sId, productId, productName, price, quantity, image
                            )
                    VALUES
                            (
                                '$sId', '$productId', '$productName', '$price', '$quantity', '$image'
                            )
                ";
            
            $insert_cart = $this->db->insert($query);
            if($insert_cart){
                header("Location:cart.php");
            }
            else{
                header("Location:404.php");
            }
        }
    }

    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function Update_quantity_Cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";

        $result = $this->db->update($query);

        if($result)
        {
            $msg = "<span class='success'>
                        Product Quantity Update Sucessfully
                    </span>";
            return $msg;
        }
        else       
        {
            $msg = "<span class='error'>
                        Product Quantity Not Sucessfully
                    </span>";
            return $msg;
        }
    }

    public function Del_product_cart($cartid){
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'"; 
        $result = $this->db->delete($query);
        if($result){
            header('Location:cart.php');
        }
    }
    public function check_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    } 
    public function check_order($customer_id){
        $customer_id = session_id();
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    } 

    public function del_all_data_cart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'"; 
        $result = $this->db->select($query);
        return $result;
    }

    public function insertOrder($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $get_Pro = $this->db->select($query);
        if($get_Pro)
        {
            while($result = $get_Pro->fetch_assoc())
            {
                $productId      =   $result['productId'];
                $productName    =   $result['productName'];
                $quantity       =   $result['quantity'];
                $price          =   $result['price'] * $quantity;
                $image          =   $result['image'];
                $customer_id    =   $customer_id;

            $query_order = "INSERT INTO tbl_order   
                    (productId, productName, quantity, price, image, customer_id)

                VALUES
                    ('$productId', '$productName', '$quantity', '$price', '$image', '$customer_id')";

                $insert_order = $this->db->insert($query_order);
            }
        }
    }

    
    public function getAmountPrice($customer_id)
    {
        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    //orderdetails
    public function get_product_order($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $msg = $this->db->select($query);
        return $msg;
    }

    //inbox
    public function getAllOrderProduct()
    {
        $query = "SELECT * FROM tbl_order Order by date_order";
        $msg = $this->db->select($query);
        return $msg;
    }

    //inbox
    public function productShifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $date = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order
            SET status = '1' 
            WHERE id = '$id' AND date_order = '$date' AND price = '$price'";
        $updated_row = $this->db->update($query);
        

        if($updated_row)
        {
            $msg = "<span class='success'>
            
                        Update Sucessfully.
                    </span>";
            return $msg;
        }
        else       
        {//  style=color:red; font-size: 18px;
            $msg = "<span class='error'>
                        Not Update !
                    </span>";
            return $msg;
        }
    }

    public function delProductShifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $date = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        
        $query ="DELETE FROM tbl_order WHERE id = '$id' AND date_order = '$date' AND price = '$price' ";
        $deldata = $this->db->delete($query); 
        if ($deldata) {
            $msg = "<span class='success'>Data Deleted Successfully</span>";
                return $msg;
        } else {
            $msg = "<span class='error'>Data Not Deleted !</span>";
                return $msg;
        }
    }

    public function productShiftConfirm($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $date = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order
                SET
                status = '2' 
                WHERE id = '$id' AND date_order = '$date' AND price = '$price'";
        $updated_row = $this->db->update($query);
        

        if($updated_row)
        {
            $msg = "<span class='success'>
                        Update Sucessfully.
                    </span>";
            return $msg;
        }
        else       
        {
            $msg = "<span class='error'>
                        Not Update !
                    </span>";
            return $msg;
        }
    }
}
?>