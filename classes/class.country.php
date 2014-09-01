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
class Country{
//put your code here
    public $link;
    public function __construct(Database $db){
        $this->link=$db; 
        //parent::__construct($host, $user, $pass, $data);
        }
    
        public function getCountryList()
        {
            $q="SELECT * from country";
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
        public function getCountryField()
        {
            $q="SELECT * from country";
            $result=$this->link->db->query($q);
            $field=$result->fetch_fields();              
            return $field;
            /* "No of rows: ".$result->num_rows;
	     * "Table Name: ".$result->fetch_field()->table;
	     * $fields=$result->fetch_fields();
	     * "No of Fields: ".count($fields); 
             */
        }
        public function checkCountry($country)
        {
            $q="SELECT * from country where countryname='$country'";              
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return true;
            }else{
                return false;
            }            
        }
        
        public function insertCountry($country)
        {
            $country=strtolower($country);
            $check=$this->checkCountry($country);
            if(!$check)
            {
                $q="INSERT into country(countryname) values ('$country')";                  
                $result=$this->link->db->query($q); 
                if($result){return true;}else{return false;}
            }  else {
                return false;
            }            
        }
        
        
        
}
