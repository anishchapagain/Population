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
class Population{
//put your code here
    public $link;
    public function __construct(Database $db){
        $this->link=$db; 
        }
    
        public function getPopulationList()
        {
            $q="SELECT * from population";
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
        
         public function getPopulationLists()
        {
            $q="SELECT c.countryname,ct.cityname,a.agegroup,p.male,p.female from population p "
                    . " left join city ct on ct.cityId=p.cityId "
                    . " left join age a on a.ageId=p.ageId "
                    . " left join country c on c.countryId=ct.countryId";
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        }
      
        public function getPopulationField()
        {
            $q="SELECT * from population";
            $result=$this->link->db->query($q);
            $fields=$result->fetch_fields();              
            return $fields;
            /* "No of rows: ".$result->num_rows;
	     * "Table Name: ".$result->fetch_field()->table;
	     * $fields=$result->fetch_fields();
	     * "No of Fields: ".count($fields); 
             */
        }
       
        public function getPopulationFields()
        {
            $q="SELECT c.countryname,ct.cityname,a.agegroup,p.male,p.female from population p "
                    . " left join city ct on ct.cityId=p.cityId "
                    . " left join age a on a.ageId=p.ageId "
                    . " left join country c on c.countryId=ct.countryId";
            $result=$this->link->db->query($q);
            $field=$result->fetch_fields();              
            return $field;        
        }
        
        public function checkPopulation($cityId,$ageId)
        {
            $q="SELECT * from population where cityId='$cityId' and ageId='$ageId'";              
            $result=$this->link->db->query($q);
            if($result->num_rows >0)
            {
                return true;
            }else{
                return false;
            }            
        }
        
        public function insertPopulation($cityId,$ageId,$male,$female)
        {            
            $check=$this->checkPopulation($cityId,$ageId);
            if(!$check)
            {
                $q="INSERT into population(cityId,ageId,male,female) values ('$cityId','$ageId','$male','$female')";                  
                $result=$this->link->db->query($q); 
                if($result){return true;}else{return false;}
            }  else {
                return false;
            }            
        }
        public function filterCityGroup($ageId,$cityId)
        {               
            $sql = "select p.male,p.female,sum(male+female) as total,a.ageId,a.agegroup,c.cityname from population p "
    . "left join city c on c.cityId=p.cityId "
    . "left join age a on a.ageId=p.ageId "
    . "where p.cityId='$cityId' and p.ageId='$ageId'";
             
            $result=$this->link->db->query($sql);
            if($result->num_rows >0)
            {
                return $result;
            }else{
                $result= false;
            }
        } 
    
        
        
        
}



