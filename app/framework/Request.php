<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 16.06.13
 * Time: 15:04
 * To change this template use File | Settings | File Templates.
 */
namespace Framework;
class Request
{
    private $sController = "\\Controllers\\Main";
    private $sAction = "index";

    public function getController() {

        return $this->sController;

    }

    public function getAction() {

        return $this->sAction;

    }

    public function setController($sControllerName) {

        if(file_exists(CONTROLLERS_PATH.ucfirst($sControllerName).".php")) {
            $this->sController = "\\Controllers\\".ucfirst($sControllerName);
            return true;
        }
        throw new AppException("Нет контроллера с таким именем");#todo сделать коды исключений

    }

    public function setAction($sActionName) {

        $sActionName = strtolower($sActionName);
        if(method_exists("\\Controllers\\".$this->sController,$sActionName)) {
            $this->sAction = $sActionName;
            return true;
        }
        throw new AppException("Нет действия с таким именем");#todo сделать коды исключений

    }

}
