<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function categorymedia() {
    	return $this->belongsTo('App\Categorymedia', 'codecategorymedia');
    }
}
