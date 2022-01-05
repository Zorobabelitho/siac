<?php

    class Home extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function home($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Página principal";
            $data['page_name'] = "home";
            $data['page_id'] = "1";
           $this->views->getView($this,"home",$data);
        }

        
    }
?>