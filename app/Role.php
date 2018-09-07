<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';
     //User Relation
     public function users()
     {
       return $this->belongsToMany(User::class);
     }

    }
