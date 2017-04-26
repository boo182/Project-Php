<?php

//include_once('?');

class category
{

    protected $name;
   

function __construct()
{

}

//-*-*--*-*-*-*-*-*METHODS-*-*-*-*-*-*-*-*//
public function add_category($name, $id)
{
    $bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
    $bdd->exec("INSERT INTO categories VALUES ('', $name', '$id')");

}


public function getName()
{     
    return $this->name;
}    
public function getPrice()
{
    return $this->price;    
}
public function getType()
{
    return $this->type;
}
public function getWeight()
{
    return $this->weight;
}
public function getColor()
{
    return $this->color;
}

}
?>