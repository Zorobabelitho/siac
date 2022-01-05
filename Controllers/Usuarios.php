<?php

    class Usuarios extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(33);
        }

        public function usuarios($params)
        {
            if($_SESSION['permisosMod']['r'] == 0){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag'] = "SIAC - Usuarios / Funcionarios";
            $data['page_title'] = "Usuarios / Funcionarios";
            $data['page_name'] = "usuarios";
            $data['page_functions_js'] = "functions_usuarios.js";
           $this->views->getView($this,"usuarios",$data);
        }

        public function setUsuario(string $sClaveCod)
        {
            $sClaveCodificada = $sClaveCod;
            if($_POST)
            {
                if(empty($_POST['txtNombre']) || empty($_POST['txtTelefonoMovil']) || empty($_POST['listArea']) || empty($_POST['listRol']) || empty($_POST['listStatus']) || empty($_POST['txtCorreo']) )
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{

                     $idUsuario = intval($_POST['idUsuario']);
                     $strNombre = ucwords(strClean($_POST['txtNombre']));
                     $strDescripcion = empty($_POST['txtDescripcion']) ? "" : strClean($_POST['txtDescripcion']);
                     $strTelefono = empty($_POST['txtTelefono']) ? "" : strClean($_POST['txtTelefono']);
                     $strTelefonoMovil = strClean($_POST['txtTelefonoMovil']);
                     $strConmutador = empty($_POST['txtConmutador']) ? "" : strClean($_POST['txtConmutador']);
                     $strExtension = empty($_POST['txtExtension']) ? "" : strClean($_POST['txtExtension']);
                     $intArea = intval(strClean($_POST['listArea']));
                     $intRol = intval(strClean($_POST['listRol']));
                     $intStatus = intval(strClean($_POST['listStatus']));
                     $strCorreo = strtolower(strClean($_POST['txtCorreo']));

                     if($idUsuario == 0)
                     {
                         $option = 1;
                         //$strPassword = empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);

                         $strPassword = $sClaveCodificada; 
                         $request_user = $this->model->insertUsuario($strNombre,
                                                                    $strDescripcion,
                                                                    $strTelefono,
                                                                    $strTelefonoMovil,
                                                                    $strConmutador,
                                                                    $strExtension,
                                                                    $intArea,
                                                                    $intRol,
                                                                    $intStatus,
                                                                    $strCorreo,
                                                                    $strPassword);
                     }else{
                         $option = 2;
                         //$strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);

                         $strPassword = $sClaveCodificada; 
                         $request_user = $this->model->updateUsuario($idUsuario,
                                                                    $strNombre,
                                                                    $strDescripcion,
                                                                    $strTelefono,
                                                                    $strTelefonoMovil,
                                                                    $strConmutador,
                                                                    $strExtension,
                                                                    $intArea,
                                                                    $intRol,
                                                                    $intStatus,
                                                                    $strCorreo,
                                                                    $strPassword);
                     }                  

                     if($request_user > 0)
                     {
                        if($option == 1)
                        {
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        }else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                        }
                        
                     }else if ($request_user == 'exist') {
                         $arrResponse = array('status' => false, 'msg' => 'El email que intentas ingresar ya existe.');
                     }else{
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                     }

                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getUsuarios()
        {
            $arrData = $this->model->selectUsuarios();

            for ($i=0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                if($arrData[$i]['id_estatus_del_registro'] == 1)
                {
                    $arrData[$i]['id_estatus_del_registro'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['id_estatus_del_registro'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosMod']['r']){
                    $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['id_funcionario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
                }

                if($_SESSION['permisosMod']['u']){
                    if(($_SESSION['idUser'] == 2126 and $_SESSION['userData']['id_permiso'] == 4) || ($_SESSION['userData']['id_permiso'] == 4 and $arrData[$i]['Id_Permiso'] != 4)){
                        $btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['id_funcionario'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
                    }else{
                        $btnEdit = '<button class="btn btn-secondary btn-sm" disabled=""><i class ="fas fa-pencil-alt"></i></button> ';
                    }
                }

                if($_SESSION['permisosMod']['d']){
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['id_funcionario'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getUsuario(int $idpersona)
        {
            $idusuario = intval($idpersona);
            if($idusuario > 0)
            {
                $arrData = $this->model->selectUsuario($idusuario);
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

        public function delUsuario()
        {
            if($_POST)
            {
                $intIdUsuario = intval($_POST['idUsuario']);
                $requestDelete= $this->model->deleteUsuario($intIdUsuario);
                if($requestDelete)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usaurio');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getSelectFuncionarioPorDependencia(int $iddependencia)
        {
            $id_dependencia = intval($iddependencia);
             $htmlOptions = "";
            $arrData = $this->model->getSelectFuncionarioPorDependencia($id_dependencia);
            if(count($arrData) > 0)
            {
                $htmlOptions .= '<option value="0" disabled selected>Selecciona una opción</option>';
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id'].'">'.$arrData[$i]['Nombre'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }

    }
?>

