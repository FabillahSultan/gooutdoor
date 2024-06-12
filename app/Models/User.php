<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'alamat', // Pindahkan kolom alamat ke $fillable
        'foto',   // Pindahkan kolom foto ke $fillable
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Interact with the user's type.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function getTypeAttribute($value): string
    {
        return ["user", "admin", "manager"][$value];
    }

    // Method untuk menentukan apakah pengguna adalah admin
    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    // Method untuk menentukan apakah pengguna adalah moderator
    public function isModerator(): bool
    {
        return $this->type === 'manager';
    }

    // Method untuk menentukan apakah pengguna adalah pengguna biasa
    public function isUser(): bool
    {
        return $this->type === 'user';
    }
}
