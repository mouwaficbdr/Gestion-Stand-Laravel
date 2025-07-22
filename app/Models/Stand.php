<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Stand
 * 
 * Ce modèle représente un stand dans l'application. Il contient les informations principales
 * d'un stand et la relation avec l'utilisateur propriétaire.
 */
class Stand extends Model
{
    use HasFactory;

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_stand',      // Nom du stand
        'description',    // Description du stand
        'utilisateur_id', // Référence à l'utilisateur propriétaire
    ];

    /**
     * Relation : Un stand appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}
