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

        $check_query = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $get_Pro = $this->db->select($check_query);
        if($get_Pro){
            $msg = "<span style=color:red; font-size: 18px;>
                        Product Already Added !
                    <span>";
            return $msg;
        }
        else
        {

            $query = 
            "INSERT INTO
                tbl_cart
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

    public function get_product_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function Update_quantity_Cart($quantity, $cartId){
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET

                quantity = '$quantity'

                WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
            if($result){
                $msg = "<span style=color:green; font-size: 18px;>
                            Product Quantity Update Sucessfully
                        </span>";
                return $msg;
            }else{
                $msg = "<span style=color:green; font-size: 18px;>
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
        $this->db->select($query);
    }
    
    public function del_all_data_cart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'"; 
        $result = $this->db->select($query);
        return $result;
    }

    
}
?>