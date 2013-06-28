<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 27.06.13
 * Time: 10:48
 * To change this template use File | Settings | File Templates.
 */
namespace Classes;
class FabricPage
{
    public function getPageObject() {
        $oRequest = \Framework\Process::getRequest();
        switch($oRequest->getController()) {
            case "123";
                return new PageDefault(); //тут могут быть другие шаблоны
                break;
            default:
                return new PageDefault();
                break;
        }
    }
}
