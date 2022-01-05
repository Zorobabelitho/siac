<?php

    class Colonias extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function colonias($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Colonias";
            $data['page_name'] = "colonias";
           $this->views->getView($this,"colonias",$data);
        }

        public function getSelectColonias()
        {
            $htmlOptions= "";
            $arrData = $this->model->selectColonias();
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Colonia'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }
        
    }
?>