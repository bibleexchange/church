<?php namespace App\Interfaces;

interface ModelInterface {
    public function modifySchema($table);
    public function getSeed();
}