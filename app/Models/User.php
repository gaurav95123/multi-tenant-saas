<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    
    public function companies()
{
    return $this->hasMany(Company::class);
}



public function activeCompanyRelation()
{
    return $this->hasOne(UserActiveCompany::class);
}

public function activeCompany()
{
    return $this->hasOneThrough(
        Company::class,
        UserActiveCompany::class,
        'user_id', // FK on helper table
        'id',      // PK on companies table
        'id',      // PK on users table
        'company_id' // FK on helper table pointing to company
    );
}




}
