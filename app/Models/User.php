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
        'failed_attempts',
        'locked_at',
        'main_badge',
        'sign_in_count',
        'current_sign_in_at',
        'last_sign_in_at',
        'current_sign_in_ip',
        'last_sign_in_ip',
        'slug',
        'activated',
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
        'locket_at' => 'datetime',
        'current_sign_in_at' => 'datetime',
        'last_sign_in_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $with = ['main_badge'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    public function main_badge()
    {
        return $this->belongsTo(Badge::class, 'main_badge');
    }

    public function user_details()
    {
        return $this->hasOne(UserDetail::class);
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
