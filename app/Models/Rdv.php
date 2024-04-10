<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    protected $table = 'rdv';
    protected $fillable = ['Nom', 'email', 'Message'];
}

