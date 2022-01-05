<?php

    class Areas extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
        }

        public function areas($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Áreas";
            $data['page_name'] = "areas";
           $this->views->getView($this,"areas",$data);
        }

         public function getSelectAreas()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectAreas();
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Area'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }

        public function getSelectAreaPorDependencia(int $id_dependencia)
        {
            $iddependencia = intval($id_dependencia);
            $htmlOptions= "";
            $arrData = $this->model->selectAreaPorDependencia($iddependencia);
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Area'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEnlacePorDependencia(int $id_dependencia)
        {
            $iddependencia = intval($id_dependencia);
            $htmlOptions= "";
            $arrData = $this->model->selectEnlacePorDependencia($iddependencia);
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['Funcionario'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectPrefijos()
        {
            $iddependencia = $_SESSION['userData']['Id_Dependencia'];
            $htmlOptions = "";
            $arrData = $this->model->selectPrefijos($iddependencia);
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['id_area'].'">'.$arrData[$i]['area_prefijo'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }
        
    }
?>