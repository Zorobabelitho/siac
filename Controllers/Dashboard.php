<?php

    class Dashboard extends Controllers{
        public function __construct()
        {
            parent::__construct();

            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(1);
            
        }

        public function dashboard($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Tablero";
            $data['page_name'] = "dashboard";
            $data['page_id'] = "2";
           $this->views->getView($this,"dashboard",$data);
        }

        
    }
?>