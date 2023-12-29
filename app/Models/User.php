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
        'superadmin' => 'boolean',
        'permissions' => 'array',
    ];
    
    // Example method to check if user has access to a Nova resource
    public function hasAccessToNovaResource($resource)
    {
        if ($this->superadmin) {
            return true;
        }

        // 'Orders' is accessible by default if no specific permissions are set
        $defaultResources = ['Orders'];

        // Get the list of resources the user has access to
        $accessibleResources = $this->permissions ?? $defaultResources;

        return in_array($resource, $accessibleResources);
    }
    
    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = json_encode(array_keys(array_filter($value)));
    }
}
