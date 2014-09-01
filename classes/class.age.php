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
class Age{//put your code here
    public $link;
    public function __construct(Database $db){
        $this->link=$db; 
        }
    
        public function getAgeList()
        {
            $q="SELECT * from age";
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
        public function getAgeField()
        {
            $q="SELECT * from age";
            $result=$this->link->db->query($q);
            $field=$result->fetch_fields();              
            return $field;
            /* "No of rows: ".$result->num_rows;
	     * "Table Name: ".$result->fetch_field()->table;
	     * $fields=$result->fetch_fields();
	     * "No of Fields: ".count($fields); 
             */
        }
        public function checkAge($age)
        {
            $q="SELECT * from age where agegroup='$age'";              
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return true;
            }else{
                return false;
            }            
        }
        
        public function insertAge($age)
        {
            $age=strtolower($age);
            $check=$this->checkAge($age);
            if(!$check)
            {
                $q="INSERT into age(agegroup) values ('$age')";           
                $result=$this->link->db->query($q); 
                if($result){return true;}else{return false;}
            }  else {
                return false;
            }            
        }
        
        
        
}

