<?php

    class tipocontactoModel extends mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectTipoContacto()
        {
            $sql = "SELECT * FROM vwTipo_de_Contacto WHERE Estatus = 'Activo' ORDER BY Tipo_de_Contacto";
            $request = $this->selectall($sql);
            return $request;
        }
    }

?>