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

       public function setRazonSocial($razon_social)
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
        * Regresa una lista de todos los proveedores todos los proveedores.
        */
       public function fetchAll()
       {
           $sql = 'SELECT * from proveedor';
           $proveedores = $this->execQuery($sql, null);

           return $proveedores;
       }

       public function readOneProveedor()
       {
           $sql = 'SELECT * from proveedor where id_proveedor = ?';
           $params = [$this->id_proveedor];
           $result = $this->execQuery($sql, $params);

           return $result[0];
       }

       public function createProveedor()
       {
           $sql = 'INSERT into proveedor(razon_social, rfc, domicilio, telefono) values (?,?,?,?)';
           $params = [$this->razon_social, $this->rfc, $this->domicilio, $this->telefono];
           $this->execStmt($sql, $params);
       }

       public function deleteProveedor()
       {
           $sql = 'DELETE from proveedor where id_proveedor = ?';
           $params = [$this->id_proveedor];
           $this->execStmt($sql, $params);
       }

       public function modifyProveedor()
       {
           $sql = 'UPDATE proveedor set razon_social = ?, rfc = ?, domicilio = ?, telefono = ? where id_proveedor = ?';
           $params = [$this->razon_social, $this->rfc, $this->domicilio, $this->telefono, $this->id_proveedor];
           $this->execStmt($sql, $params);
       }
   }
