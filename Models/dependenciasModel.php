<?php

    class dependenciasModel extends mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectDependencias()
        {
            $sql = "SELECT * FROM vwdependencia WHERE Estatus = 'Activo' ORDER BY Dependencia";
            $request = $this->selectall($sql);
            return $request;
        }
    }

?>