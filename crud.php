<?php

/**
 * Autor: EAMM
 * Fecha Inicio: 01/02/2021
 * Descripción: Clase de CRUD extends Conexion
 * Fecha Modificación: 17/03/2021
 */
require_once('conexion.php');
abstract class Crud extends Conexion
{

    //Atributos
    private $tabla;
    protected $pdo;

    //Método Constructor
    public function __construct($tabla)
    {
        $this->tabla = $tabla;
        $this->pdo = parent::conexionMySQL();
    }


    public function getAll($sql)
    {
        $data = null;
        try {
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $stm = null;
        return $data;
    }


    public function getById($id)
    {
        $data = null;
        try {
            $sql = "SELECT * FROM $this->tabla WHERE id=?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $stm = null;
        return $data;
    }


    public function delete($id)
    {
        try {
            $sql = "DELETE FROM $this->tabla WHERE id=?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $stm = null;
    }

    abstract function create();
    abstract function update();
}
