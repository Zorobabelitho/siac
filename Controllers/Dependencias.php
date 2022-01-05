<?php

    class Dependencias extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function dependencias($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Dependencias";
           $this->views->getView($this,"dependencias",$data);
        }

        public function getSelectDependencias(){
            $htmlOptions= "";
            $arrData = $this->model->selectDependencias();
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Dependencia'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        
    }
?>