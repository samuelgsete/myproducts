<?php

class Product {

    public $id = null;
    public $description;
    public $brand;
    public $price;
    public $stock;
    public $warranty;
    public $is_active;

    function __construct($description, $brand, $price, $stock, $warranty, $is_active) {
        $this->description = $description;
        $this->brand = $brand;
        $this->price = $price;
        $this->stock = $stock;
        $this->warranty = $warranty;
        $this->is_active = $is_active;
    }

    function toString() {
        return "
            id => {$this->id}, 
            description => {$this->description}, 
            brand => {$this->brand}, 
            price => {$this->price}, 
            stock => {$this->stock}, 
            warranty => {$this->warranty}, 
            active => {$this->is_active}
        ";
    }
}

?>