<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class
 *
 * @author anishchapagain
 */
class Database {
//put your code here
    public $db;
    public function __construct($host,$user,$pass,$data){
        $this->db=new mysqli($host,$user,$pass,$data);        
        }
    
        public function checkUser($user,$pass)
        {
            $q="SELECT * from user where username='$user' and password='$pass'";            
            $result=$this->db->query($q);
            if($result->num_rows >0)
            {
                return true;
            }else{
                return false;
            }
            
        }
        
}
