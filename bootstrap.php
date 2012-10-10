<?php

namespace bootstrap;

$zf2Path = false;
if (getenv('ZF2_PATH')) {
    $zf2Path = getenv('ZF2_PATH');
}

if ($zf2Path) {
    include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';

    \Zend\Loader\AutoloaderFactory::factory(array(
        'Zend\Loader\StandardAutoloader' => array(
            'autoregister_zf' => true
        )
    ));
}

