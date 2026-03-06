<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = ['nom_entreprise', 'email', 'telephone', 'logo'];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    
}