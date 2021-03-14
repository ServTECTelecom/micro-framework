<?php

namespace Core;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

require_once __DIR__ . "/bootstrap_eloquent.php";

abstract class BaseModelEloquent extends Model
{
    protected function beforeInsert(){}

    protected function afterInsert(){}

    protected function beforeUpdate(){}

    protected function afterUpdate(){}

    protected function beforeDelete(){}

    protected function afterDelete(){}

    protected function performInsert(Builder $query)
    {
        $this->beforeInsert();
        $return = parent::performInsert($query);
        $this->afterInsert();
        return $return;
    }

    protected function performUpdate(Builder $query)
    {
        $this->beforeUpdate();
        $return = parent::performUpdate($query);
        $this->afterUpdate();
        return $return;
    }

    protected function performDeleteOnModel()
    {
        $this->beforeDelete();
        $return = parent::performDeleteOnModel();
        $this->afterDelete();
        return $return;
    }


}