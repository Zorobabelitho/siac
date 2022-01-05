<?php

    class BandejaReportes extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(19);
        }

        public function bandejareportes($params)
        {
            if($_SESSION['permisosMod']['r'] == 0){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Bandeja de reportes";
            $data['page_name'] = "bandejareportes";
            $data['page_functions_js'] = "functions_bandejareportes.js";
           $this->views->getView($this,"bandejareportes",$data);
        }

        public function getBandejaReportes()
        {
            $arrData = $this->model->selectBandejaReportes();

            for ($i=0; $i < count($arrData); $i++) {
                $btnView = '';

                if($_SESSION['permisosMod']['r']){
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntInfoReporte('.$arrData[$i]['Id'].')" title="Ver detalles de reporte"><i class="far fa-eye"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setBusquedaReporte(string $params)
        {
            $arrParams = explode(',',$params);
            $numticket = strClean($arrParams[0]);
            $detallereporte = strClean($arrParams[1]);
            $notareporte = strClean($arrParams[2]);
            $estatusticket = intval(strClean($arrParams[3]));
            $fechaInicial = strClean($arrParams[4]);
            $fechaFinal = strClean($arrParams[5]);
            $int_pasa = 0;
            $fechaInicialConFormato = 'null';
            $fechaFinalConFormato = 'null';

            if($numticket != 'null'){
                $int_pasa = 1;
            }elseif($notareporte != 'null'){
                $convertir = array(" " => "%");
                $nota = strtr($notareporte, $convertir);

                $arrData_Nota = $this->model->selectBusquedaNota($nota);
                if(!empty($arrData_Nota)){
                    $numticket = $arrData_Nota[0]['Id'];
                    $int_pasa = 1;
                }else{
                    $int_pasa = 2;
                }

            }elseif($detallereporte != 'null'){
                $convertir = array(" " => "%");
                $detalle = strtr($detallereporte, $convertir);
                $detallereporte = $detalle;
                $int_pasa = 1;
            }elseif($estatusticket > 0){
                $int_pasa = 1;
            }elseif($fechaInicial != 'null' && $fechaFinal != 'null'){
                $convertir = array("-" => "");
                $fechaInicialConFormato = strtr($fechaInicial, $convertir);
                $fechaFinalConFormato = strtr($fechaFinal, $convertir);
                $int_pasa = 1;
            }else{
                $int_pasa = 0;
            }


            if($int_pasa == 1){
                $arrData = $this->model->selectBusquedaReporte($numticket,
                                                            $detallereporte,
                                                            $estatusticket,
                                                            $fechaInicialConFormato,
                                                            $fechaFinalConFormato);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Ningun reporte encontrado');
                }else{
                    for ($i=0; $i < count($arrData); $i++) {
                        $btnView = '';

                        if($_SESSION['permisosMod']['r']){
                            $btnView = '<button class="btn btn-info btn-sm" onClick="fntInfoReporte('.$arrData[$i]['Id'].')" title="Ver detalles de reporte"><i class="far fa-eye"></i></button>';
                        }

                        $arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
            }elseif($int_pasa == 2){
                $arrResponse = array('status' => false, 'msg' => 'No se encontraron coincidencias con la nota buscada.');   
            }else{
                $arrResponse = array('status' => false, 'msg' => 'Ningun dato proporcionado para realizar la búsqueda.'); 
            } 
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getDetallesTicket(int $idticket)
        {
            $id_ticket = intval($idticket);
            if($id_ticket)
            {
                $arrData = $this->model->selectDetallesTicket($id_ticket);
                if(!empty($arrData))
                {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setModificacionesReporte()
        {
            if($_POST)
            {
                if(empty($_POST['listTramitesServicios']) || empty($_POST['txtDetalleReporte']) || empty($_POST['txtNumSolicitudes']) || empty($_POST['listColonia']) || empty($_POST['listCalle']) || empty($_POST['txtNumeroExteriorTicket']) || empty($_POST['listCalle1']) || empty($_POST['listCalle2']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    
                    $id_ticket = intval(strClean($_POST['idTicket']));
                    $id_ciudadano = intval(strClean($_POST['idCiudadanoUR']));
                    $id_tramite_servicio = intval(strClean($_POST['listTramitesServicios']));
                    $str_detalle_reporte = strClean($_POST['txtDetalleReporte']);
                    $str_numero_solicitudes = strclean($_POST['txtNumSolicitudes']);
                    $id_colonia = intval(strClean($_POST['listColonia']));
                    $id_calle = intval(strClean($_POST['listCalle']));
                    $str_numero_exterior = strClean($_POST['txtNumeroExteriorTicket']);
                    $str_numero_interior = strClean($_POST['txtNumeroInteriorTicket']);
                    $id_entre_calle_1 = intval(strClean($_POST['listCalle1']));
                    $id_entre_calle_2 = intval(strClean($_POST['listCalle2']));
                    $str_referencias = strClean($_POST['txtReferencias']);
                    $idfuncionario = $_SESSION['idUser'];

                    $request_ticket = $this->model->updateTicket($id_ticket,
                                                                $id_tramite_servicio,
                                                                $str_detalle_reporte,
                                                                $str_numero_solicitudes,
                                                                $id_colonia,
                                                                $id_calle,
                                                                $str_numero_exterior,
                                                                $str_numero_interior,
                                                                $id_entre_calle_1,
                                                                $id_entre_calle_2,
                                                                $str_referencias,
                                                                $idfuncionario);

                    if($request_ticket > 0)
                    {
                        //Buscamos los ultimos datos de la tabla Seguimiento
                        $arrData_Seguimiento = $this->model->selectTicketSeguimiento($id_ticket);
                        if($arrData_Seguimiento > 0){
                            $estatus_ticket = $arrData_Seguimiento[0]['Id_Estatus_del_Ticket'];
                            $id_funcionario = $arrData_Seguimiento[0]['Id_Funcionario'];
                            $id_seguimiento = $arrData_Seguimiento[0]['Id_Seguimiento'];

                            //Insertamos registro en la tabla Seguimiento
                            $request_seguimiento = $this->model->insertSeguimiento($id_ticket,
                                                                                    $estatus_ticket,
                                                                                    $id_funcionario,
                                                                                    $idfuncionario,
                                                                                    $id_seguimiento);
                            if($request_seguimiento > 0){
                                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                            }else{
                                $arrResponse = array('status' => false, 'msg' => 'Error:[Error al ingresar el seguimiento], favor de informarlo a los encargados del sistema.');
                            }
                        }
                    }elseif($request_ticket == "no_update"){
                        $arrResponse = array('status' => false, 'msg' => 'El trámite o servicio no puede ser modificado, de ser necesario puede crear un nuevo reporte y dar por terminado el actual.');    
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
                    }
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
        }
        
    }
?>