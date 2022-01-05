<?php

    class Ciudadano extends Controllers{
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

        public function ciudadano($params)
        {
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Ciudadano";
            $data['page_name'] = "ciudadano";
           $this->views->getView($this,"ciudadano",$data);
        }

        public function setCiudadano()
        {
            
            if($_POST)
            {

                if(empty($_POST['txtNombre']) || empty($_POST['txtApePaterno']) || empty($_POST['txtTelefono']) || empty($_POST['listTipoContacto']) || empty($_POST['listColonia']) || empty($_POST['listCalle']) || empty($_POST['txtNumExterior']) || empty($_POST['listCalle1']) || empty($_POST['listCalle2']))
                {
                    if(empty($_POST['txtNombreEdit']) || empty($_POST['txtApePaternoEdit']) || empty($_POST['txtTelefonoEdit']) || empty($_POST['listTipoContactoEdit']) || empty($_POST['listColoniaEdit']) || empty($_POST['listCalleEdit']) || empty($_POST['txtNumExteriorEdit']) || empty($_POST['listCalle1Edit']) || empty($_POST['listCalle2Edit'])){
                        $DataCorrectos = 0;
                        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');    
                    }else{
                        $DataCorrectos = 2;
                    }
                }else{
                    $DataCorrectos = 1;
                }

                if($DataCorrectos > 0){

                    if($DataCorrectos == 1){

                        //Nuevo ciudadano
                        $strNombre = ucwords(strClean($_POST['txtNombre']));
                        $strApellidoPaterno = ucwords(strClean($_POST['txtApePaterno']));
                        $strTelefono = strClean($_POST['txtTelefono']);
                        $intTipoContacto = intval(strClean($_POST['listTipoContacto']));
                        $intColonia = intval(strClean($_POST['listColonia']));
                        $intCalle = intval(strClean($_POST['listCalle']));
                        $strNumExterior = strClean($_POST['txtNumExterior']);
                        $intEntreCalle1 = intval(strClean($_POST['listCalle1']));
                        $intEntreCalle2 = intval(strClean($_POST['listCalle2']));

                        $FuncionarioInserto = $_SESSION['idUser'];
                        $FuncionarioModifico = $_SESSION['idUser'];

                        $strApellidoMaterno = empty($_POST['txtApeMaterno']) ? "" : ucwords(strClean($_POST['txtApeMaterno']));
                        $strDescripcion = empty($_POST['txtDescripcion']) ? "" : strClean($_POST['txtDescripcion']);
                        $strNumInterior = empty($_POST['txtNumInterior']) ? "" : strClean($_POST['txtNumInterior']);
                        $strReferencias = empty($_POST['txtReferencias']) ? "" : strClean($_POST['txtReferencias']);
                        $strEmail = empty($_POST['txtEmail']) ? "" : strtolower(strClean($_POST['txtEmail']));
                        $intStatus = empty($_POST['listStatus']) ? 0 : intval(strClean($_POST['listStatus']));    
                    }else{

                        //Editar ciudadano
                        $intIdCiudadano = intval(strClean($_POST['idCiudadano']));
                        $strNombre = ucwords(strClean($_POST['txtNombreEdit']));
                        $strApellidoPaterno = ucwords(strClean($_POST['txtApePaternoEdit']));
                        $strTelefono = strClean($_POST['txtTelefonoEdit']);
                        $intTipoContacto = intval(strClean($_POST['listTipoContactoEdit']));
                        $intColonia = intval(strClean($_POST['listColoniaEdit']));
                        $intCalle = intval(strClean($_POST['listCalleEdit']));
                        $strNumExterior = strClean($_POST['txtNumExteriorEdit']);
                        $intEntreCalle1 = intval(strClean($_POST['listCalle1Edit']));
                        $intEntreCalle2 = intval(strClean($_POST['listCalle2Edit']));

                        $FuncionarioInserto = $_SESSION['idUser'];
                        $FuncionarioModifico = $_SESSION['idUser'];

                        $strApellidoMaterno = empty($_POST['txtApeMaternoEdit']) ? "" : ucwords(strClean($_POST['txtApeMaternoEdit']));
                        $strDescripcion = empty($_POST['txtDescripcionEdit']) ? "" : strClean($_POST['txtDescripcionEdit']);
                        $strNumInterior = empty($_POST['txtNumInteriorEdit']) ? "" : strClean($_POST['txtNumInteriorEdit']);
                        $strReferencias = empty($_POST['txtReferenciasEdit']) ? "" : strClean($_POST['txtReferenciasEdit']);
                        $strEmail = empty($_POST['txtEmailEdit']) ? "" : strtolower(strClean($_POST['txtEmailEdit']));
                        $intStatus = empty($_POST['listStatusEdit']) ? 0 : intval(strClean($_POST['listStatusEdit']));
                    }
                    


                    if($intIdCiudadano == 0)
                    {
                        //Insertar ciudadano
                        $option = 1;
                        $request_ciudadano = $this->model->insertCiudadano($strNombre,
                                                                        $strApellidoPaterno,
                                                                        $strApellidoMaterno,
                                                                        $strDescripcion,
                                                                        $strTelefono,
                                                                        $intTipoContacto,
                                                                        $intColonia,
                                                                        $intCalle,
                                                                        $strNumExterior,
                                                                        $strNumInterior,
                                                                        $intEntreCalle1,
                                                                        $intEntreCalle2,
                                                                        $strReferencias,
                                                                        $strEmail,
                                                                        $intStatus,
                                                                        $FuncionarioInserto,
                                                                        $FuncionarioModifico);
                    }else{

                        //Modificar ciudadano
                        $option = 2;
                        $request_ciudadano = $this->model->updateCiudadano($intIdCiudadano,
                                                                        $strNombre,
                                                                        $strApellidoPaterno,
                                                                        $strApellidoMaterno,
                                                                        $strDescripcion,
                                                                        $strTelefono,
                                                                        $intTipoContacto,
                                                                        $intColonia,
                                                                        $intCalle,
                                                                        $strNumExterior,
                                                                        $strNumInterior,
                                                                        $intEntreCalle1,
                                                                        $intEntreCalle2,
                                                                        $strReferencias,
                                                                        $strEmail,
                                                                        $intStatus,
                                                                        $FuncionarioModifico);
                    }

                    if($request_ciudadano > 0)
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        }else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                        }
                    }else if ($request_ciudadano == 'existNombre'){
                         $arrResponse = array('status' => false, 'msg' => 'El ciudadano con el nombre '.$strNombre.' '.$strApellidoPaterno.', ya existe. Favor de verificar los datos.');
                    }else if($request_ciudadano == 'existTelefono'){
                        $arrResponse = array('status' => false, 'msg' => 'El número del telefono ya existe en un registro, favor de verificarlo.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setCiudadano_BandejaReportes()
        {
            if($_POST)
            {
                if(empty($_POST['idCiudadano']) || empty($_POST['txtNombreEdit']) || empty($_POST['txtApePaternoEdit']) || empty($_POST['listTipoContactoEdit']) || empty($_POST['txtTelefonoEdit']) || empty($_POST['listColoniaEdit']) || empty($_POST['listCalleEdit']) || empty($_POST['txtNumExteriorEdit']) || empty($_POST['listCalle1Edit']) || empty($_POST['listCalle2Edit']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');  
                }else{

                    $idCiudadano = intval(strClean($_POST['idCiudadano']));
                    $strNombre = strClean($_POST['txtNombreEdit']);
                    $strApellidoPaterno = strClean($_POST['txtApePaternoEdit']);
                    $strApellidoMaterno = strClean($_POST['txtApeMaternoEdit']);
                    $intTipoContacto = intval(strClean($_POST['listTipoContactoEdit']));
                    $strTelefono = strClean($_POST['txtTelefonoEdit']);
                    $strDescripcion = strclean($_POST['txtDescripcionEdit']);
                    $intColonia = intval(strClean($_POST['listColoniaEdit']));
                    $intCalle = intval(strClean($_POST['listCalleEdit']));
                    $strNumeroExterior = strClean($_POST['txtNumExteriorEdit']);
                    $strNumeroInterior = strClean($_POST['txtNumInteriorEdit']);
                    $intEntreCalle1 = intval(strClean($_POST['listCalle1Edit']));
                    $intEntreCalle2 = intval(strClean($_POST['listCalle2Edit']));
                    $strReferencias = strClean($_POST['txtReferenciasEdit']);
                    $strCorreo = strclean($_POST['txtEmailEdit']);
                    $intEstatus = intval(strClean($_POST['listStatusEdit']));
                    $FuncionarioModifico = $_SESSION['idUser'];

                    $request_ciudadano = $this->model->updateCiudadano($idCiudadano,
                                                                        $strNombre,
                                                                        $strApellidoPaterno,
                                                                        $strApellidoMaterno,
                                                                        $strDescripcion,
                                                                        $strTelefono,
                                                                        $intTipoContacto,
                                                                        $intColonia,
                                                                        $intCalle,
                                                                        $strNumeroExterior,
                                                                        $strNumeroInterior,
                                                                        $intEntreCalle1,
                                                                        $intEntreCalle2,
                                                                        $strReferencias,
                                                                        $strCorreo,
                                                                        $intEstatus,
                                                                        $FuncionarioModifico);
                    if($request_ciudadano > 0)
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al actualizar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getCiudadano(int $idpersona)
        {
            $idciudadano = intval($idpersona);
            if($idciudadano > 0)
            {
                $arrData = $this->model->selectCiudadano($idciudadano);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }
                else{
                    $arrResponse = array('status' => true, 'data' => $arrData);   
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }

        public function getSelectCiudadanoPorNombre(string $Busqueda)
        {
            $tipoSearch = 2;
            $searchA = strClean($Busqueda);
            $convertir = array(" " => "%");
            $search = strtr($searchA, $convertir);
            if($tipoSearch > 0 && $tipoSearch <= 2)
            {
                $arrData = $this->model->selectBusquedaCiudadano($search, $tipoSearch);
                if(empty($arrData))
                {
                    $arrResponse = array("status" => false, "msg" => 'Ciudadano no encontrado.');       
                }
                else{
                    for ($i=0; $i < count($arrData); $i++) {

                        $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" title="Ver datos del ciudadano" onClick="fntVerCiudadano('.$arrData[$i]['Id'].')"><i class="far fa-eye"></i></button>';
                        //$btnNew = '<button class="btn btn-primary  btn-sm btnEditUsuario" title="Reporte nuevo" onClick="openModal()"><i class="fas fa-plus-circle"></i></button>';
                        $btnNew = '';

                        if($_SESSION['permisosMod']['r'] == 0) $btnView = '';
                        if($_SESSION['permisosMod']['w'] == 0) $btnNew = '';

                        $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnNew.'</div>';
                    }
                    $arrResponse = array("status" => true, "data" => $arrData);          
                }
            }else{
              $arrResponse = array("status" => false, "msg" => 'Tipo de búsqueda no especificado.');  
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getselectCiudadanoPorTelefono(string $Busqueda)
        {
            $tipoSearch = 1;
            $search = intval(strClean($Busqueda));
            if($tipoSearch > 0 && $tipoSearch <= 2)
            {
                $arrData = $this->model->selectBusquedaCiudadano($search, $tipoSearch);
                if(empty($arrData))
                {
                    $arrResponse = array("status" => false, "msg" => 'Teléfono no encontrado.');       
                }
                else{
                    for ($i=0; $i < count($arrData); $i++) {

                        $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" title="Ver datos del ciudadano" onClick="fntVerCiudadano('.$arrData[$i]['Id'].')"><i class="far fa-eye"></i></button>';
                        //$btnNew = '<button class="btn btn-primary  btn-sm btnEditUsuario" title="Reporte nuevo" onClick="openModal()"><i class="fas fa-plus-circle"></i></button>';
                        $btnNew = '';

                        if($_SESSION['permisosMod']['r'] == 0) $btnView = '';
                        if($_SESSION['permisosMod']['w'] == 0) $btnNew = '';

                        $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnNew.'</div>';
                    }
                    $arrResponse = array("status" => true, "data" => $arrData);          
                }
            }else{
              $arrResponse = array("status" => false, "msg" => 'Tipo de búsqueda no especificado.');  
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
          

        
    }
?>