<?php

include_once('class_category.php');

class product extends category
{

    
    protected $price;
    protected $category_id;
   

function __construct()
{

}

//-*-*--*-*-*-*-*-*METHODS-*-*-*-*-*-*-*-*//
public function add_product($name, $id, $price)
{
    $bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
    $bdd->exec("INSERT INTO products VALUES ('', '$name', '$price', '$id')");


}

//-*-*-*-*-*-*--*-*GETTER--*-*-*-*-*-*-*--*-*//


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