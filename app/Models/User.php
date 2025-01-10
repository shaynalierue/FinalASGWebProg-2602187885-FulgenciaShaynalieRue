<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'password' => 'hashed'
        ];
    }

    public function friends() : HasMany
    {
        return $this->hasmany(Friend::class);
    }

    public function avatar_transaction() : BelongsToMany
    {
        return $this->belongsToMany(Avatar::class, 'avatar_transactions', 'buyer_id')->withTimestamps();
    }

    public function chat() : HasMany
    {
        return $this->hasMany(Chat::class);
    }

    // Relasi ke tabel pivot user_field_of_works
    public function fieldsOfWork()
    {
        return $this->belongsToMany(FieldOfWork::class, 'user_field_of_works');
    }
     
    
}
