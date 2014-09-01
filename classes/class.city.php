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
class City{
//put your code here
    public $link;
    public function __construct(Database $db){
        $this->link=$db; 
        //parent::__construct($host, $user, $pass, $data);
        }
    
        public function getCityList()
        {
            $q="SELECT * from city";
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
        public function getCityCountryList()
        {
            $q="SELECT c.countryname,ct.cityname from city ct"
                    . " left join country c on c.countryId=ct.countryId";
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
        public function getCityCountryListById($countryId)
        {
            $q="SELECT ct.cityId,ct.cityname,c.countryname from city ct"
                    . " left join country c on c.countryId=ct.countryId"
                    . " where ct.countryId='$countryId'";
         
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
        public function getCityAgeGroupById($cityId)
        {
            $q="select a.ageId,a.agegroup,c.cityname from population p "
                ." left join city c on c.cityId=p.cityId "
                ." left join age a on a.ageId=p.ageId "
                    . " where p.cityId='$cityId'";
         
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }                
        public function getCityField()
        {
            $q="SELECT * from city";
            $result=$this->link->db->query($q);
            $fields=$result->fetch_fields();              
            return $fields;
            /* "No of rows: ".$result->num_rows;
	     * "Table Name: ".$result->fetch_field()->table;
	     * $fields=$result->fetch_fields();
	     * "No of Fields: ".count($fields); 
             */
        }
            public function getCityCountryField()
        {
             $q="SELECT c.countryname,ct.cityname from city ct"
                    . " left join country c on c.countryId=ct.countryId";
            $result=$this->link->db->query($q);
            $field=$result->fetch_fields();              
            return $field;            
        }
        public function checkCity($countryId,$city)
        {
            $q="SELECT * from city where countryId='$countryId' and cityname='$city'";              
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return true;
            }else{
                return false;
            }            
        }
        
        public function insertCity($countryId,$city)
        {
            $city=strtolower($city);
            $check=$this->checkCity($countryId,$city);
            if(!$check)
            {
                $q="INSERT into city(countryId,cityname) values ('$countryId','$city')";                  
                $result=$this->link->db->query($q); 
                if($result){return true;}else{return false;}
            }  else {
                return false;
            }            
        }
        
        
        
}

