<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
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
        'name',
        'email',
        'password',
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

    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id');
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birth'])->age;
    }
    public function classification($age)
    {
        switch (true) {
            case ($age >= 0 && $age <= 1):
                return 'Bayi';
            case ($age > 1 && $age <= 3):
                return 'Balita';
            case ($age > 3 && $age <= 12):
                return 'Anak-anak';
            case ($age > 12 && $age <= 18):
                return 'Remaja';
            case ($age > 18 && $age <= 60):
                return 'Dewasa';
            case ($age > 60):
                return 'Lansia';
            default:
                return 'Umur tidak valid';
        }
    }
}
