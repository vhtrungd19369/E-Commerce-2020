<?php
$filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../lib/database.php');
    require_once ($filepath.'/../helpers/format.php');
?>

<?php

class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category($catName){

        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
      
            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            }else{
                $query ="INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Category Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Category Not Success</span>";
                    return $alert;
                }
            }
        }
    
    public function show_category(){
        $query ="SELECT * FROM tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
    }

    public function update_caterogy($catName,$id){
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($catName)){
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        }else{
            $query ="UPDATE tbl_category SET catName ='$catName' WHERE catId = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Category Updated Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Category Updated Not Success</span>";
                return $alert;
            }
        }
    
    }

    public function del_category($id)
    {
        $query ="DELETE FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span class='success'>Category Deleted Successfully</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Category Deleted Not Success</span>";
            return $msg;
        }
    }

    public function getcatbyId($id){
        $query ="SELECT * FROM tbl_category WHERE catId = '$id' ";
            $result = $this->db->select($query);
            return $result;
    }

    public function show_category_frontend(){
        $query ="SELECT * FROM tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
    }

    public function get_product_by_cat($id){
        $query = "SELECT * FROM tbl_product WHERE catId = '$id' order by catId desc";
            $result = $this->db->select($query);
            return $result;
    }
// Exam_30:
    // public function getname_product_by_cat($id){
    //     $query ="SELECT tbl_product.*,
    //                     tbl_category.catName,
    //                     tbl_category.catId 
    //     FROM tbl_product,tbl_category
    //     WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' limit 1";
    //       $result = $this->db->select($query);
    //       return $result;
    // }

}

?>