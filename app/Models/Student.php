<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
   

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

public function coach()
{
    return $this->belongsTo(Student::class, 'coach_id');
}

public function assignedStudents()
{
    return $this->hasMany(Student::class, 'coach_id');
}
// Student.php model
public function assignedUsers()
{
    return $this->hasMany(Student::class, 'coach_id');
}


}
