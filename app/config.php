<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 16.06.13
 * Time: 14:54
 * To change this template use File | Settings | File Templates.
 */

iconv_set_encoding("input_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");
iconv_set_encoding("internal_encoding", "UTF-8");

define("BASE_PATH", $_SERVER['DOCUMENT_ROOT']."/forum/");
define("BASE_PATH_APP", BASE_PATH."app/");
define("BASE_URL", "http://".$_SERVER['SERVER_NAME']."/");
define("LIBRARIES_URL", BASE_PATH_APP."libraries/");
define("CONTROLLERS_PATH",BASE_PATH_APP."controllers/");
define("MODELS_PATH",BASE_PATH_APP."models/");
define("MODULES_PATH",BASE_PATH_APP."modules/");

//Конфигурация базы данных
define("DB_HOST","localhost");
define("DB_NAME","apps_forum");
define("DB_USER","remi");
define("DB_PASS","remi23091990");
define("DB_CHARSET","utf8");
define("DB_PREFIX","");

//Конфигурация шаблонизатора
define("TWIG_FILESYSTEM",BASE_PATH_APP.'views/');
define("TWIG_LAYOUTS",'layouts/');
define("TWIG_TEMPLATES",'templates/');
define("TWIG_TPL_GENERAL",TWIG_TEMPLATES.'_general/');

function __autoload($sClassName) {

    if(strpos($sClassName,"\\")) {
        //для пространств имен
        if(file_exists(BASE_PATH_APP.$sClassName.".php")) {
            require_once(BASE_PATH_APP.$sClassName.".php");
        }
        return true;
    }
    else {

        require_once(BASE_PATH_APP.$sClassName.".php");
        return true;

    }

}
