<?php

namespace ucframework;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    public function __construct($attributes)
    {
        if (!isset($this->table) || $this->table == '')
        {
            $classname = get_class($this);
            $classnameinfo = explode('\\', $classname);
            $this->table = strtolower(end($classnameinfo));
        }

        parent::__construct($attributes);
    }

}
