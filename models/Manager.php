<?php
/**
 * Manager which going to be extended in all managers
 */
abstract class Manager
{
  protected function dbConnect(){
    $db = new PDO('mysql:host=localhost;dbname=jesite;charset=utf8', 'username', 'password');
    return $db;
  }
}
