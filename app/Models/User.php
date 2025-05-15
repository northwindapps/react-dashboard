<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Teacher;
use App\Models\Student;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

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

    public function teacher(): HasOne
    {
        // Laravel assumes the foreign key is user_id (model name + _id)
        // and the local key is 'id'. You can specify them if different:
        // return $this->hasOne(Teacher::class, 'foreign_key_on_teachers', 'local_key_on_users');
        return $this->hasOne(Teacher::class);
    }

    public function student(): HasOne
    {
        // Laravel assumes the foreign key is user_id (model name + _id)
        // and the local key is 'id'. You can specify them if different:
        // return $this->hasOne(Teacher::class, 'foreign_key_on_teachers', 'local_key_on_users');
        return $this->hasOne(Student::class);
    }
}
