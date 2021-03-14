<?php

namespace Core;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Validation\Factory;

class Container
{
    public static function newController($contoller)
    {
        $objContoller = "App\\Controllers\\" . $contoller;
        return new $objContoller;
    }

    public static function getModel($model)
    {
        $objModel = "\\App\\Models\\" . $model;
        return new $objModel(DataBase::getDatabase());
    }

    public static function pageNotFound()
    {
        if(file_exists(__DIR__ . "/../app/Views/404.phtml")){
            return require_once __DIR__ . "/../app/Views/404.phtml";
        }else{
            echo "Erro 404: Page not found!";
        }
    }

    public static function getValidator()
    {
        $translationDir = __DIR__ . "/resource/lang";
        $filesystem = new Filesystem();
        $fileLoader = new FileLoader($filesystem, $translationDir);
        $fileLoader->addNamespace('lang', $translationDir);
        $fileLoader->load('pt_BR', 'validation', 'lang');
        $translator = new Translator($fileLoader, 'pt_BR');
        $factory = new Factory($translator);
        $databaseManager = BaseModelEloquent::getConnectionResolver();
        $presenceVerifier = new DatabasePresenceVerifier($databaseManager);
        $factory->setPresenceVerifier($presenceVerifier);

        return $factory;
    }

}