<?php
class db{
    private $host='localhost';
    private $usuario='root';
    private $password='';
    private $base='misclientes';

    //conectar BD

    public function conectar(){
        $conexion_mysql="mysql:host=$this->host;dbname=$this->base";
        $conexionBD=new PDO($conexion_mysql,$this->usuario,$this->password);
        $conexionBD->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //esta line arregla la codificacion de caracteres UTF-8 
        $conexionBD->exec("set names UTF8");
        return $conexionBD;
    }
}