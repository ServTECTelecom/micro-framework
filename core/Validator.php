<?php

namespace Core;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Traits\CapsuleManagerTrait;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Validation\Factory;

class Validator
{
    private static $factory;

    private static function getFactory(): Factory
    {
        if (empty(self::$factory) && !self::$factory instanceof Factory) {
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

            self::$factory = $factory;
        }


        return self::$factory;
    }

    public static function make(array $data, array $rules)
    {
        $factory = self::getFactory();
        $validator = $factory->make($data, $rules);

        $errors = $validator->errors()->toArray();

        if ($errors) {
            Session::set('errors', $errors);
            Session::set('inputs', $data);
            return true;
        } else {
            Session::destroy(['errors', 'inputs']);
            return false;
        }
    }
}