<?php

namespace Core;

use Illuminate\Validation\Factory;

class Validator
{
    private static $factory;

    private static function getFactory(): Factory
    {
        if (empty(self::$factory) && !self::$factory instanceof Factory) {
            self::$factory = Container::getValidator();
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