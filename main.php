<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author anishchapagain
 */
error_reporting(E_ALL | E_DEPRECATED);
include 'config.php';
include_once 'classes/class.database.php';
//$db=new mysqli($host,$user,$pass,$data);
$db= new Database(DB_HOST,DB_USER,DB_PASS,DB_DATA);
//session_start();