<?php

   include_once 'database.class.php';

   class Proveedor extends Database
   {
       private $id_proveedor;
       private $razon_social;
       private $rfc;
       private $domicilio;
       private $telefono;

       public function setIdProveedor($id_proveedor)
       {
           $this->id_proveedor = $id_proveedor;
       }

       public function setRazon_social($razon_social)
       {
           $this->razon_social = $razon_social;
       }

       public function setRfc($rfc)
       {
           $this->rfc = $rfc;
       }

       public function setDomicilio($domicilio)
       {
           $this->domicilio = $domicilio;
       }

       public function setTelefono($telefono)
       {
           $this->telefono = $telefono;
       }


       /**
        * fetchAll.
        * Regresa una lista de todos los proveedores todos los proveedores 
        */
       function fetchAll() {
          $sql = 'SELECT * from proveedor';
          $proveedores = $this->execQuery($sql, null);
          return $proveedores;
       }
   }
