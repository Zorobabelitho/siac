<?php

    //define("BASE_URL", "http://localhost/SIAC/");
    const BASE_URL = "http://localhost/SIAC";

    //Zona horaria
    date_default_timezone_set('America/Mexico_City');

    //Datos de conexión a Base de datos
    //Local
    /*const DB_HOST = "localhost\SQLEXPRESS";
    const DB_NAME = "AtnCiu2019";
    const DB_USER = "sa";
    const DB_PASSWORD = "12345";
    const DB_CHARSET = "charset=utf8";*/

    //Servidor
    const DB_HOST = "187.189.251.164,1433";
    const DB_NAME = "AtnCiu2019";
    const DB_USER = "sa";
    const DB_PASSWORD = "SA*20192021*";
    const DB_CHARSET = "charset=utf8";

    //Datos envio de correo
    const NOMBRE_REMITENTE = "SIAC - Tlalnepantla de Baz";
    const EMAIL_REMITENTE = "no-reply@tlalnepantla.com";
    const NOMBRE_EMPESA = "H. Ayuntamiento de Tlalnepantla de Baz";
    const WEB_EMPRESA = "";

    //Delimitadores decimal y millar.
    const SPD = ".";
    const SPM = ",";

    //Simbolo de moneda
    const SMONEY = "$";
?>