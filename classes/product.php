<?php
    $filepath = realpath(dirname(__FILE__));
        require_once ($filepath.'/../lib/database.php');
        require_once ($filepath.'/../helpers/format.php');
?>

<?php

    class Product{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data,$files){

            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited =array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
        
                if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $file_name=="" ){
                    $alert = "<span class='error'>Fields must be not empty</span>";
                    return $alert;
                }else{
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query ="INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image)
                    VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Insert product Successfully</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Insert product Not Success</span>";
                        return $alert;
                    }
                }
            }
        
        public function show_product__MEMORYYYY($on0N){
            // $query = " SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            // FROM tbl_product INNER JOIN tbl_category 0N tbl_product.catId = tbl_category.catId
    
            // INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
    
            //  order by tbl_product.productId desc";    
        }


        public function show_product(){
        $query ="SELECT * FROM tbl_product order by productId desc";
                $result = $this->db->select($query);
                return $result;
        }

        public function update_product($data,$files,$id){
            
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited =array('jpg','jpeg','png','gif');

            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
        // Người dùng CHỌN ẢNH
                    if($file_size > 1024000) {

                        $alert = "<span class='error'>Image Size should be less then 1GB</span>";
                        return $alert;
                    }elseif (in_array($file_ext, $permited) === false){
                        $alert = "<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
                    }
                    move_uploaded_file($file_temp,$uploaded_image);
                        $query ="UPDATE tbl_product SET
                                productName =   '$productName',
                                brandId =       '$brand',
                                catId =         '$category',
                                type =          '$type',
                                price =         '$price',
                                image =         '$unique_image',
                                product_desc =  '$product_desc' WHERE productId = '$id'";
                            $result = $this->db->update($query);
                        if($result){
                        $alert = "<span class='success'  style=color:green; font-size: 18px>
                                    Product Updated Successfully</span>";
                            return $alert;
                        }else{
                            $alert = "<span class='error'  style=color:red; font-size: 18px>
                                        Product Updated Not Success
                                    </span>";
                        return $alert;
                        }
                        }else{
                            //--KHÔNG ĐỔI ẢNH
                            $query ="UPDATE tbl_product SET
                                productName =   '$productName',
                                brandId =       '$brand',
                                catId =         '$category',
                                type =          '$type',
                                price =         '$price',
                                product_desc =  '$product_desc' WHERE productId = '$id'";
                            $result = $this->db->update($query);
                        if($result){
                            $alert = "<span class='success'  style=color:green; font-size: 18px >
                                        Product Updated Successfully
                                    </span>";
                            return $alert;
                        }else{
                                $alert = "<span class='error'  style=color:red; font-size: 18px>
                                            Product Updated Not Success
                                        </span>";
                            return $alert;
                        }
                }
            }
        
        }

        public function del_product($id){
            $query ="DELETE FROM tbl_product WHERE productId = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success' style=color:green; font-size: 18px >
                            Product Deleted Successfully
                        </span>";
                return $alert;
            }else{
                $alert = "<span class='error'>
                            Product Deleted Not Success
                        </span>";
                return $alert;
            }
        }

        //get_Admin
        public function getproductbyId($id){
            $query ="SELECT * FROM tbl_product WHERE productId = '$id' ";
                $result = $this->db->select($query);
                return $result;
        }

        //get_User
        //=====feathered====
        public function getproduct_feathered(){
            $query = "SELECT * FROM tbl_product WHERE type = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        //====New pd====
        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";       //asc # order by
            $result = $this->db->select($query);
            return $result;
        }

        //=====Details======
        public function get_details($id)
        {   $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
            
            FROM tbl_product 
            INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
            WHERE tbl_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertCompare($proId, $customer_id)
        {
            $Customer_Id    = mysqli_real_escape_string($this->db->link, $customer_id);
            $Product_Id      = mysqli_real_escape_string($this->db->link, $proId);
            
            $cquery  = "SELECT * FROM tbl_compare WHERE customer_id = '$Customer_Id' 
                                                    AND productId = '$Product_Id'";
            $check = $this->db->select($cquery);
            if($check)
            {
                $msg = "<span class='error'>
                            <a  style=color:red; font-size: 18px href=compare.php>
                                Product Available Compare !</a>
                        </span>";
                return $msg;
            }else
            {

                 // Lay data from tbl_product ra:----> truyen vao tbl_compare.
            $query = "SELECT * FROM tbl_product WHERE productId = '$Product_Id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            $Product_Id      = $result['productId'];
            $productName    = $result['productName'];
            $price          = $result['price'];
            $image          = $result['image'];
            
            // ------------------> truyen vao tbl_compare.
            $query_insert ="INSERT INTO tbl_compare(productId, price, image, customer_id, productName)
                VALUES
                    ('$Product_Id', '$price', '$image', '$customer_id', '$productName')";

            $inserted_row = $this->db->insert($query_insert);
            if($inserted_row){
                $msg = "<span class='success' >
                            <a  style=color:green; font-size: 18px href=compare.php>
                                Added Compare Successfully
                            </a>
                        </span>";
                return $msg;
            }

            }
        }

        public function get_compare($customer_id)
        {
            $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function Del_tbl_compare($productid, $customer_id)
        {
            $query ="DELETE FROM tbl_compare WHERE productid = '$productid' AND customer_id = '$customer_id' ";
            $result = $this->db->delete($query);
            if($result){
                $msg = "<span class='success' style = color:green; font-size: 18px>
                            Product Deleted Successfully
                        </span>";
                return $msg;
            }
        }

        // Extend: details.php
        public function insertWishlist($proId, $customer_id)
        {
            $Cust_Id    = mysqli_real_escape_string($this->db->link, $customer_id);
            $Prod_Id      = mysqli_real_escape_string($this->db->link, $proId);
            
            $W_query  = "SELECT * FROM tbl_wishlist WHERE customer_id = '$Cust_Id' AND productId = '$Prod_Id'";

            $check_W = $this->db->select($W_query);
            if($check_W)
            {
                $msg = "<span class='error'>
                            <a style = color:red; font-size: 18px href=wishlist.php>
                                Product Available Wishlist !
                            </a>
                        </span>";
                return $msg;
            }else{

                // Lay data from tbl_product ra:----> truyen vao tbl_wishlist.
            $query = "SELECT * FROM tbl_product WHERE productId = '$Prod_Id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            $Prodt_Id     = $result['productId'];
            $ProductName    = $result['productName'];
            $Price          = $result['price'];
            $Image          = $result['image'];
            
                // ----------------> truyen vao tbl_wishlist.
            $Wquery_insert ="INSERT INTO tbl_wishlist (productId, price, image, customer_id, productName)
                VALUES
                    ('$Prodt_Id', '$Price', '$Image', '$customer_id', '$ProductName')";

            $inserted_row = $this->db->insert($Wquery_insert);
            if($inserted_row){
                $msg = "<span class='success' >
                            <a style = color:green; font-size: 18px href=wishlist.php>
                                Added Wishlist Successfully
                            </a>
                        </span>";
                return $msg;
            }

            }
        }

        // Extend: wishlist.php
        public function get_wishlist($customer_id)
        {
            $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function Del_tbl_wishlist($productid, $customer_id)
        {
            $query ="DELETE FROM tbl_wishlist WHERE productid = '$productid' AND customer_id = '$customer_id' ";
            $result = $this->db->delete($query);
            if($result){
                $msg = "<span class='success' style = color:green; font-size: 18px>
                            Product Deleted Successfully
                        </span>";
                return $msg;
            }
        }

}
?>



<!-- ++ -->
<?php
    //    $query = "SELECT tbl_product.productId, tbl_category.catName, tbl_brand.brandName
            
    //    FROM ((tbl_product 
    //        INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId)

    //        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId)
          
    //    WHERE tbl_product.productId = '$id'";


// $query = "SELECT tbl_product.productId, tbl_category.catName, tbl_brand.brandName 
            
// FROM ((tbl_product
// INNER JOIN tbl_category 0N tbl_product.catId = tbl_category.catId 

// INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";

// $result = $this->db->select($query);
// return $result;

// $result = $this->db->select($query);
// return $result;




// var_dump($query);die;
        //         $result = $this->db->select($query);
        //             return $result; -->


        
    //    public function get_details($id)
    //      {
    //          $query = "SELECT p.*, c.catName, b.brandName
    //              FROM    tbl_product as p,
    //                      tbl_category as c,
    //                      tbl_brand as b
    //          WHERE p.catId = c.catId AND p.branId = b.brandId AND p.productId = '$id'";
    //          $result = $this->db->select($query);
    //              return $result;  
         
?>