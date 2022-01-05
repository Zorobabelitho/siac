<?php

    class TipoContacto extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function tipocontacto($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Tipo contacto";
            $data['page_name'] = "tipocontacto";
           $this->views->getView($this,"tipocontacto",$data);
        }

        public function getSelectTipoContacto()
        {
            $htmlOptions= "";
            $arrData = $this->model->selectTipoContacto();
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Tipo_de_Contacto'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        
    }
?>