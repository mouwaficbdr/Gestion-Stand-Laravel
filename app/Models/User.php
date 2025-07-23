<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'nom_entreprise',
        'email',
        'password',
        'role',
        'motif_rejet',
        'motif_retrait',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation avec le stand
     */
    public function stand()
    {
        return $this->hasOne(Stand::class, 'utilisateur_id');
    }

    /**
     * Relation avec les produits
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Vérifier si l'utilisateur est admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifier si l'utilisateur est entrepreneur approuvé
     */
    public function isApprovedEntrepreneur()
    {
        return $this->role === 'entrepreneur_approuve';
    }

    /**
     * Vérifier si l'utilisateur est en attente
     */
    public function isPending()
    {
        return $this->role === 'entrepreneur_en_attente';
    }
}
