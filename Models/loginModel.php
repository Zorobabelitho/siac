<?php

    class loginModel extends mysql
    {

        private $intIdUsuario;
        private $strUsuario;
        private $strPassword;
        private $strToken;

        public function __construct()
        {
            parent::__construct();
        }

        public function loginUser(string $usuario, string $password)
        {
            $this->strUsuario = $usuario;
            $this->strPassword = $password;

            $sql = "SELECT id_funcionario, id_estatus_del_registro FROM tblfuncionario 
                    WHERE correo_electroonico = '$this->strUsuario' AND 
                    clave = '$this->strPassword' AND 
                    id_estatus_del_registro != 0 ";
            
            $request = $this->select($sql);
            return $request;
        }

        public function sessionLogin(int $iduser)
        {
            $this->intIdUsuario = $iduser;

            $sql = "SELECT tblf.id_funcionario, tblf.funcionario, tbla.Id_Dependencia, tbla.id_area, tbla.area, tblf.teleefono_moovil,
                        tblf.correo_electroonico, tblp.id_permiso, tblp.permiso, tblf.id_estatus_del_registro
                    FROM tblfuncionario tblf 
                    INNER JOIN tblpermiso tblp ON tblp.id_permiso = tblf.id_permiso
                    INNER JOIN tblarea tbla ON tbla.id_area = tblf.id_area
                    WHERE tblf.id_funcionario = $this->intIdUsuario";

            $request = $this->select($sql);
            return $request;
        }

        public function getUserEmail(string $email)
        {
            $this->strUsuario = $email;
            $sql = "SELECT id_funcionario, funcionario, id_estatus_del_registro FROM tblfuncionario WHERE correo_electroonico = '$this->strUsuario' AND id_estatus_del_registro = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function setTokenUser(int $idpersona, string $token)
        {
            $this->intIdUsuario = $idpersona;
            $this->strToken = $token;
            $sql = "UPDATE tblfuncionario SET fax = ? WHERE id_funcionario = $this->intIdUsuario";
            $arrData = array($this->strToken);
            $request = $this->update($sql,$arrData);
            return $request;
        }

        public function getUsuario(string $email, string $token)
        {
            $this->strUsuario = $email;
            $this->strToken = $token;
            $sql = "SELECT id_funcionario FROM tblfuncionario WHERE 
                    correo_electroonico = '$this->strUsuario' AND
                    fax = '$this->strToken' AND
                    id_estatus_del_registro = 1 ";
            $request = $this->select($sql);
            return $request;
        }

        public function insertPassword(string $idpersona, string $password)
        {
            $this->intIdUsuario = $idpersona;
            $this->strPassword = $password;
            $sql = "UPDATE tblfuncionario SET clave = ?, fax = ? WHERE id_funcionario = $this->intIdUsuario ";
            $arrData = array($this->strPassword,"");
            $request = $this->update($sql,$arrData);
            return $request;
        }
    }

?>