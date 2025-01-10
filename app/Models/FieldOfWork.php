<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldOfWork extends Model
{
    // Relasi ke tabel pivot user_field_of_works
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_field_of_works');
    }
}
