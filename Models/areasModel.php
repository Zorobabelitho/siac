<?php
	
	class areasModel extends Mysql
	{
        private $intIdDependencia;

		public function __construct()
        {
            parent::__construct();
        }

        public function selectAreas($value='')
        {
            $sql = "SELECT * FROM vwarea where estatus = 'Activo' ORDER BY area DESC";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectAreaPorDependencia(int $id_dependencia)
        {
            $this->intIdDependencia = $id_dependencia;
            $sql = "SELECT * FROM vwArea WHERE Id_Dependencia = $this->intIdDependencia ORDER BY Areas";
            $request = $this->selectall($sql);
            return $request;
        }
        
        public function selectEnlacePorDependencia(int $id_dependencia)
        {
            $this->intIdDependencia = $id_dependencia;
            $sql = "SELECT * FROM vwEnlace WHERE Id_Dependencia = $this->intIdDependencia ORDER BY Funcionario";
            $request = $this->selectall($sql);
            return $request;
        }

        public function selectPrefijos(int $id_dependencia)
        {
            $this->intIdDependencia = $id_dependencia;
            $sql = "SELECT F.id_area, rtrim(Prefijo) + ' - ' + rtrim(AREA) as area_prefijo 
                    from tblArea A inner join tblFuncionario F on A.Id_Area = F.Id_Area 
                    where Id_Dependencia = 22 and Prefijo is not null and Prefijo <> '' and F.Id_Estatus_del_Registro = 1 ";
            if($id_dependencia != 76){
                $sql .= "and Prefijo <> 'OP' ";
            }
            $sql .= "group by F.Id_Area, Area, Prefijo order by area_prefijo ";
            $request = $this->selectall($sql);
            return $request;
        }
    }
	

?>