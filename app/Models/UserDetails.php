<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'user_details'; 

    // Fillable attributes for mass assignment
    protected $fillable = [
        'user_id',         // Assuming there is a foreign key relation
        'user_name',
        'last_login_at',
        'last_logout_at',
        // Add any other fields you want to include
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'last_logout_at' => 'datetime',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
