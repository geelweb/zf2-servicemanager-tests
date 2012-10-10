<?php

namespace MyApp {
    include 'bootstrap.php';

    use Zend\ServiceManager\FactoryInterface;
    use Zend\ServiceManager\ServiceLocatorInterface;

    class Service {
        public $config;
        public function __construct($config)
        {
            $this->config = $config;
        }
    }

    class ServiceFactory implements FactoryInterface {
        public function createService(ServiceLocatorInterface $serviceLocator)
        {
            $config = $serviceLocator->get('Config');
            return new Service($config->foo);
        }
    }

    class Config {
        public $foo = 'foo';
    }
}

namespace {
    include 'bootstrap.php';

    $sm = new \Zend\ServiceManager\ServiceManager;
    $sm->setInvokableClass('Config', 'MyApp\Config');
    $sm->setFactory('MyApp\Service', 'MyApp\ServiceFactory');

    $service = $sm->get('MyApp\Service');

    $works = ($service instanceof MyApp\Service) && ($service->config == 'foo');

    echo ($works ? 'It works' : 'It does not works') . PHP_EOL;
}
