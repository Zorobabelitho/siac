<?php

    class bandejareportesModel extends mysql
    {
        private $id_ticket;
        private $id_seguimiento;
        private $id_ciudadano;
        private $id_tramite_servicio;
        private $num_ticket;
        private $detalle_reporte;
        private $estatus_ticket;
        private $nota_reporte;
        private $numero_solicitudes;
        private $id_colonia;
        private $id_calle;
        private $numero_exterior;
        private $numero_interior;
        private $id_entre_calle1;
        private $id_entre_calle2;
        private $referencias;
        private $id_funcionario;
        private $id_funcionario_seguimiento;
        private $id_estatus_registro;
        private $fecha_inicial;
        private $fecha_final;

        public function __construct()
        {
            parent::__construct();
        }

        public function selectBandejaReportes()
        {
            $sql = "SELECT Id, Numero_de_Ticket, FORMAT(Fecha, N'dd/MM/yyyy hh:mm tt') as Fecha, Estatus_del_Ticket,
                    Tramites_y_Servicios, Area_Asignada
                    FROM vwReportesGlobal WHERE Estatus_del_Ticket = 'Nuevo' AND Prefijo <> 'OP' AND Estatus = 'Activo' ORDER BY Id";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectBusquedaReporte(string $numticket, string $detallereporte, int $estatusticket, string $fechainicial, string $fechafinal)
        {
            $this->num_ticket = $numticket;
            $this->detalle_reporte = $detallereporte;
            $this->estatus_ticket = $estatusticket;
            $this->fecha_inicial = $fechainicial;
            $this->fecha_final = $fechafinal;

            $sql = "SELECT Id, Numero_de_Ticket, FORMAT(Fecha, N'dd/MM/yyyy hh:mm tt') as Fecha,
                    Estatus_del_Ticket, Tramites_y_Servicios, Area_Asignada FROM vwReportesGlobal WHERE Prefijo <> 'OP' ";

            if($this->num_ticket != 'null'){
                $sql.= "AND Id = $this->num_ticket ";
            }
            if ($this->detalle_reporte != 'null'){
                $sql.= "AND Detalle_del_Reporte LIKE '%$this->detalle_reporte%' ";
            }
            if ($this->estatus_ticket > 0){
                $sql .= "AND Id_Estatus_del_Ticket = $this->estatus_ticket ";
            }
            if ($this->fecha_inicial != 'null' && $this->fecha_final != 'null'){
                $sql .= "AND Fecha between '$this->fecha_inicial' AND '$this->fecha_final' ";
            }

            $request = $this->selectall($sql);
            return $request;
        }

        public function selectBusquedaNota($nota)
        {
            $this->nota_reporte = $nota;
            $sql = "SELECT * FROM vwNota WHERE Nota LIKE '%$this->nota_reporte%' ";
            $request = $this->selectall($sql);
            return $request;   
        }

        public function selectDetallesTicket($idticket)
        {
            $this->id_ticket = $idticket;
            $sql = "SELECT * FROM vwTicket WHERE Id = $this->id_ticket ";
            $request = $this->select($sql);
            return $request;
        }

        public function selectTablaBusquedaReporte(int $idticket)
        {
            $this->id_ticket = $idticket;
            $sql = "SELECT * FROM vwReportesGlobal WHERE Id = $this->id_ticket ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function updateTicket(int $idticket, int $idtramiteservicio, string $strdetallereporte, string $strnumerosolicitudes, int $idcolonia, int $idcalle, string $strnumeroexterior, string $strnumerointerior, int $identrecalle1, int $identrecalle2, string $strreferencias, int $idfuncionario)
        {
            $this->id_ticket = $idticket;
            $this->id_tramite_servicio = $idtramiteservicio;
            $this->detalle_reporte = $strdetallereporte;
            $this->numero_solicitudes = $strnumerosolicitudes;
            $this->id_colonia = $idcolonia;
            $this->id_calle = $idcalle;
            $this->numero_exterior = $strnumeroexterior;
            $this->numero_interior = $strnumerointerior;
            $this->id_entre_calle1 = $identrecalle1;
            $this->id_entre_calle2 = $identrecalle2;
            $this->referencias = $strreferencias;
            $this->id_funcionario = $idfuncionario;

            $sql = "SELECT * FROM tblTicket WHERE Id_Ticket = $this->id_ticket and Id_Tramites_y_Servicios = $this->id_tramite_servicio";
            $request = $this->selectall($sql);

            if(empty($request))
            {
                $request = "no_update";
            }else{
                $sql = "UPDATE tblTicket SET Nuumero_Exterior = ?, Nuumero_Interior = ?, Id_Calle = ?, Id_Entre_Calle_1 = ?, Id_Entre_Calle_2 = ?, Detalle_del_Reporte = ?, Nuumero_de_Reparaciones_Solicitadas = ?, Id_Usuario_que_Modificoo = ?, Fecha_de_Modificacioon = GETDATE(), Referencia_Reporte = ? WHERE Id_Ticket = $this->id_ticket";
                $arrData = array($this->numero_exterior,
                                $this->numero_interior,
                                $this->id_calle,
                                $this->id_entre_calle1,
                                $this->id_entre_calle2,
                                $this->detalle_reporte,
                                $this->numero_solicitudes,
                                $this->id_funcionario,
                                $this->referencias);
                $request = $this->update($sql, $arrData);
            }
            return $request;
        }

        public function insertNota(int $idticket, string $nota, string $documento, string $id_usuarioinserto)
        {
            $this->id_ticket = $idticket;
            $this->strnota = $nota;
            $this->strdocumento = $documento;
            $this->intidusuarioinserto = $id_usuarioinserto;

            $query_insert = "INSERT INTO tblNota (Id_Ticket ,Nota ,Documento ,Id_Tipo_de_Servicio
                            ,Id_Estatus_del_Registro ,Id_Usuario_que_Insertoo ,Id_Usuario_que_Modificoo
                            ,Fecha_de_Insercioon ,Fecha_de_Modificacioon)
                            VALUES (?,?,?,10,1,?,?,GETDATE(),GETDATE()) ";
            $arrData = array($this->id_ticket,
                            $this->strnota,
                            $this->strdocumento,
                            $this->intidusuarioinserto,
                            $this->intidusuarioinserto);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

        public function selectTicketSeguimiento(int $idticket)
        {
            $this->id_ticket = $idticket;
            $sql = "SELECT * FROM tblSeguimiento WHERE Id_Ticket = $this->id_ticket ORDER BY Fecha_de_Modificacioon DESC ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function insertSeguimiento(int $idticket, int $idestatusticket, int $idfuncionario, int $idfuncionarioinsert, int $idseguimiento)
        {
            $this->id_ticket = $idticket;
            $this->id_seguimiento = $idseguimiento;
            $this->estatus_ticket = $idestatusticket;
            $this->id_funcionario_seguimiento = $idfuncionario;
            $this->id_funcionario = $idfuncionarioinsert;

            //Modificar el id del estatus del registro anterior a 2 y el nuevo a 1
            $sql = "UPDATE tblSeguimiento SET Id_Estatus_del_Registro = 2 where Id_Seguimiento = ?";
            $arrData_update = array($this->id_seguimiento);
            $request_update = $this->update($sql, $arrData_update);


            $query_insert = "INSERT INTO tblSeguimiento (Seguimiento, Descripcioon, Id_Tipo_de_Servicio, Id_Ticket, 
                Id_Estatus_del_Ticket, Id_Funcionario,Id_Tipo_de_Rechazo, Fecha_Capturada, Id_Estatus_del_Registro,
                Id_Usuario_que_Insertoo, Id_Usuario_que_Modificoo, Fecha_de_Insercioon, Fecha_de_Modificacioon, ConDocumento)
                 VALUES ('Modificación a los datos del reporte','',10,?,?,?,1,GETDATE(),1,?,?,GETDATE(),GETDATE(),0)";
            $arrData = array($this->id_ticket,
                            $this->estatus_ticket,
                            $this->id_funcionario_seguimiento,
                            $this->id_funcionario,
                            $this->id_funcionario);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }
    }

?>