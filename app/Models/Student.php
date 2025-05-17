<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo

class Student extends Model
{
    use HasFactory; // Enable factory usage for this model

    /**
     * The table associated with the model.
     *
     * Note: Eloquent automatically assumes 'teachers' based on the class name 'Teacher'.
     * This property is only needed if your table name doesn't follow convention.
     *
     * @var string
     */
    // protected $table = 'teachers';

    /**
     * The attributes that are mass assignable.
     *
     * These correspond to the columns you defined in your migration,
     * excluding the primary key ('id') and timestamps ('created_at', 'updated_at')
     * which are typically handled automatically.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Useful if you want to hide certain fields when converting to JSON/array.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     // Example: 'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     * Useful for ensuring data types (e.g., dates, booleans, arrays).
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     // Example: 'email_verified_at' => 'datetime',
    // ];

    /**
     * Get the user that owns the teacher profile.
     * Defines the inverse of a HasOne relationship (a Teacher belongs to a User).
     */
    public function user(): BelongsTo
    {
        // Assumes the foreign key in 'teachers' table is 'user_id'
        // and the local key in 'users' table is 'id'.
        return $this->belongsTo(User::class);
    }

    // You can add other relationships here if needed, for example:
    // public function lessons() {
    //     return $this->hasMany(Lesson::class); // If a teacher has many lessons directly
    // }
    // public function appointments() {
    //     return $this->hasMany(Appointment::class); // If a teacher has many appointments directly
    // }
}