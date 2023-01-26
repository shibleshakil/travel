<?php
namespace App\Traits;


trait ResourceContainerTrait{

    public function setResource($key,$resource){
        try {
            
            app()->instance($key,new AppResourceContainerServices($resource));
            return $resource;
        }catch(\Throwable $ex){
            
        }
        return null;
    }

    public function getResource($key){
        try{
            return app($key)->getResource();
        }catch(\Throwable $ex){
            //dd($ex->getMessage());
        }
       
        return null;
    }
}

class AppResourceContainerServices {

    private $resource;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function getResource(){
        return $this->resource;
    }
}
