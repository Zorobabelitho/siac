<?php

    class estatusticketModel extends mysql
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function selectEstatusTicket()
        {
            $sql = "SELECT * FROM vwEstatus_del_Ticket ORDER BY Estatus_del_Ticket";
            $request = $this->selectall($sql);
            return $request;
        }
    }

?>
