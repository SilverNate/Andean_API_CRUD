<?php

require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller
{
    // Initialization ----------------------------------------------------------------------------------
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('andean',true);
    }

    // API Banner ----------------------------------------------------------------------------------
    function index_get(){
        $banner = ["text" => "welcome to Dean API"];
        $this->response($banner);
    }

    function user_get(){
        $no = $this->get('no');
        if ($no){
            $result = $this->db->query("SELECT * FROM `data` WHERE no = ?",[$no])->result_array();
            $this->response(["status"=>["code"=>200,"response"=>"success","message"=>"Example of success get data"],"Result"=> $result]);    
        }else{
            $result = $this->db->query("SELECT * FROM `data`")->result_array();
            $this->response(["status"=>["code"=>200,"response"=>"success","message"=>"Example of success get data"],"Result"=> $result]);
        }
    }

    function user_post(){
        $name       = $this->post('name');
        $email      = $this->post('email');
        $password   = $this->post('password');
        $gender     = $this->post('gender');
        $ismarried  = $this->post('ismarried');
        $address    = $this->post('address');

        $result = $this->db->query("INSERT INTO `data` (name,email,password,gender,ismarried,address) VALUES (?,?,?,?,?,?)",[$name, $email, $password, $gender, $ismarried, $address]);
        if ($result) {
            $res = "Data added successfully";
        }else{
            $res = "Added failed";
        }

        $this->response(["status"=>["code"=>201,"response"=>"success","message"=>"Example of success post data"],"Result"=> $res]);
    }

    function user_put(){
        $id         = $this->put('no');
        $name       = $this->put('name');
        $email      = $this->put('email');
        $password   = $this->put('password');
        $gender     = $this->put('gender');
        $ismarried  = $this->put('ismarried');
        $address    = $this->put('address');

        $result = $this->db->query("UPDATE `data` SET name=?, email=?, password=?, gender=?, ismarried=?, address=? where no=?",[$name, $email, $password, $gender, $ismarried, $address, $id]);
        if ($result) {
            $res = "update successfully";
        }else{
            $res = "update failed";
        }

        $this->response(["status"=>["code"=>200,"response"=>"success","message"=>"Example of success update data"],"Result"=> $res]);
    }

    function user_delete(){
        $id = $this->delete('no');
        $result = $this->db->query('DELETE FROM `data` WHERE no=?',[$id]);
        if ($result) {
            $res = "Delete successfully";
        }else{
            $res = "Delete Failed";
        }
        $this->response(["status"=>["code"=>200,"response"=>"success","message"=>"Example of success delete data"],"Result"=> $res]);
    }
}
