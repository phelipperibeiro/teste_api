<?php

namespace App\Entities;

class Produto
{

    private $lm;
    private $name;
    private $free_shipping;
    private $description;
    private $price;

    function __construct($lm = null, $name = null, $free_shipping = null, $description = null, $price = null)
    {
        $this->lm = $lm;
        $this->name = $name;
        $this->free_shipping = $free_shipping;
        $this->description = $description;
        $this->price = $price;
    }

    function getLm()
    {
        return $this->lm;
    }

    function getName()
    {
        return $this->name;
    }

    function getFree_shipping()
    {
        return $this->free_shipping;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getPrice()
    {
        return $this->price;
    }

    function toArray()
    {
        return [ 'lm' => $this->lm, 'name' => $this->name, 'free_shipping' => $this->free_shipping, 'description' => $this->description, 'price' => $this->price];
    }

    function setLm($lm)
    {
        $this->lm = $lm;
        return $this;
    }

    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    function setFree_shipping($free_shipping)
    {
        $this->free_shipping = $free_shipping;
        return $this;
    }

    function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

}
