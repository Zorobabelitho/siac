<?php

    class reporteciudadanoModel extends mysql
    {
        private $idTicket;
        private $intIdCiudadano;
        private $intIdFuncionario;
        public $busqueda;
        public $tipobusqueda;
        public $strtelefono;
        public $strnumexterior;
        public $strnuminterior;
        public $intidcolonia;
        public $intidcalle;
        public $intidentrecalle1;
        public $intidentrecalle2;
        public $intidtramiteservicio;
        public $intidarea;
        public $strdetallereporte;
        public $intnumreparaciones;
        public $intidestatusregistro;
        public $intidestatusticket;
        public $intidusuarioinserto;
        public $intidusuariomodifico;
        public $strreferenciareporte;
        public $intiddependencia;
        public $strnota;
        public $strdocumento;
        public $intidtiporechazo;

        public function __construct()
        {
            parent::__construct();
        }
        
        public function selectReportesRegistrados(int $idciudadano)
        {
            $this->intIdCiudadano = $idciudadano;
            $sql = "SELECT vwRG.Id, FORMAT(vwRG.Fecha, N'dd/MM/yyyy hh:mm tt') as Fecha, vwRG.Estatus_del_Ticket, 
                    vwRG.Tramites_y_Servicios, vwRG.Area_Asignada,
                    FORMAT(tblT.Fecha_de_Modificacioon, N'dd/MM/yyyy hh:mm tt') as Fecha_de_Modificacioon
                    FROM vwReportesGlobal vwRG
                    INNER JOIN tblTicket tblT ON tblT.Id_Ticket = vwRG.Id
                    WHERE vwRG.Id_Ciudadano = $this->intIdCiudadano ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectDetallesTicketGlobal(int $id_ticket)
        {
            $this->idTicket = $id_ticket;
            $sql = "SELECT vwR.Id, vwR.Id_Ciudadano, vwR.Id_Dependencia_Asignada, vwR.Id_Area_Asignada,
                    vwR.Id_Funcionario_Asignado, vwR.Id_Funcionario_que_Inserto, vwR.Id_Calle,
                    vwT.Id_Entre_Calle_1, vwT.Id_Entre_Calle_2, vwR.Id_Tramites_y_Servicios,
                    vwR.Id_Dependencia_que_Inserto, vwR.Area_Asignada, vwR.Calle, vwR.Nuumero_Exterior,
                    vwR.Nuumero_Interior, vwR.Colonia, vwR.Ciudadano, vwR.Dependencia_Asignada,
                    vwR.Detalle_del_Reporte, vwR.Entre_calle_1, vwR.Entre_Calle_2, vwR.Estatus_del_Ticket,
                    vwR.Estatus, vwR.Funcionario_Asignado, vwR.Funcionario_quien_Recibio, vwR.Fecha,
                    vwR.Numero_de_Ticket, vwR.Tramites_y_Servicios, vwR.Tiempo_para_Atender,
                    vwR.Id_Coodigo_Postal, vwR.Id_Estatus_del_Ticket, vwR.Nuumero_de_Reparaciones_Solicitadas,
                    vwR.Prefijo, vwR.DependTram, vwR.Teleefono, vwR.Seguimiento, vwR.AreaInserto,
                    vwR.Dependencia_inserto
                    FROM vwReportesGlobal vwR
                    INNER JOIN vwTicket vwT ON vwT.Id = vwR.Id
                    WHERE vwR.Id = $this->idTicket AND Prefijo <> 'OP'";

            $request = $this->select($sql);
            return $request;
        }

        public function selectDetallesTicket(int $id_ticket)
        {
            $this->idTicket = $id_ticket;
            $sql = "SELECT vwT.Id_Ticket, vwT.Funcionario, vwD.Dependencia, 
                    vwT.Id_Tramites_y_Servicios, vwT.Area, vwT.Numero_de_Ticket,
                    vwT.Detalle_del_Reporte, vwT.Nuumero_de_Reparaciones_Solicitadas,
                    vwT.Colonia, vwT.Calle, vwT.Nuumero_Exterior, vwT.Nuumero_Interior,
                    vwT.Entre_Calle_1, vwT.Entre_Calle_2, vwT.Funcionario_que_Insertoo
                    FROM vwTicket vwT
                    INNER JOIN vwDependencia vwD ON vwD.Id = vwT.Id_Dependencia
                    WHERE vwT.Id = $this->idTicket";
            $request = $this->select($sql);
            return $request;
        }

        public function selectTramiteServicio(int $id_tramite_servicio)
        {
            $this->intidtramiteservicio = $id_tramite_servicio;
            $sql = "SELECT * FROM vwTramites_y_Servicios WHERE Id = $this->intidtramiteservicio ";
            $request = $this->select($sql);
            return $request;
        }

        public function selectEnlaceAdm_Dependencia(int $id_dependencia)
        {
            $this->intiddependencia = $id_dependencia;
            $sql = "SELECT tblF.Id_Funcionario, vwF.Nombre, vwF.Id_Dependencia, 
                tblF.Id_Permiso, vwF.Permiso 
                FROM tblFuncionario tblF 
                INNER JOIN vwFuncionario vwF ON vwF.Id = tblF.Id_Funcionario
                WHERE vwF.Id_Dependencia = $this->intiddependencia AND Id_Permiso = 28  
                AND tblF.Id_Estatus_del_Registro = 1 ORDER BY tblF.Id_Funcionario ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectNuevoTicket(int $id_ciudadano)
        {
            $this->intIdCiudadano = $id_ciudadano;
            $sql = "SELECT * FROM tblTicket 
                WHERE Id_Ciudadano = $this->intIdCiudadano  
                ORDER BY Fecha_de_Insercioon DESC";
            $request = $this->selectall($sql);
            return $request;
        }

        public function insertTicket(int $id_ciudadano, string $telefono, string $numexterior, string $numinterior, int $id_calle, int $id_entrecalle1, int $id_entrecalle2, int $id_tramiteservicio, int $id_area, int $id_funcionario, string $detalle_reporte, int $numreparaciones, int $id_estatus, int $id_usuarioinserto, int $id_usuariomodifico, string $referecencia_reporte)
        {
            $this->intIdCiudadano = $id_ciudadano;
            $this->strtelefono = $telefono;
            $this->strnumexterior = $numexterior;
            $this->strnuminterior = $numinterior;
            $this->intidcalle = $id_calle;
            $this->intidentrecalle1 = $id_entrecalle1;
            $this->intidentrecalle2 = $id_entrecalle2;
            $this->intidtramiteservicio = $id_tramiteservicio;
            $this->intidarea = $id_area;
            $this->intIdFuncionario = $id_funcionario;
            $this->strdetallereporte = $detalle_reporte;
            $this->intnumreparaciones = $numreparaciones;
            $this->intidestatusregistro = $id_estatus;
            $this->intidusuarioinserto = $id_usuarioinserto;
            $this->intidusuariomodifico = $id_usuariomodifico;
            $this->strreferenciareporte = $referecencia_reporte;

            $query_insert = "INSERT INTO tblTicket(Nuumero_de_Ticket_AT,Nuumero_de_Ticket_OP,
                    Id_Ciudadano,Teleefono,Teleefono_Moovil,Nuumero_Exterior,Nuumero_Interior,
                    Id_Calle,Id_Entre_Calle_1,Id_Entre_Calle_2,Id_Tramites_y_Servicios,
                    Id_Area,Id_Funcionario,Detalle_del_Reporte
                    ,Nuumero_de_Reparaciones_Solicitadas,Documento,Id_Estatus_del_Registro
                    ,Id_Usuario_que_Insertoo,Id_Usuario_que_Modificoo,Fecha_de_Insercioon
                    ,Fecha_de_Modificacioon,Referencia_Reporte,Latitud_Colonia,Longitud_Colonia)
                    VALUES
                    (0,0,?,?,'',?,?,?,?,?,?,?,?,?,?,'',1,?,?,GETDATE(),GETDATE(),?,'','')";
            $arrData = array($this->intIdCiudadano, 
                            $this->strtelefono,
                            $this->strnumexterior,
                            $this->strnuminterior,
                            $this->intidcalle,
                            $this->intidentrecalle1,
                            $this->intidentrecalle2,
                            $this->intidtramiteservicio,
                            $this->intidarea,
                            $this->intIdFuncionario,
                            $this->strdetallereporte,
                            $this->intnumreparaciones,
                            $this->intidusuarioinserto,
                            $this->intidusuariomodifico,
                            $this->strreferenciareporte);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;

        }

        public function insertSeguimiento(int $id_ticket, int $id_enlaceadm, int $id_usuarioinserto)
        {
            $this->idTicket = $id_ticket;
            $this->intIdFuncionario = $id_enlaceadm;
            $this->intidusuarioinserto = $id_usuarioinserto;

            $query_insert = "INSERT INTO tblSeguimiento(Seguimiento, Descripcioon, Id_Tipo_de_Servicio
                           ,Id_Ticket, Id_Estatus_del_Ticket, Id_Funcionario, Id_Tipo_de_Rechazo
                           ,Fecha_Capturada, Id_Estatus_del_Registro, Id_Usuario_que_Insertoo
                           ,Id_Usuario_que_Modificoo, Fecha_de_Insercioon
                           ,Fecha_de_Modificacioon, ConDocumento)
                            VALUES('Alta del reporte','',10,?,8,?,1,GETDATE(),1,?,?,GETDATE(),GETDATE(),0)";
            $arrData = array($this->idTicket,
                            $this->intIdFuncionario,
                            $this->intidusuarioinserto,
                            $this->intidusuarioinserto);

            $request_insert = $this->insert($query_insert, $arrData);

            return $request_insert;
        }

        public function selectTramServ_PorCiudadano(int $id_ciudadano, int $id_calle, int $id_tramiteservicio)
        {
            $this->intIdCiudadano = $id_ciudadano;
            $this->intidcalle = $id_calle;
            $this->intidtramiteservicio = $id_tramiteservicio;

            $sql="SELECT * FROM vwTicket WHERE 
                    Id_Ciudadano = $this->intIdCiudadano 
                    AND Id_Calle = $this->intidcalle 
                    AND Id_Tramites_y_Servicios = $this->intidtramiteservicio ";

            $request = $this->select($sql);
            return $request;
        }

        public function insertNota(int $id_ticket, string $nota, string $documento, string $id_usuarioinserto)
        {
            $this->idTicket = $id_ticket;
            $this->strnota = $nota;
            $this->strdocumento = $documento;
            $this->intidusuarioinserto = $id_usuarioinserto;

            $query_insert = "INSERT INTO tblNota (Id_Ticket ,Nota ,Documento ,Id_Tipo_de_Servicio
                            ,Id_Estatus_del_Registro ,Id_Usuario_que_Insertoo ,Id_Usuario_que_Modificoo
                            ,Fecha_de_Insercioon ,Fecha_de_Modificacioon)
                            VALUES (?,?,?,10,1,?,?,GETDATE(),GETDATE()) ";
            $arrData = array($this->idTicket,
                            $this->strnota,
                            $this->strdocumento,
                            $this->intidusuarioinserto,
                            $this->intidusuarioinserto);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

        public function selectNotas(int $id_ticket)
        {
            $this->idTicket = $id_ticket;
            $sql = "SELECT Id, Nota, Funcionario, FORMAT(Fecha, N'dd/MM/yyyy hh:mm tt') as Fecha, Documento, Id_Ticket FROM vwNota WHERE Id_Ticket = $this->idTicket ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectHistorial(int $id_ticket)
        {
            $this->idTicket = $id_ticket;
            $sql = "SELECT FORMAT(Fecha, N'dd/MM/yyyy hh:mm tt') as Fecha, Funcionario_quien_Asigna, Funcionario_Asignado, Seguimiento, Estatus_del_Ticket, Tipo_de_rechazo, [Oficio Respuesta] FROM vwSeguimiento WHERE Id_Ticket = $this->idTicket ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectMotivoRechazo()
        {
            $sql = "SELECT * FROM vwTipo_de_rechazo ORDER BY Tipo_de_rechazo";
            $request = $this->selectall($sql);
            return $request;
        }

        public function insertSeguimientoHistorial(string $nota_seguimiento, int $id_ticket, int $id_estatus_ticket, int $id_funcionario, int $id_tipo_rechazo, int $id_estatus_registro, int $id_usuarioinserto, int $con_documento)
        {
            $this->strnota = $nota_seguimiento;
            $this->idTicket = $id_ticket;
            $this->intidestatusticket = $id_estatus_ticket;
            $this->intIdFuncionario = $id_funcionario;
            $this->intidtiporechazo = $id_tipo_rechazo;
            $this->intidestatusregistro = $id_estatus_registro;
            $this->intidusuarioinserto = $id_usuarioinserto;
            $this->strdocumento = $con_documento;

            $query_insert = "INSERT INTO tblSeguimiento (Seguimiento, Descripcioon, Id_Tipo_de_Servicio, Id_Ticket ,Id_Estatus_del_Ticket, Id_Funcionario, Id_Tipo_de_Rechazo, Fecha_Capturada, Id_Estatus_del_Registro, Id_Usuario_que_Insertoo, Id_Usuario_que_Modificoo, Fecha_de_Insercioon, Fecha_de_Modificacioon , ConDocumento)
                VALUES (?,'',10,?,?,?,?,GETDATE(),?,?,?,GETDATE(),GETDATE(),?)";
            $arrData = array($this->strnota,
                            $this->idTicket,
                            $this->intidestatusticket,
                            $this->intIdFuncionario,
                            $this->intidtiporechazo,
                            $this->intidestatusregistro,
                            $this->intidusuarioinserto,
                            $this->intidusuarioinserto,
                            $this->strdocumento);

            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

    }

?>