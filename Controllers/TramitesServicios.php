<?php

    class TramitesServicios extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function tramitesservicios($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Trámites y servicios";
            $data['page_name'] = "tramitesservicios";
           $this->views->getView($this,"tramitesservicios",$data);
        }

        public function getSelectTramitesServicios()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectTramitesServicios();
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Tramites_y_Servicios'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }
    }
?>