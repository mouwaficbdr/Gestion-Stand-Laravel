<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modèle User
 *
 * Ce modèle représente un utilisateur de l'application. Il gère les informations
 * d'identification, le rôle, et les relations avec les stands.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',                // Nom de l'utilisateur
        'nom_entreprise',     // Nom de l'entreprise
        'email',              // Adresse email
        'password',           // Mot de passe (haché)
        'role',               // Rôle de l'utilisateur (admin, entrepreneur, etc.)
    ];

    /**
     * Les attributs à cacher lors de la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',           // Masquer le mot de passe
        'remember_token',     // Masquer le token de session
    ];

    /**
     * Les attributs à caster automatiquement.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Date de vérification de l'email
            'password' => 'hashed',            // Mot de passe haché
        ];
    }

    /**
     * Relation : Un utilisateur possède un stand.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stand()
    {
        return $this->hasOne(Stand::class, 'utilisateur_id');
    }

    /**
     * Vérifie si l'utilisateur est administrateur.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un entrepreneur approuvé.
     *
     * @return bool
     */
    public function isApprovedEntrepreneur()
    {
        return $this->role === 'entrepreneur_approuve';
    }

    /**
     * Vérifie si l'utilisateur est en attente d'approbation.
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->role === 'entrepreneur_en_attente';
    }
}
