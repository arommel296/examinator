<?php
//require_once 'autocargar.php';

interface methodDB{
    public function findById($id);
    public function findAll();
    public function deleteById($id);
    public function delete($object);
    public function save($object);
    public function update($object);
    public function insert($object);
}