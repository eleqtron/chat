<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 16.06.13
 * Time: 15:04
 * To change this template use File | Settings | File Templates.
 */
namespace Framework;
class Router
{

    private static $oInstance;

    public static function getInstance() {
        if(!isset(self::$oInstance)) {
            self::$oInstance = new Router();
        }
        return self::$oInstance;
    }

    public static function processRequest(Request $oRequest) {
        if(isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
            $sPath = substr($_SERVER['PATH_INFO'],1);
            if(substr($sPath,-1) == "/") $sPath = substr($sPath,0,-1);
            $aResult = explode("/",$sPath);

            $oRequest->setController($aResult[0]);
            if(isset($aResult[1])) {
                $oRequest->setAction($aResult[1]);
            }
        }
        return $oRequest;
    }

}
