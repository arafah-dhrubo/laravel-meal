<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
        public $table = "meals";
    public  function plan(){
        return $this->belongsTo(Plan::class);
    }
}
