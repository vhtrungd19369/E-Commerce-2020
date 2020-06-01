<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../lib/database.php');
    require_once ($filepath.'/../helpers/format.php');
?>

<?php

class Customer{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

   
    public function insert_customers($data){
        $name       = mysqli_real_escape_string($this->db->link, $data['name']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode    = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email      = mysqli_real_escape_string($this->db->link, $data['email']);
        $address    = mysqli_real_escape_string($this->db->link, $data['address']);
        $gender     = mysqli_real_escape_string($this->db->link, $data['gender']);
        $phone      = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password   = mysqli_real_escape_string($this->db->link, $data['password']);
        

        if($name=="" || $city=="" || $zipcode=="" || $email=="" || $address==""|| $gender=="" || $phone=="" || $password==""){
            $alert = "<span style=color:red; font-size:18px>
                        Fields must be not empty
                    </span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check)
            {
                $alert = "<span style=color:red; font-size: 18px>
                            Email Already Existed! Please Enter Anothor Email
                        </span>";
                return $alert;
            }
            else
            {
                $query =    "INSERT INTO tbl_customer (name,     city,   zipcode,    email,  address,     gender,    phone,      password)
                             VALUES                 ('$name','$city','$zipcode',  '$email', '$address', '$gender',   '$phone',  '$password')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style=color:green; font-size: 18px>
                                Customer Created Successfully
                            </span>";
                    return $alert;
                }else{
                    $alert = "<span style=color:green; font-size: 18px>
                                Customer Created Not Success
                            </span>";
                    return $alert;
                }
            }
        }
    }

    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;        
    }

    public function update_customers($data, $id)        //from editprofile
    {
        $name       = mysqli_real_escape_string($this->db->link, $data['name']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode    = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $password      = mysqli_real_escape_string($this->db->link, $data['password']);
        $address    = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone      = mysqli_real_escape_string($this->db->link, $data['phone']);        

        if($name=="" || $city=="" || $zipcode=="" || $password=="" || $address=="" || $phone==""){
            $alert = "<span style=color:red; font-size:18px>
                        Fields must be not empty!
                    </span>";
            return $alert;
        }else
            { $query ="UPDATE tbl_customer SET 
                                                name = '$name',
                                                city = '$city',
                                                zipcode = '$zipcode',
                                                password = '$password',
                                                address = '$address',
                                                phone='$phone' WHERE id ='$id'";
                $result = $this->db->insert($query);
                if($result)
                {
                    $alert = "<span style=color:green; font-size: 18px>
                                Customer Update Successfully
                            </span>";
                    return $alert;
                }
                else{

                    $alert = "<span style=color:green; font-size: 18px>
                                Customer Update Not Success
                            </span>";
                    return $alert;
                }
            }
    }

    public function login_customers($data)
    {
        $email       = mysqli_real_escape_string($this->db->link, $data['email']);
        $password    = mysqli_real_escape_string($this->db->link, $data['password']);
        if($email==''|| $password=='')
        {
           $alert = "<span style=color:red; font-size: 18px>
                        Email or Password must be not empty
                    </span>";
            return $alert;
        }
        else
        {
            $check_login = "SELECT * FROM tbl_customer WHERE  email = '$email' AND password = '$password'";
            $result_check = $this->db->select($check_login);
            if($result_check)
            {
                $value = $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['id']);
                Session::set('customer_name',$value['name']);
                header('Location:order.php');
            }
            else
            {
                $alert = "<span style=color:red; font-size: 18px>
                            Email or Password doesn't match
                        </span>";
                return $alert;
            } 
        }
    }

   




}
 ?>