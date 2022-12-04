<?php

// StudentFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class StudentFilter extends AbstractFilter
{
    protected $filters = [
        'full_name' => TypeFilter::class
    ];
}
