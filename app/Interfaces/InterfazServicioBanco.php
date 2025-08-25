<?php

namespace App\Interfaces;

interface InterfazServicioBanco
{
    public function obtenerBalance($codigo_banco, $numero_cuenta);
    //public function obtenerCuenta($codigo_banco, $numero_cuenta);
}
