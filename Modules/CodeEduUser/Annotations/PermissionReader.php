<?php

namespace CodeEduUser\Annotations;

use CodeEduUser\Annotations\Mapping\Action;
use CodeEduUser\Annotations\Mapping\Controller;
use Doctrine\Common\Annotations\Reader;

class PermissionReader{
    /**
     * @var Reader
     */
    private $reader;


    /**
     * PermissionReader constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }


    public function getPermissions()
    {
        $controllersClass = $this->getControllers();
        $delared = get_declared_classes();
        $permissions = [];
        foreach ($delared as $className){
            $rc = new \ReflectionClass($className);
            if (in_array($rc->getFileName(), $controllersClass)){
                $permission = $this->getPermission($className);
                if (count($permission)){
                    $permissions =array_merge($permissions, $permission);
                }
            }
        }
        return $permissions;
    }

    public function getPermission($controllerClass)
    {
        $rc = new \ReflectionClass($controllerClass);
        /** @var Controller $controllerAnnotation */
        $controllerAnnotation = $this->reader->getClassAnnotation($rc, Controller::class);

        $permissions = [];
        if ($controllerAnnotation){
            $permission = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];
            $rcMethods = $rc->getMethods();

            foreach ($rcMethods as $rcMethod){
                /** @var Action $$actionAnnotation */
                $actionAnnotation = $this->reader->getMethodAnnotation($rcMethod, Action::class);

                if ($actionAnnotation){
                    $permission['resource_name'] = $actionAnnotation->name;
                    $permission['resource_description'] = $actionAnnotation->description;
                    $permissions[] = (new \ArrayIterator($permission))->getArrayCopy();
                }
            }

        }
        return $permissions;


    }

    private function getControllers(){
        $dirs = config('codeeduuser.acl.controllers_annotations');
        //dd($dirs);
        $files=[];
        foreach ($dirs as $dir){
            foreach (\File::allFiles($dir) as $file){
                $files[] = $file->getRealPath();
                require_once $file->getRealPath();
            }
        }
        return $files;
    }


}