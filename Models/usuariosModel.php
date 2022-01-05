<?php

    class usuariosModel extends mysql
    {
        private $intIdUsuario;
        private $strNombre;
        private $strDescripcion;
        private $strTelefono;
        private $strTelefonoMovil;
        private $strConmutador;
        private $strExtension;
        private $intArea;
        private $intRol;
        private $intStatus;
        private $strCorreo;
        private $strPassword;
        private $strToken;
        private $intIdDependencia;

        public function __construct()
        {
            parent::__construct();
        }

        public function insertUsuario(string $nombre, string $descripcion, string $telefono, string $telefonomovil, string $conmutador, string $extension, int $area, int $rol, int $status, string $correo, string $password)
        {
            $this->strNombre = $nombre;
            $this->strDescripcion = $descripcion;
            $this->strTelefono = $telefono;
            $this->strTelefonoMovil = $telefonomovil;
            $this->strConmutador = $conmutador;
            $this->strExtension = $extension;
            $this->intArea = $area;
            $this->intRol = $rol;
            $this->intStatus = $status;
            $this->strCorreo = $correo;
            $this->strPassword = $password;
            $return = 0;

            $sql = "SELECT * FROM tblfuncionario WHERE correo_electroonico = '{$this->strCorreo}'";
            $request = $this->select($sql);

            if(empty($request))
            {
                $query_insert = "INSERT INTO tblfuncionario(funcionario, descripcioon, id_area, teleefono_directo, fax, conmutador, extensiones, teleefono_moovil, correo_electroonico, id_permiso, clave, id_estatus_del_registro, id_usuario_que_insertoo, id_usuario_que_modificoo, fecha_de_insercioon, fecha_de_modificacioon) VALUES (?,?,?,?, '0',?,?,?,?,?,?,?, 4, 4, GETDATE(),GETDATE())";
                $arrData = array($this->strNombre,
                                $this->strDescripcion,
                                $this->intArea,
                                $this->strTelefono,
                                $this->strConmutador,
                                $this->strExtension,
                                $this->strTelefonoMovil,
                                $this->strCorreo,
                                $this->intRol,
                                $this->strPassword,
                                $this->intStatus);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }

        public function selectUsuarios()
        {
            $whereAdmin = "";
            if ($_SESSION['idUser'] != 2126) {
                $whereAdmin = " and tblf.id_funcionario != 2126 ";
            }

            $sql = "SELECT tblf.id_funcionario, tblf.funcionario, tblp.permiso, tblf.id_estatus_del_registro, tblp.Id_Permiso
                    FROM tblfuncionario tblf 
                    INNER JOIN tblpermiso tblp ON tblp.id_permiso = tblf.id_permiso
                    WHERE tblf.id_estatus_del_registro != 0 ".$whereAdmin;
            $request = $this->selectall($sql);
            return $request;

        }

        public function selectUsuario(int $idpersona)
        {
            $this->intIdUsuario = $idpersona;
            $sql = "SELECT tblf.id_funcionario, tblf.funcionario, tblf.descripcioon, tblf.teleefono_directo, tblf.teleefono_moovil, tblf.conmutador, tblf.extensiones, tbla.area, tblf.id_area, tblp.permiso, tblf.id_permiso, tblf.correo_electroonico, tblf.id_estatus_del_registro, CONVERT(varchar(10),tblf.Fecha_de_Insercioon,103) as fechaRegistro
                    FROM tblfuncionario tblf 
                    INNER JOIN tblarea tbla ON tbla.id_area = tblf.id_area
                    INNER JOIN tblpermiso tblp ON tblp.id_permiso = tblf.id_permiso
                    WHERE tblf.id_funcionario = $this->intIdUsuario";
            $request = $this->select($sql);
            return $request;
        }

        public function updateUsuario(int $idUsuario, string $nombre, string $descripcion, string $telefono, string $telefonomovil, string $conmutador, string $extension, int $area, int $rol, int $status, string $correo, string $password)
        {
            $this->intIdUsuario = $idUsuario;
            $this->strNombre = $nombre;
            $this->strDescripcion = $descripcion;
            $this->strTelefono = $telefono;
            $this->strTelefonoMovil = $telefonomovil;
            $this->strConmutador = $conmutador;
            $this->strExtension = $extension;
            $this->intArea = $area;
            $this->intRol = $rol;
            $this->intStatus = $status;
            $this->strCorreo = $correo;
            $this->strPassword = $password;

            $sql = "SELECT * FROM tblfuncionario WHERE correo_electroonico = '{$this->strCorreo}' AND id_funcionario != $this->intIdUsuario";

            $request = $this->selectall($sql);

            if(empty($request))
            {
                if($this->strPassword != "")
                {
                    $sql = "UPDATE tblfuncionario SET funcionario=?,descripcioon=?,id_area=?,teleefono_directo=?,conmutador=?,extensiones=?,teleefono_moovil=?,correo_electroonico=?,id_permiso=?,clave=?,id_estatus_del_registro=?,id_usuario_que_modificoo=4,fecha_de_modificacioon=GETDATE() WHERE id_funcionario = $this->intIdUsuario";
                    $arrData = array($this->strNombre,
                                    $this->strDescripcion,
                                    $this->intArea,
                                    $this->strTelefono,
                                    $this->strConmutador,
                                    $this->strExtension,
                                    $this->strTelefonoMovil,
                                    $this->strCorreo,
                                    $this->intRol,
                                    $this->strPassword,
                                    $this->intStatus);
                }else{
                    $sql = "UPDATE tblfuncionario SET funcionario=?,descripcioon=?,id_area=?,teleefono_directo=?,conmutador=?,extensiones=?,teleefono_moovil=?,correo_electroonico=?,id_permiso=?,id_estatus_del_registro=?,id_usuario_que_modificoo=4,fecha_de_modificacioon=GETDATE() WHERE id_funcionario = $this->intIdUsuario";
                    $arrData = array($this->strNombre,
                                    $this->strDescripcion,
                                    $this->intArea,
                                    $this->strTelefono,
                                    $this->strConmutador,
                                    $this->strExtension,
                                    $this->strTelefonoMovil,
                                    $this->strCorreo,
                                    $this->intRol,
                                    $this->intStatus);
                }
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }

            return $request;
        }

        public function deleteUsuario(int $idpersona)
        {
            $this->intIdUsuario = $idpersona;
            $sql = "UPDATE tblfuncionario SET id_estatus_del_registro = ? 
                    WHERE id_funcionario = $this->intIdUsuario";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            return $request;
        }

        public function getSelectFuncionarioPorDependencia(int $iddependencia)
        {
            $this->intIdDependencia = $iddependencia;
            $sql = "SELECT * FROM vwFuncionario where Id_Dependencia = $this->intIdDependencia ORDER BY Nombre ";
            $request = $this->selectall($sql);
            return $request;

        }

    }

?>