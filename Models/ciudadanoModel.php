<?php

    class ciudadanoModel extends mysql
    {
        private $intIdCiudadano;
        private $strNombre;
        private $strApellidoPaterno;
        private $strApellidoMaterno;
        private $strDescripcion;
        private $strTelefono;
        private $intIdTipoContacto;
        private $intIdColonia;
        private $intIdCalle;
        private $strNumExterior;
        private $strNumInterior;
        private $intIdEntreCalle1;
        private $intIdEntreCalle2;
        private $strReferencias;
        private $strEmail;
        private $intStatus;
        private $intIdUsuarioInserto;
        private $intIdUsuarioModifico;

        public function __construct()
        {
            parent::__construct();
        }

        public function insertCiudadano(string $nombre, string $apellidopaterno, string $apellidomaterno, string $descripcion, string $telefono, int $idtipocontacto, int $idcolonida, int $idcalle, string $numeroexterior, string $numerointerior, int $identrecalle1, int $identrecalle2, string $referencias, string $email, int $estatus, int $idusuariorioinserto, int $idusuarioriomodifico)
        {
            $this->strNombre = $nombre;
            $this->strApellidoPaterno = $apellidopaterno;
            $this->strApellidoMaterno = $apellidomaterno;
            $this->strDescripcion = $descripcion;
            $this->strTelefono = $telefono;
            $this->intIdTipoContacto = $idtipocontacto;
            $this->intIdColonia = $idcolonida;
            $this->intIdCalle = $idcalle;
            $this->strNumExterior = $numeroexterior;
            $this->strNumInterior = $numerointerior;
            $this->intIdEntreCalle1 = $identrecalle1;
            $this->intIdEntreCalle2 = $identrecalle2;
            $this->strReferencias = $referencias;
            $this->strEmail = $email;
            $this->intStatus = $estatus;
            $this->intIdUsuarioInserto = $idusuariorioinserto;
            $this->intIdUsuarioModifico = $idusuarioriomodifico;
            $return = 0;

            //Validamos que no exista el telefono
            $sqlTelefono = "SELECT * FROM tblCiudadano WHERE Teleefono = '{$this->strTelefono}'";
            $requesTelefono = $this->select($sqlTelefono);

            if(empty($requesTelefono))
            {
                //Validamos que no exista el ciudadano
                $sqlNombre = "SELECT * FROM tblCiudadano WHERE Nombre = '{$this->strNombre}' AND Apellido_Paterno = '{$this->strApellidoPaterno}'";
                $requestNombre = $this->select($sqlNombre);

                if(empty($requestNombre))
                {
                    $query_insert = "INSERT INTO tblCiudadano (Nombre,Apellido_Paterno,Apellido_Materno,Descripcioon
                       ,Teleefono,Id_Tipo_de_Contacto,Tipo_de_Contacto,Id_Codigo_postal
                       ,Id_Calle,Nuumero_Exterior,Nuumero_Interior,Id_Entre_Calle_1
                       ,Id_Entre_Calle_2,Referencias,Correo_Electroonico
                       ,Id_Estatus_del_Registro,Id_Usuario_que_Insertoo
                       ,Id_Usuario_que_Modificoo,Fecha_de_Insercioon,Fecha_de_Modificacioon
                       ,Teleefono_Moovil,TipoSexo,Fecha_Nacimiento,GustoInteres)
                        VALUES
                       (?,?,?,?,?,?,'',?,?,?,?,?,?,?,?,?,?,?,GETDATE(),GETDATE(),'','','','') ";

                    $arrData = array($this->strNombre,
                                    $this->strApellidoPaterno,
                                    $this->strApellidoMaterno,
                                    $this->strDescripcion,
                                    $this->strTelefono,
                                    $this->intIdTipoContacto,
                                    $this->intIdColonia,
                                    $this->intIdCalle,
                                    $this->strNumExterior,
                                    $this->strNumInterior,
                                    $this->intIdEntreCalle1,
                                    $this->intIdEntreCalle2,
                                    $this->strReferencias,
                                    $this->strEmail,
                                    $this->intStatus,
                                    $this->intIdUsuarioInserto,
                                    $this->intIdUsuarioModifico);
                    $request_insert = $this->insert($query_insert,$arrData);
                    $return = $request_insert;

                }else{
                    $return = "existNombre";    
                }

            }else{
                $return = "existTelefono";
            }
            return $return;

        }

        public function updateCiudadano(int $idciudadano, string $nombre, string $apellidopaterno, string $apellidomaterno, string $descripcion, string $telefono, int $idtipocontacto, int $idcolonida, int $idcalle, string $numeroexterior, string $numerointerior, int $identrecalle1, int $identrecalle2, string $referencias, string $email, int $estatus, int $idusuarioriomodifico)
        {
            $this->intIdCiudadano = $idciudadano;
            $this->strNombre = $nombre;
            $this->strApellidoPaterno = $apellidopaterno;
            $this->strApellidoMaterno = $apellidomaterno;
            $this->strDescripcion = $descripcion;
            $this->strTelefono = $telefono;
            $this->intIdTipoContacto = $idtipocontacto;
            $this->intIdColonia = $idcolonida;
            $this->intIdCalle = $idcalle;
            $this->strNumExterior = $numeroexterior;
            $this->strNumInterior = $numerointerior;
            $this->intIdEntreCalle1 = $identrecalle1;
            $this->intIdEntreCalle2 = $identrecalle2;
            $this->strReferencias = $referencias;
            $this->strEmail = $email;
            $this->intStatus = $estatus;
            $this->intIdUsuarioModifico = $idusuarioriomodifico;

            $sql = "SELECT * FROM tblCiudadano WHERE Teleefono = '{$this->strTelefono}' AND Id_Ciudadano != $this->intIdCiudadano ";
            $request = $this->selectall($sql);

            if(empty($request))
            {
                $sql = "UPDATE tblCiudadano
                           SET Nombre = ?,
                              Apellido_Paterno = ?,
                              Apellido_Materno = ?,
                              Descripcioon = ?,
                              Teleefono = ?,
                              Id_Tipo_de_Contacto = ?,
                              Id_Codigo_postal = ?,
                              Id_Calle = ?,
                              Nuumero_Exterior = ?,
                              Nuumero_Interior = ?,
                              Id_Entre_Calle_1 = ?,
                              Id_Entre_Calle_2 = ?,
                              Referencias = ?,
                              Correo_Electroonico = ?,
                              Id_Estatus_del_Registro = ?,
                              Id_Usuario_que_Modificoo = ?,
                              Fecha_de_Modificacioon = GETDATE()
                         WHERE Id_Ciudadano = $this->intIdCiudadano ";

                $arrData = array($this->strNombre,
                                $this->strApellidoPaterno,
                                $this->strApellidoMaterno,
                                $this->strDescripcion,
                                $this->strTelefono,
                                $this->intIdTipoContacto,
                                $this->intIdColonia,
                                $this->intIdCalle,
                                $this->strNumExterior,
                                $this->strNumInterior,
                                $this->intIdEntreCalle1,
                                $this->intIdEntreCalle2,
                                $this->strReferencias,
                                $this->strEmail,
                                $this->intStatus,
                                $this->intIdUsuarioModifico);

                $request = $this->update($sql, $arrData);
            }else{
                $request = "existTelefono";
            }
            return $request;
        }

        public function selectCiudadano(int $idciudadano)
        {
            $this->intIdCiudadano = $idciudadano;
            $sql = "SELECT vwC.Id, vwC.Codigo, tblC.Id_Tipo_de_Contacto, vwC.Tipo_de_Contacto,
                    vwC.Ciudadano, vwC.Domicilio, vwC.Teleefono, vwC.Calle, vwC.Nuumero_Exterior,
                    vwC.Nuumero_Interior, vwC.Colonia, vwC.Entre_calle_1, vwC.Entre_calle_2,
                    vwC.Id_Entre_Calle_1, vwC.Id_Entre_Calle_2, tblC.Id_Estatus_del_Registro,
                    vwC.Referencias, vwC.Correo_Electroonico, vwC.Estatus_del_Registro,
                    vwC.Nombre, vwC.Apellido_Paterno, vwC.Apellido_Materno, vwC.Descripcioon,
                    vwC.Id_Calle, vwC.Id_colonia, vwCol.Codigo_Postal
                    FROM vwCiudadano vwC
                    INNER JOIN tblCiudadano tblC ON vwC.Id = tblC.Id_Ciudadano
                    INNER JOIN vwColonia vwCol ON vwCol.Id = vwC.Id_colonia
                    WHERE vwC.Id = $this->intIdCiudadano ";
            $request = $this->select($sql);
            return $request;
        }

        public function selectBusquedaCiudadano(string $busquedaCiu, int $tipo)
        {
            $this->tipobusqueda = $tipo;
            $this->busqueda = $busquedaCiu;
            if($tipo == 1)
            {
                $sql = "SELECT Id, Ciudadano, Colonia, Teleefono FROM vwCiudadano WHERE Teleefono LIKE '%$this->busqueda%' AND Estatus_del_Registro = 'Activo'";
            }else{
                $sql = "SELECT Id, Ciudadano, Colonia, Teleefono FROM vwCiudadano where Ciudadano LIKE '%$this->busqueda%' AND Estatus_del_Registro = 'Activo'";
            }

            $request = $this->selectall($sql);
            return $request;
        }
    }

?>