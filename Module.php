<?php
namespace EdpModuleLayouts;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $config          = $e->getApplication()->getServiceManager()->get('config');
            foreach($config['module_layouts'] as $module_namespace => $layout){
                if(false !== strpos($controllerClass, $module_namespace)){
                    $controller->layout($layout);
                }
            }
        }, 100);
    }
}
