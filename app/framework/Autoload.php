<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 21.06.13
 * Time: 11:39
 * To change this template use File | Settings | File Templates.
 */
namespace Framework;
class Autoload
{
    public static function register() {
        if(!spl_autoload_register(__NAMESPACE__.'\Autoload::load')) {
            throw new AppException('Could not unregister '.__NAMESPACE__.' class autoload function');
        }
        if(!spl_autoload_register(__NAMESPACE__.'\Autoload::twigLoad')) {
            throw new AppException('Could not unregister '.__NAMESPACE__.' class autoload function');
        }

    }

    public static function unregister() {
        if (!spl_autoload_unregister(__NAMESPACE__.'\Autoload::load')) {
            throw new AppException('Could not unregister '.__NAMESPACE__.' class autoload function');
        }
    }

    public static function load($sClassName) {
        if(file_exists(BASE_PATH_APP.$sClassName.".php")) {
            @require_once(BASE_PATH_APP.$sClassName.".php");
        }

    }

    public static function twigLoad($sClassName) {

        if (is_file($file = LIBRARIES_URL.str_replace(array('_', "\0"), array('/', ''), $sClassName).'.php')) {
            require $file;
        }
    }

    private static function getFileByClass($class) {
        return str_replace('_', '/', $class).'.php';
    }

}
