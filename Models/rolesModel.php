<?php

    class rolesModel extends Mysql
    {
        public $intIdrol;
        public $strRol;
        public $strDescripcion;
        public $intStatus;

        public function __construct()
        {
            parent::__construct();
        }

        public function selectRoles($value='')
        {
            $sql = "SELECT id_permiso, permiso, id_estatus_del_registro FROM tblpermiso WHERE id_estatus_del_registro != 0 ORDER BY 2 ";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectRolesActivos($value='')
        {
            $sql = "SELECT id_permiso, permiso, id_estatus_del_registro FROM tblpermiso WHERE id_estatus_del_registro != 0 ORDER BY 2 ";
            $request = $this->selectall($sql);
            return $request;
        }

        public  function selectRol(int $idrol)
        {
            $this->intIdrol = $idrol;
            $sql = "SELECT id_permiso, permiso, id_estatus_del_registro, descripcion FROM tblpermiso WHERE id_permiso = $this->intIdrol";
            $request = $this->select($sql);
            return $request;
        }

        public function insertRol(string $rol, string $desc, int $status)
        {
            $return = "";
            $this->strRol = $rol;
            $this->strDescripcion = $desc;
            $this->intStatus = $status;

            $sql = "SELECT * FROM tblpermiso WHERE permiso = '{$this->strRol}' ";
            $request = $this->selectall($sql);

            if(empty($request))
            {
                $query_insert = "INSERT INTO tblpermiso( permiso, nivel, descripcion, id_estatus_del_registro, id_usuario_que_insertoo, id_usuario_que_modificoo, fecha_de_insercioon, fecha_de_modificacioon) VALUES (?, 0, ?, ?, 4, 4, GETDATE(), GETDATE())";
                $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else {
                $return = "exist";
            }

            return $return;
        }

        public function updateRol(int $idrol, string $rol, string $desc, int $status)
        {
            $this->intIdrol = $idrol;
            $this->strRol = $rol;
            $this->strDescripcion = $desc;
            $this->intStatus = $status;

            $sql = "SELECT * FROM tblpermiso WHERE permiso = '$this->strRol' AND id_permiso != $this->intIdrol ";
            $request = $this->selectall($sql);

            if(empty($request))
            {
                $sql = "UPDATE tblpermiso SET permiso = ?, descripcion = ?, id_estatus_del_registro = ? WHERE id_permiso = $this->intIdrol";
                $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }

            return $request;
        }

        public function deleteRol(int $idrol)
        {
            $this->intIdrol = $idrol;
            $sql = "SELECT * FROM tblfuncionario where id_permiso = $this->intIdrol";
            $request = $this->selectall($sql);
            if(empty($request))
            {
                $sql = "UPDATE tblpermiso SET id_estatus_del_registro = ? WHERE id_permiso = $this->intIdrol ";
                $arrData = array(0);
                $request = $this->update($sql,$arrData);
                if($request)
                {
                    $request = 'ok';    
                }else{
                    $request = 'error';
                }
            }else{
                $request = 'exist';
            }
            return $request;
        }
    }
?>