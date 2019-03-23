<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    public $timestamps = false;
    
    /**
     * @var string
     */
    protected $table = 'element';
    
    public function strengths()
    {
        return $this->belongsToMany(\App\Element::class,  'element_strength', 'element_id', 'strength_id');
    }
}
