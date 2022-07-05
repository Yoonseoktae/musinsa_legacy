<?php
include "define.php";


try {

    // 라우트 기능으로 MVC패턴식 처리.
    $R = new Lib\Common\App();
    $RESULT = $R->initApp();

    
} catch(\Exception $e) {
    var_dump($e);
}
