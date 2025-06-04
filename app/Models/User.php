<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'user_type',
        'is_active',
        'session_year_id'
    ];

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
            'password' => 'hashed',
            'is_active'=>'boolean',

        ];
    }
    public function student_details()
    {
        return $this->hasOne(StudentDetail::class, 'user_id');
    }
    public function session()
    {
        return $this->belongsTo(CustomSession::class,'session_year_id');
    }
    public function hasRole($role)
    {
        return $this->user_type === $role;
    }
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
