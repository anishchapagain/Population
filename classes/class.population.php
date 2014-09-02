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
class Population {

//put your code here
    public $link;

    public function __construct(Database $db) {
        $this->link = $db;
    }

    public function getPopulationList() {
        $q = "SELECT * from population";
        $result = $this->link->db->query($q);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    public function getPopulationLists() {
        $q = "SELECT c.countryname,ct.cityname,a.agegroup,p.male,p.female from population p "
                . " left join city ct on ct.cityId=p.cityId "
                . " left join age a on a.ageId=p.ageId "
                . " left join country c on c.countryId=ct.countryId";
        $result = $this->link->db->query($q);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    public function getPopulationField() {
        $q = "SELECT * from population";
        $result = $this->link->db->query($q);
        $fields = $result->fetch_fields();
        return $fields;
        /* "No of rows: ".$result->num_rows;
         * "Table Name: ".$result->fetch_field()->table;
         * $fields=$result->fetch_fields();
         * "No of Fields: ".count($fields); 
         */
    }

    public function getPopulationFields() {
        $q = "SELECT c.countryname,ct.cityname,a.agegroup,p.male,p.female from population p "
                . " left join city ct on ct.cityId=p.cityId "
                . " left join age a on a.ageId=p.ageId "
                . " left join country c on c.countryId=ct.countryId";
        $result = $this->link->db->query($q);
        $field = $result->fetch_fields();
        return $field;
    }

    public function checkPopulation($cityId, $ageId) {
        $q = "SELECT * from population where cityId='$cityId' and ageId='$ageId'";
        $result = $this->link->db->query($q);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertPopulation($cityId, $ageId, $male, $female) {
        $check = $this->checkPopulation($cityId, $ageId);
        if (!$check) {
            $q = "INSERT into population(cityId,ageId,male,female) values ('$cityId','$ageId','$male','$female')";
            $result = $this->link->db->query($q);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function filterCityGroup($ageId, $cityId) {
        $sql = "select p.male,p.female,sum(male+female) as total,a.ageId,a.agegroup,c.cityname from population p "
                . "left join city c on c.cityId=p.cityId "
                . "left join age a on a.ageId=p.ageId "
                . "where p.cityId='$cityId' and p.ageId='$ageId'";

        $result = $this->link->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    public function filterTop3() {
        $sql = "SELECT c.countryname,ct.cityname,a.agegroup,p.male, p.female, p.male + p.female AS total FROM population p "
                . "left join city ct on ct.cityId=p.cityId "
                . "left join country c on c.countryId=ct.countryId "
                . "left join age a on a.ageId=p.ageId "
                . "ORDER BY total DESC LIMIT 3";
        $result = $this->link->db->query($sql);
        //$field = $result->fetch_fields();
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    public function filterBottom3() {
        $sql = "SELECT c.countryname,ct.cityname,a.agegroup,p.male, p.female, p.male + p.female AS total FROM population p "
                . "left join city ct on ct.cityId=p.cityId "
                . "left join country c on c.countryId=ct.countryId "
                . "left join age a on a.ageId=p.ageId "
                . "ORDER BY total ASC LIMIT 3";
        $result = $this->link->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    public function maleHigh3() {
        $sql = "SELECT c.countryname,ct.cityname,a.agegroup,p.male FROM population p "
                . "left join city ct on ct.cityId=p.cityId "
                . "left join country c on c.countryId=ct.countryId "
                . "left join age a on a.ageId=p.ageId "
                . "ORDER BY p.male DESC LIMIT 3";
        $result = $this->link->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    public function femaleHigh3() {
        $sql = "SELECT c.countryname,ct.cityname,a.agegroup, p.female FROM population p "
                . "left join city ct on ct.cityId=p.cityId "
                . "left join country c on c.countryId=ct.countryId "
                . "left join age a on a.ageId=p.ageId "
                . "ORDER BY p.female DESC LIMIT 3";
        $result = $this->link->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

    //Total Population:Male,female    
    public function totalPopulation() {
        $sql = "select c.countryname,sum(p.male)+sum(p.female) as 'total',sum(p.male) as 'male',sum(p.female) as 'female' from population p "
                . "left join city ct on ct.cityId=p.cityId "
                . "left join country c on c.countryId=ct.countryId "
                . "group by c.countryname order by total DESC ";
        $result = $this->link->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }
    
    //Total Population:Male,female    
    public function totalCountryPopulation() {
        $sql = "select sum(p.male)+sum(p.female) as 'total',sum(p.male) as 'male',sum(p.female) as 'female' from population p "
                . "left join city ct on ct.cityId=p.cityId "
                . "left join country c on c.countryId=ct.countryId ";             
        $result = $this->link->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            $result = false;
        }
    }

}
