<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 19.03.13
 * Time: 15:02
 * To change this template use File | Settings | File Templates.
 */
namespace Framework;
class DatabaseHandler
{
    private static $_oPDO;

    /**
     * Закрытый конструктор, чтобы нельзя было создать экземпляр класса,
     * так как все методы статические оК?
     */
    private function __construct() {

    }

    /**
     * Установка соединения с базой, если объет PDO ещё не был создан
     * @return object PDO
     */
    private static function getHandler() {

        if(!isset(self::$_oPDO)) {

            try {
                $sDsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
                self::$_oPDO = new \PDO($sDsn,DB_USER,DB_PASS,array(
                    \PDO::ATTR_PERSISTENT => true
                ));
                self::$_oPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                self::$_oPDO->query( 'SET character_set_connection = ' . DB_CHARSET . ';' );
                self::$_oPDO->query( 'SET character_set_client = ' . DB_CHARSET . ';' );
                self::$_oPDO->query( 'SET character_set_results = ' . DB_CHARSET . ';' );
            }
            catch(\PDOException $oExp) {
                self::close();
                throw new NewPDOException($oExp->getMessage(),$oExp->getCode(),$oExp);
            }

        }

        return self::$_oPDO;

    }

    /**
     * Очистка объекта PDO
     */
    public static function close() {
        self::$_oPDO = null;
    }

    /**
     * Выполняет запрос к базе данных,не возвращающий данные (INSERT,UPDATE,DELETE)
     * @param string $sQuery
     * @param array $aData
     */
    public static function Execute($sQuery,$aData = array()) {
        try {
            $oPDO = self::getHandler();
            $oRequest = $oPDO->prepare($sQuery);
            $oRequest->execute($aData);
        }
        catch(\PDOException $oExp) {

            self::close();
            throw new \NewPDOException($oExp->getMessage(),(int)$oExp->getCode(),$oExp);
        }

    }

    /**
     * Выполняет запрос к базе данных, который возвращает массив с результатом выборки
     * @param string $sQuery
     * @param array $aData
     * @param int $fetchStyle
     * @return null|array
     */
    public static function getAll($sQuery,$aData = array(),$fetchStyle = PDO::FETCH_ASSOC) {
        $aRes = null;
        try {
            $oPDO = self::getHandler();
            $oRequest = $oPDO->prepare($sQuery);
            $oRequest->execute($aData);
            $aRes = $oRequest->fetchAll($fetchStyle);
        }
        catch(PDOException $oExp) {
            self::close();
            throw new NewPDOException($oExp->getMessage(),$oExp->getCode(),$oExp);
            //trigger_error($oExp->getMessage(),E_USER_ERROR);
        }
        return $aRes;
    }

    /**
     * Выполняет запрос к базе данных, который возвращает массив результирующей строки базы
     * @param string $sQuery
     * @param array $aData
     * @param int $fetchStyle
     * @return null|array
     */
    public static function getRow($sQuery,$aData = array(),$fetchStyle = PDO::FETCH_ASSOC) {
        $aRes = null;
        try {
            $oPDO = self::getHandler();
            $oRequest = $oPDO->prepare($sQuery);
            $oRequest->execute($aData);
            $aRes = $oRequest->fetch($fetchStyle);
        }
        catch(PDOException $oExp) {
            self::close();
            throw new NewPDOException($oExp->getMessage(),$oExp->getCode(),$oExp);
            //trigger_error($oExp->getMessage(),E_USER_ERROR);
        }
        return $aRes;
    }


    /**
     * Выполняет запрос к базе данных, который возвращает едиственное значение из запроса SELECT
     * @param string $sQuery
     * @param array $aData
     * @param int $fetchStyle
     * @return null|mixed
     */
    public static function getOne($sQuery,$aData = array(),$fetchStyle = PDO::FETCH_NUM) {
        $mRes = null;
        try {
            $oPDO = self::getHandler();
            $oRequest = $oPDO->prepare($sQuery);
            $oRequest->execute($aData);
            $aRes = $oRequest->fetch($fetchStyle);
            $mRes = $aRes[0];
        }
        catch(PDOException $oExp) {
            self::close();
            throw new NewPDOException($oExp->getMessage(),$oExp->getCode(),$oExp);
            //trigger_error($oExp->getMessage(),E_USER_ERROR);
        }
        return $mRes;
    }

}
