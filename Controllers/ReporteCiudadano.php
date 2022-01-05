<?php

    class ReporteCiudadano extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(24);
        }

        public function reporteciudadano($params)
        {
            if($_SESSION['permisosMod']['r'] == 0){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag'] = "SIAC";
            $data['page_title'] = " Reporte ciudadano";
            $data['page_name'] = "reporteciudadano";
            $data['page_functions_js'] = "functions_reporteciudadano.js";
           $this->views->getView($this,"reporteciudadano",$data);
        }

        public function setReporte()
        {
            if($_POST)
            {
                if(empty($_POST['listTramitesServicios']) || empty($_POST['txtDetalleReporte']) || empty($_POST['txtNumSolicitudes']) || empty($_POST['listColoniaReporteNuevo']) || empty($_POST['listCalleReporteNuevo']) || empty($_POST['txtNumExteriorReporteNuevo']) || empty($_POST['listCalle1ReporteNuevo']) || empty($_POST['listCalle2ReporteNuevo']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                    
                }else{
                    
                    $idCiudadano = intval($_POST['id_ciudadanoRN']);
                    $telefono = strclean($_POST['TelefonoRN']);
                    $numeroexterior = strClean($_POST['txtNumExteriorReporteNuevo']);
                    $numerointerior = strClean($_POST['txtNumInteriorReporteNuevo']);
                    $idcalle = intval(strClean($_POST['listCalleReporteNuevo']));
                    $identrecalle1 = intval(strClean($_POST['listCalle1ReporteNuevo']));
                    $identrecalle2 = intval(strClean($_POST['listCalle2ReporteNuevo']));
                    $idtramiteservicio = intval(strClean($_POST['listTramitesServicios']));
                    $idarea = $_SESSION['userData']['id_area'];
                    $idfuncionario = $_SESSION['idUser'];
                    $detallereporte = strClean($_POST['txtDetalleReporte']);
                    $numeroreparaciones = intval(strClean($_POST['txtNumSolicitudes']));
                    $estatusregistro = 1;
                    $idusuarioinserto = $_SESSION['idUser'];
                    $referenciareporte = strClean($_POST['txtReferenciasReporteNuevo']);

                    $arrDataTS = $this->model->selectTramiteServicio($idtramiteservicio);
                    if($arrDataTS > 0)
                    {
                        //Obtenemos datos del enlace administrativo de la dependencia
                        $arrDataEAdm = $this->model->selectEnlaceAdm_Dependencia($arrDataTS['Id_Dependencia']);

                        if($arrDataEAdm > 0)
                        {

                            //Almacenamos el id del enlace administrativo de la dependencia
                            $id_enlaceadm = $arrDataEAdm[0]['Id_Funcionario'];

                            //Guardamos el reporte en tblTicket para generar id de ticket
                            $request_reporte = $this->model->insertTicket($idCiudadano, 
                                                                    $telefono, 
                                                                    $numeroexterior, 
                                                                    $numerointerior, 
                                                                    $idcalle, 
                                                                    $identrecalle1, 
                                                                    $identrecalle2, 
                                                                    $idtramiteservicio, 
                                                                    $idarea, 
                                                                    $idfuncionario, 
                                                                    $detallereporte, 
                                                                    $numeroreparaciones, 
                                                                    $estatusregistro,
                                                                    $idfuncionario,
                                                                    $idfuncionario, 
                                                                    $referenciareporte);
                            if($request_reporte > 0)
                            {
                                 //Obtenes el id del ticket generado
                                $arrDataTicket = $this->model->selectNuevoTicket($idCiudadano);
                                $id_Ticket = $arrDataTicket[0]['Id_Ticket']; 

                                if(empty($id_Ticket) || empty($id_enlaceadm)){
                                    $arrResponse = array('status' => false, 'msg' => 'Error. No se encontro el nuevo id de ticket o el id del enlace.');
                                }else{
                                    
                                    //Guardamos alta de reporte en tblSeguimiento
                                    $request_seguimiento = $this->model->insertSeguimiento($id_Ticket,
                                                                                    $id_enlaceadm,
                                                                                    $idusuarioinserto);

                                    if($request_seguimiento > 0)
                                    {
                                        $arrResponse = array('status' => true, 'msg' => 'Reporte generado correctamente con el número: '.$id_Ticket, 'ticket' => $id_Ticket);
                                    }else{
                                        $arrResponse = array('status' => false, 'msg' => 'Error al generar alta de reporte. No. de ticket: '.$id_Ticket);
                                    }

                                }

                            }else{
                                $arrResponse = array('status' => false, 'msg' => 'Error al registrar nuevo reporte');
                            }
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'Enlace administrativo no encontrado.');
                        }

                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Dependencia no encontrada para el tramite o servicio seleccionado');
                    
                    }
                    
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getvalTramSer(string $params)
        {
            if(!empty($params))
            {
                $arrParams = explode(',',$params);
                $id_ciudadano = strClean($arrParams[0]);
                $id_calle = strClean($arrParams[1]);
                $id_tramser = strClean($arrParams[2]);

                //Validamos datos de reporte a insertar
                $arrData = $this->model->selectTramServ_PorCiudadano($id_ciudadano,
                                                            $id_calle,
                                                            $id_tramser);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => true);
                }else{
                    $arrResponse = array('status' => false, 'data' => $arrData, 'msg' => '');
                }
            }else{
                $arrResponse = array('status' => true, 'msg' => 'noexiste_Params');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();

        }

        public function getReportesRegistrados(int $idpersona)
        {
            $idciudadano = intval($idpersona);
            if($idciudadano > 0)
            {
                $arrData = $this->model->selectReportesRegistrados($idciudadano);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'El ciudadano no tiene reportes.');
                }
                else{
                    for ($i=0; $i < count($arrData); $i++) {

                        $btnInfo = '<button onClick="fntInfoReporte('.$arrData[$i]['Id'].')" class="btn btn-info btn-sm" title="Ver detalles de reporte"><i class="far fa-eye"></i></button>';

                        if($_SESSION['permisosMod']['r'] == 0) $btnInfo = '';

                        $arrData[$i]['options'] = '<div class="text-center">'.$btnInfo.'</div>';
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);   
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getDetallesTicketGlobal(int $idticket)
        {
            $id_ticket = intval($idticket);
            if($id_ticket > 0)
            {
               $arrData = $this->model->selectDetallesTicketGlobal($id_ticket);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }
                else{
                    $arrResponse = array('status' => true, 'data' => $arrData);   
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE); 
            }
            die();
        }

        public function getDetallesTicket(int $idticket)
        {
            $id_ticket = intval($idticket);
            if($id_ticket > 0)
            {
                $arrData = $this->model->selectDetallesTicket($id_ticket);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }
                else{
                    $arrResponse = array('status' => true, 'data' => $arrData);   
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setNota()
        {
            
            if($_POST)
            {
                if(empty($_POST['txtNota'])){
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    if($_FILES['fileNota']['size'] > 0)
                    {
                        $fileUrl = 'C:/wamp64/www/SIAC/Assets/files/ArchivosNotas/';
                        opendir($fileUrl);
                        $destino = $fileUrl.$_FILES['fileNota']['name'];
                        $documento = $_FILES['fileNota']['name'];
                        copy($_FILES['fileNota']['tmp_name'], $destino);
                    }else{
                        $documento = '0';
                    }

                    $id_ticket = intval(strClean($_POST['idTicketNota']));
                    $nota = strClean($_POST['txtNota']);
                    $idusuarioinserto = $_SESSION['idUser'];

                    $request_insert = $this->model->insertNota($id_ticket,
                                                        $nota,
                                                        $documento,
                                                        $idusuarioinserto);
                    if($request_insert > 0)
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Nota agregada correctamente.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al agregar la nota.');
                    }

                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getNotas(int $idticket)
        {
            $id_ticket = intval($idticket);
            if($id_ticket > 0)
            {
                $arrData = $this->model->selectNotas($id_ticket);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }else{
                    for ($i=0; $i < count($arrData); $i++) {

                        if($arrData[$i]['Documento'] == '' || $arrData[$i]['Documento'] == '0'){
                            $btnDoc = '<button class="btn btn-primary btn-sm" type="button" title="Sin documento" disabled=""><i class="fas fa-file-download"></i></button>';
                        }else{
                            $btnDoc = '<a class="btn btn-primary btn-sm" href="http://localhost/SIAC/Assets/files/ArchivosNotas/'.$arrData[$i]['Documento'].'" target="_blank"><i class="fas fa-file-download"></i></a>';

                        }

                        $arrData[$i]['options'] = '<div class="text-center">'.$btnDoc.'</div>';
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getHistorial(int $idticket)
        {
            $id_ticket = intval($idticket);
            if($id_ticket > 0)
            {
                 $arrData = $this->model->selectHistorial($id_ticket);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setSeguimiento(int $tiposeguimiento)
        {
            if($_POST)
            {
                $tipo_seguimiento = $tiposeguimiento;
                if($tipo_seguimiento > 0)
                {
                    $Datos_correctos = 0;
                    $Nota_seguimiento = '';
                    $Id_ticket = 0;
                    $Id_estatus_ticket = 0;
                    $Id_funcionario = 0;
                    $Id_tipo_rechazo = 0;
                    $Id_estatus_registro = 0;
                    $Id_funcionario_inserto = $_SESSION['idUser'];
                    $Con_documento = 0;

                    switch ($tipo_seguimiento) {
                        case 1:
                            //Terminar
                            if(empty($_POST['txtNotaSeguimiento_terminar'])) {
                                $Datos_correctos = 0;
                            }else{
                                $Datos_correctos = 1;
                                $Nota_seguimiento = strClean($_POST['txtNotaSeguimiento_terminar']);
                                $Id_ticket = intval(strClean($_POST['idTicketSeguimiento_terminar']));
                                $Id_estatus_ticket = 9;
                                $Id_funcionario = intval(strClean($_POST['idFuncionarioSeguimiento_terminar']));
                                $Id_tipo_rechazo = 1;
                                $Id_estatus_registro = 2;
                            }

                            break;
                        case 2:
                            //Rechazar
                            if(empty($_POST['txtNotaSeguimiento_rechazar']) || empty($_POST['listMotivoRechazo']))
                            {
                                $Datos_correctos = 0;
                            }else{
                                $Datos_correctos = 2;
                                $Nota_seguimiento = strClean($_POST['txtNotaSeguimiento_rechazar']);
                                $Id_ticket = intval(strClean($_POST['idTicketSeguimiento_rechazar']));
                                $Id_estatus_ticket = 1;
                                $Id_funcionario = intval(strClean($_POST['idFuncionarioSeguimiento_rechazar']));
                                $Id_tipo_rechazo = intval(strClean($_POST['listMotivoRechazo']));
                                $Id_estatus_registro = 2;
                            }

                            break;
                        case 3:
                            //Asignar
                            break;
                        case 4:
                            //Cerrar
                            break;
                        default:
                            // code...
                            break;
                    }

                    if($Datos_correctos == 0){
                        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                    }else{
                        $request_insert = $this->model->insertSeguimientoHistorial($Nota_seguimiento,
                                                                                $Id_ticket,
                                                                                $Id_estatus_ticket,
                                                                                $Id_funcionario,
                                                                                $Id_tipo_rechazo,
                                                                                $Id_estatus_registro,
                                                                                $Id_funcionario_inserto,
                                                                                $Con_documento);
                        if($request_insert > 0){
                            if($Datos_correctos == 1){
                                $arrResponse = array('status' => true, 'msg' => 'Reporte terminado.');
                            }else if($Datos_correctos == 2){
                                $arrResponse = array('status' => true, 'msg' => 'Reporte rechazado.');
                            }else if($Datos_correctos == 3){
                                $arrResponse = array('status' => true, 'msg' => 'Reporte asignado.');
                            }else if($Datos_correctos == 4){
                                $arrResponse = array('status' => true, 'msg' => 'Reporte cerrado.');
                            }else{
                                $arrResponse = array('status' => false, 'msg' => 'Seguimiento registrado, sin detalle de la acción.');
                            }   
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'Error al agregar seguimiento.');
                        } 
                    }

                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Tipo de seguimiento no especificado');
                }

                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getSelectMotivoRechazo()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectMotivoRechazo();
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Tipo_de_rechazo'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }
     }   
?>