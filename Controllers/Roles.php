<?php

    class Roles extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
            getPermisos(34);
        }

        public function roles($params)
        {
            if($_SESSION['permisosMod']['r'] == 0){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag'] = "SIAC";
            $data['page_title'] = "Roles de usuario";
            $data['page_name'] = "roles";
            $data['page_id'] = "3";
            $data['page_functions_js'] = "functions_roles.js";
           $this->views->getView($this,"roles",$data);
        }

        public function getRoles()
        {
            $arrData = $this->model->selectRoles();

            for ($i=0; $i < count($arrData); $i++) {

                $btnPermiso = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['id_permiso'].')" title="Permisos"><i class="fas fa-key"></i></button>';
                $btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['id_permiso'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                $btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['id_permiso'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';

                if($arrData[$i]['id_estatus_del_registro'] == 1)
                {
                    $arrData[$i]['id_estatus_del_registro'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['id_estatus_del_registro'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosMod']['u'] == 0) $btnPermiso = '';
                if($_SESSION['permisosMod']['u'] == 0) $btnEdit = '';
                if($_SESSION['permisosMod']['d'] == 0) $btnDelete = '';

                $arrData[$i]['options'] = '<div class="text-center">'.$btnPermiso.' '.$btnEdit.' '.$btnDelete.'</div>';
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getSelectRoles()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectRoles();
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['id_permiso'].'">'.$arrData[$i]['permiso'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }

        public function getSelectRolesActivos()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectRolesActivos();
            if(count($arrData) > 0)
            {
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['id_permiso'].'">'.$arrData[$i]['permiso'].'</option>';
                }
            } 
            echo $htmlOptions;
            die();
        }

        public function getRol($idrol){
            $intIdrol = intval(strClean($idrol));
            if($intIdrol > 0)
            {
                $arrData = $this->model->selectRol($intIdrol);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setRol(){
            $intIdrol = intval($_POST['idRol']);
            $strRol =  strClean($_POST['txtRol']);
            $strDescripcion = strClean($_POST['txtDesc']);
            $intStatus = intval($_POST['listStatus']);

            if($intIdrol == 0)
            {
                //crear
                $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
                $option = 1;
            }else{
                //actualizar
                $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
                $option = 1;
            }

            if($request_rol > 0)
            {
                if($option == 1)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');    
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
            }else if($request_rol == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El rol ya existe.');
            }else{
                $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos, debe informarlo al encargado correspondiente.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delRol()
        {
            if($_POST){
                $intIdrol = intval($_POST['idrol']);
                    $requestDelete = $this->model->deleteRol($intIdrol);
                    if($requestDelete == 'ok')
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
                    }else if($requestDelete == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a funcionarios.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }        
    }
?>