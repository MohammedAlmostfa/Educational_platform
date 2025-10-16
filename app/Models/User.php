<?php

namespace App\Models;


use App\Models\Certificate;
use App\Traits\HasCustomMedia;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * Represents an authenticated user of the application.
 *
 * @property int $id Unique identifier for the user.
 * @property string $name Full name of the user.
 * @property string $email Email address of the user.
 * @property string $password Hashed password for authentication.
 * @property \Illuminate\Support\Carbon|null $email_verified_at Timestamp of email verification.
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasCustomMedia, HasRoles;

    /**
     * Guard name for JWT Authentication (typically 'api').
     *
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * Allows mass assignment of specific fields when creating or updating a user.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden in JSON responses.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to specific data types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Automatically hashes password upon setting
    ];

    /**
     * Get the identifier to be stored in the JWT token.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Typically the primary key (ID)
    }

    /**
     * Return a key-value array containing any custom claims to be added to JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * One-to-one relationship: User has one Profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    /**
     * Polymorphic one-to-many relationship for user photos.
     *
     * This allows a User to have multiple photos while enabling other models to use the same relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('status')
            ->withTimestamps();
    }
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
