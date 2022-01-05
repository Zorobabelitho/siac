<?php

    class callesModel extends mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectCallePorColonia(int $idcol)
        {
            $this->idcolonia = $idcol;
            $sql = "SELECT Id, Calle, Id_Coodigo_Postal FROM vwCalle WHERE Id_Coodigo_Postal = $this->idcolonia ORDER BY Calle";
            $request = $this->selectall($sql);
            return $request;
        }
        
        public function selectCalles()
        {
            $sql = "SELECT * FROM vwCalle ORDER BY Calle";
            $request = $this->selectall($sql);
            return $request;
        }
    }

?>