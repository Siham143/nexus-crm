<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'client_id', 'status', 'budget','deadline'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
