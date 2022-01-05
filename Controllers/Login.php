<?php

    class Login extends Controllers{
        public function __construct()
        {
            session_start();
            if(isset($_SESSION['login']))
            {
                header('Location: '.base_url().'/dashboard');
            }
            parent::__construct();
        }

        public function login($params)
        {
            $data['page_tag'] = "SIAC - Login";
            $data['page_title'] = "SIAC - Tlalnepantla de Baz";
            $data['page_name'] = "login";
            $data['page_functions_js'] = "functions_login.js";
           $this->views->getView($this,"login",$data);
        }

        public function loginUser(string $claveCod)
        {
            //dep($_POST);
            $claveCodificada = $claveCod;
            if($_POST)
            {
                if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                    $strUsuario = strtolower(strClean($_POST['txtEmail']));
                    //$claveCodificada = hash("SHA256", $_POST['txtPassword']);

                    $requestUser = $this->model->loginUser($strUsuario, $claveCodificada);

                    if(empty($requestUser))
                    {
                        $arrResponse = array('status' => false, 'msg' => 'El usuario o contraseña son incorrectos.');
                    }else{
                        $arrData = $requestUser;
                        if($arrData['id_estatus_del_registro'] == 1){
                            $_SESSION['idUser'] = $arrData['id_funcionario'];
                            $_SESSION['login'] = true;

                            $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                            $_SESSION['userData'] = $arrData;

                            $arrResponse = array('status' => 'true', 'msg' => 'ok');
                        }else{
                          $arrResponse = array('status' => false, 'msg' => 'Usuario inactivo');  
                        }
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function resetPass()
        {
            if($_POST){

                error_reporting(0);
                if(empty($_POST['txtEmailReset'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                    $token = token();
                    $strEmail = strtolower(strClean($_POST['txtEmailReset']));
                    $arrData = $this->model->getUserEmail($strEmail);

                    if(empty($arrData)){
                        $arrResponse = array('status' => false, 'msg' => 'Usuario no existente');
                    }else{
                        $idpersona = $arrData['id_funcionario'];
                        $nombreUsuario = $arrData['funcionario'];

                        $url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;
                        $requestUpdate = $this->model->setTokenUser($idpersona,$token);

                        $dataUsuario = array('nombreUsuario' => $nombreUsuario,
                                            'email' => $strEmail,
                                            'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
                                            'url_recovery' => $url_recovery);

                        if($requestUpdate){
                            $sendEmail = sendEmail($dataUsuario,'email_cambioPassword');
                            if($sendEmail)
                            {
                                $arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña');
                            }else{
                                $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
                            }

                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
                        }
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function confirmUser(string $params)
        {
            if(empty($params)){
                header('location: '.base_url());
            }else{
                $arrParams = explode(',',$params);
                $strEmail = strClean($arrParams[0]);
                $strToken = strClean($arrParams[1]);

                $arrResponse = $this->model->getUsuario($strEmail, $strToken);

                if(empty($arrResponse))
                {
                    header("location: ".base_url());
                }else{
                    $data['page_tag'] = "SIAC - Cambiar contraseña";
                    $data['page_title'] = "SIAC - Tlalnepantla de Baz";
                    $data['page_name'] = "cambiar_contraseña";
                    $data['idpersona'] = $arrResponse['id_funcionario'];
                    $data['email'] = $strEmail;
                    $data['token'] = $strToken;
                    $data['page_functions_js'] = "functions_login.js";
                    $this->views->getView($this,"cambiar_password",$data);
                }
            }
            die();
        }

        public function setPassword()
        {
            if(empty($_POST['idUsuario']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']))
            {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos');
            }else{
                $intIdpersona = intval(strClean($_POST['idUsuario']));
                $strPassword = $_POST['txtPassword'];
                $strPasswordConfirm = $_POST['txtPasswordConfirm'];
                $strEmail = strClean($_POST['txtEmail']);
                $strToken = strClean($_POST['txtToken']);

                if($strPassword != $strPasswordConfirm)
                {
                    $arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales');
                }else{
                    $arrResponseUser = $this->model->getUsuario($strEmail, $strToken);

                    if(empty($arrResponseUser))
                    {
                        $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
                    }else{
                        $strPassword = hash("SHA256",$strPassword);
                        $requestPass = $this->model->insertPassword($intIdpersona,$strPassword);

                        if($requestPass)
                        {
                            $arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada correctamente.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No fue posible realizar el proceso, intentelo más tarde.');
                        }
                    }
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        
    }
?>