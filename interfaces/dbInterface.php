<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
interface methodDB{
    public function findById($id);
    public function findAll();
    public function deleteById($id);
    public function delete($object);
    public function save($object);
    public function update($object);
    public function insert($object);
}