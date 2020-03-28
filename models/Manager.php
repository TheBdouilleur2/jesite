<?php
/**
 * Manager which going to be extended in all managers
 */
class Manager
{
  protected function dbConnect(){
    $db = new PDO('mysql:host=localhost;dbname=jesite;charset=utf8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $db;
  }
}
