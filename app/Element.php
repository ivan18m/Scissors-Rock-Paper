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

    /**
     * @var string
     */
    public function weaknesses()
    {
        return $this->belongsToMany(\App\Element::class,  'element_strength', 'strength_id', 'element_id');
    }
}
