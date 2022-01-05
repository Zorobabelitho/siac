 <?php

    class tramitesserviciosModel extends mysql
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function selectTramitesServicios()
        {
            $sql = "SELECT * FROM vwTramites_y_Servicios WHERE Estatus = 'Activo' ORDER BY Tramites_y_Servicios";
            $request = $this->selectall($sql);
            return $request;
        }
    }

?>

