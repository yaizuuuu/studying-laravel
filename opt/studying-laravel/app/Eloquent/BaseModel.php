<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Mockery;
use ReflectionClass;

class BaseModel extends Model
{
    public $errors;
    public static $rules = [];

    public function validate()
    {
        $validator = Validator::make($this->attributes, static::$rules);

        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->messages();

        return false;
    }

    public static function shouldReceive()
    {
        $class_name = get_called_class();
        $reflection_class = new ReflectionClass($class_name);
        $pure_class_name = $reflection_class->getShortName();

        $repository_interface_name = "App\\Repositories\\{$pure_class_name}\\{$pure_class_name}RepositoryInterface";
        $repository_class_name = "App\\Repositories\\{$pure_class_name}\\Eloquent{$pure_class_name}Repository";

        $mock = Mockery::mock($repository_interface_name, $repository_class_name);

        app()->instance($repository_interface_name, $mock);

        return call_user_func_array(
            [$mock, 'shouldReceive'],
            func_get_args()
        );
    }
}
