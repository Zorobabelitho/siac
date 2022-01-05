<?php

    class InformeEjecutivo extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(21);
        }

        public function informeejecutivo($params)
        {
            if($_SESSION['permisosMod']['r'] == 0){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Informe Ejecutivo";
            $data['page_name'] = "informe_ejecutivo";
            $data['page_functions_js'] = "functions_informeejecutivo.js";
           $this->views->getView($this,"informeejecutivo",$data);
        }

        
    }
?>