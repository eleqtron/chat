<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 26.06.13
 * Time: 16:06
 * To change this template use File | Settings | File Templates.
 */
namespace Framework;
class Process
{
    private static $oRequest;

    private static $oParameters;

    private function setRequest() {
        self::$oRequest = Router::processRequest(new Request());
    }

    private function initParameters() {
        self::$oParameters = new \Classes\Parameters();
    }


    public function run() {

        $this->setRequest();
        $this->initParameters();
        $oFabric = new \Classes\FabricPage();
        $oPage = $oFabric->getPageObject();
        $oPage->show();

    }

    public static function getRequest() {
        return self::$oRequest;
    }

    public static function  getParameters() {
        return self::$oParameters;
    }



}
