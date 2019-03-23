<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ElementStrength extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    
    /**
     * @var string
     */
    protected $table = 'element_strength';

}
