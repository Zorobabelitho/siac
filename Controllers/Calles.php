<?php

    class Calles extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function calles($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Calles";
            $data['page_name'] = "calles";
           $this->views->getView($this,"calles",$data);
        }

        public function getSelectCallePorColonia(int $idcolonia)
        {
            $idcol = intval($idcolonia);
            $htmlOptions= "";
            $arrData = $this->model->selectCallePorColonia($idcol);
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Calle'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectCalles()
        {
            $htmlOptions= "";
            $arrData = $this->model->selectCalles();
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Calle'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }
    }
?>