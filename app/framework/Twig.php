<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 19.03.13
 * Time: 19:38
 * To change this template use File | Settings | File Templates.
 */
namespace Framework;
class Twig
{
    private static $_oTwig;

    private  function __construct() {

    }

    private static function getTwigConfig($filesystem = TWIG_FILESYSTEM) {
        $oLoader = new \Twig_Loader_Filesystem($filesystem);
        self::$_oTwig = new \Twig_Environment($oLoader, array(
            'cache' => false,
            'autoescape' => false,
            'debug'=>true
        ));
        self::$_oTwig->addExtension(new \Twig_Extension_Debug());
    }

    public static function render($sTemplate,$aData) {

        $sOut = '';
        try {
            if(!self::$_oTwig) {
                try {
                    /*
                    $aTwigFileSystem = array(
                        0 => BASE_PATH_APP."views",
                        //1 => BASE_PATH_APP."templates"
                    );
                    */
                    self::getTwigConfig();
                }
                catch(\Framework\AppException $oExp) {  #
                    echo $oExp->getMessage();
                }
            }
            $sOut = self::$_oTwig->render($sTemplate,$aData);
        }
        catch(\Framework\AppException $oExp) {
            echo $oExp->getMessage();
        }
        return $sOut;

    }


}
