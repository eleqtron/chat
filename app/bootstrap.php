<?php
/**
 * Created by JetBrains PhpStorm.
 * User: reminimalized
 * Date: 16.06.13
 * Time: 15:03
 * To change this template use File | Settings | File Templates.
 */
try {
    \Framework\Autoload::register();
    $oProcess = new \Framework\Process();
    $oProcess->run();
}
catch (\Framework\AppException $oEx) {
    echo  $oEx->getMessage();
}
catch (Exception $oEx) {
    echo  $oEx->getMessage();
}
