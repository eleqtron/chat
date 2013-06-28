<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 26.06.13
 * Time: 20:23
 * To change this template use File | Settings | File Templates.
 */
namespace Classes;
class Parameters
{
    private $aParameters = array(
        "title"=>"Простенький форум"
    );
    private $aStyles = array();
    private $aScripts= array();

    public function setParameter($sName,$mVal) {
        $this->aParameters[$sName] = $mVal;
    }

    public function getParameter($sName) {
        if(isset($this->aParameters[$sName])) {
            return $this->aParameters[$sName];
        }
        else {
            return false;
        }
    }

    public function getParams() {
        return $this->aParameters;
    }

    public function addStyle($sCSSFilePath) {
        if(!in_array($sCSSFilePath,$this->aStyles)) {
            $this->aStyles[] = $sCSSFilePath;
        }
    }

    public function getStyles() {
        return $this->aStyles;
    }

    public function addScript($sJSFilePath) {
        if(!in_array($sJSFilePath,$this->aStyles)) {
            $this->aScripts[] = $sJSFilePath;
        }
    }

    public function getScripts() {
        return $this->aScripts;
    }

}
