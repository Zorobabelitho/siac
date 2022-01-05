<?php

    class coloniasModel extends mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectColonias()
        {
            $sql = "SELECT Id, Colonia FROM vwColonias_Tlanelpantla WHERE Estatus = 'Activo' ORDER BY Colonia";
            $request = $this->selectall($sql);
            return $request;
        }
    }

?>