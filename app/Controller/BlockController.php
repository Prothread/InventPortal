<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 10:47
 */

class BlockController
{
    private $model;

    public function __construct()
    {
        $this->model = new Block();
    }
}