<?php

    class EstatusTicket extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function estatusticket($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Estatus del Ticket";
            $data['page_name'] = "estatusticket";
           $this->views->getView($this,"estatusticket",$data);
        }

        public function getSelectEstatusTicket()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectEstatusTicket();
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id_Estatus_del_Ticket'].'">'.$arrData[$i]['Estatus_del_Ticket'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }
    }
?>