<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 26.06.13
 * Time: 22:03
 * To change this template use File | Settings | File Templates.
 */
namespace Modules;
class Controller extends AbstractModule
{
    public function getContent() {

        $oRequest = \Framework\Process::getRequest();

        $sControllerName = $oRequest->getController();
        $sActionName = $oRequest->getAction();

        $oController = new $sControllerName();
        return $oController->$sActionName();

    }
}
