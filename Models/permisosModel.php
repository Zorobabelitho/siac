<?php
	class PermisosModel extends Mysql
	{
		
		public $intIdpermiso;
		public $intIdrol;
		public $intModuloid;
		public $r;
		public $w;
		public $u;
		public $d;

		public function __construct()
		{
			parent::__construct();
		}


		public function selectModulos()
		{
			$sql = "SELECT * FROM tblModulo WHERE status != 0 ORDER BY 1";
			$request = $this->selectall($sql);
			return $request;
		}

		public function selectPermisosRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM tblPermisos WHERE rolid = $this->intIdrol ORDER BY 3 ASC";
			$request = $this->selectall($sql);
			return $request;
		}

		public function deletePermisos(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "DELETE FROM tblPermisos WHERE rolid = $this->intIdrol";
			$request= $this->delete($sql);
			return $request;
		}

		public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d)
		{
			$this->intIdrol = $idrol;
			$this->intModuloid = $idmodulo;
			$this->r = $r;
			$this->w = $w;
			$this->u = $u;
			$this->d = $d;
			$query_insert = "INSERT INTO tblPermisos(rolid,moduloid,r,w,u,d) VALUES(?,?,?,?,?,?)";
			$arrData = array($this->intIdrol, $this->intModuloid, $this->r, $this->w, $this->u, $this->d);
			$request_insert = $this->insert($query_insert,$arrData);
			return $request_insert;
		}

		public function getRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM tblPermiso WHERE id_permiso = $this->intIdrol";
			$request = $this->select($sql);
			return $request;
		}

		public function permisosModulo(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT p.rolid, p.moduloid, m.titulo as modulo, p.r, p.w, p.u, p.d 
					FROM tblPermisos p 
					INNER JOIN tblModulo m ON p.moduloid = m.idmodulo 
					WHERE p.rolid = $this->intIdrol ";
			$request = $this->selectall($sql);
			$arrPermisos = array();

			for ($i=0; $i < count($request) ; $i++) { 
				$arrPermisos[$request[$i]['moduloid']] = $request[$i];
			}
			return $arrPermisos;
		}
	}
?>