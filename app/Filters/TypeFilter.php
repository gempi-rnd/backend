<?php

// TypeFilter.php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TypeFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->where('full_name', $value);
    }
}
