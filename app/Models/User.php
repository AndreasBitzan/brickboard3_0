<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Pktharindu\NovaPermissions\Role;
use Pktharindu\NovaPermissions\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->roles()->where('slug', 'superadmin')->exists();
    }

    public function isModerator(): bool
    {
        return $this->roles()->where('slug', 'moderator')->exists();
    }

    public function isAdmin(): bool
    {
        return $this->roles()->where('slug', 'admin')->exists();
    }

    public function followed_topics()
    {
        return $this->belongsToMany(Topic::class, 'user_topic_follows');
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            $standardRole = Role::where('slug', 'regular')->first();
            if ($standardRole) {
                $user->sync([$standardRole->id]);
            }
        });
    }
}
