<?php

namespace App\Models;
use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['nom', 'adresse', 'phone', 'email', 'date_de_naissance', 'ville_id'];

    use HasFactory;
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
}
