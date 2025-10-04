<?php

namespace App\Trait;

use App\Models\User;

trait ModelHelpers
{
    public function matches(self $model)
    {
        return $this->id === $model->id;
    }
}
