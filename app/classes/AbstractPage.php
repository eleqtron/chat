<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 26.06.13
 * Time: 21:39
 * To change this template use File | Settings | File Templates.
 */
namespace Classes;
abstract class AbstractPage
{

    protected  $aModules = array("Authorization","TopMenu","Controller");    //набор модулей

    protected $sLayout  = "main.html"; //шаблон из папки views/layouts
    //названия модулей соответствуют меткам в шаблоне, метки будут заменены контентом возвращаемым модулями
    protected $aData = array();

    protected $sHTML = "";

    public function __construct() {
        $this->runModules();
        $this->aData["aParameters"] = \Framework\Process::getParameters()->getParams();
        $this->aData["aStyles"] = \Framework\Process::getParameters()->getStyles();
        $this->aData["aScripts"] = \Framework\Process::getParameters()->getScripts();
        $this->parseLayout();
    }

    public function runModules() {
        foreach($this->aModules as $sKey) {

            $sModuleName =  ucfirst($sKey);
            if(file_exists(MODULES_PATH.$sModuleName.".php")) {
                $sModuleName = "\\Modules\\".$sModuleName;
                $oModule = new $sModuleName();
                $this->aData[$sKey] = $oModule->getContent();
            }
        }
    }

    public function parseLayout() {
        echo "<pre>";

        print_r($this->aData);

        echo "</pre>";
        $this->sHTML = \Framework\Twig::render(TWIG_LAYOUTS.$this->sLayout,$this->aData);
    }

    public function show() {
        echo $this->sHTML;
    }

}
