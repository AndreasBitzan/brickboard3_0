<?php

namespace App\Models;

use App\Http\Enums\ModerationStateEnum;
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
        'main_badge_id',
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

    public function isAdminTeam(): bool
    {
        return $this->isAdmin() || $this->isSuperAdmin() || $this->isModerator();
    }

    public function followed_topics()
    {
        return $this->belongsToMany(Topic::class, 'user_topic_follows');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    public function main_badge()
    {
        return $this->belongsTo(Badge::class, 'main_badge_id');
    }

    public function user_details()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function moderation_state()
    {
        return $this->belongsTo(ModerationState::class);
    }

    public function read_topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_user_read_states')->withPivot('messageboard_id', 'unread_posts_count', 'read_posts_count');
    }

    public function movies()
    {
        return $this->belongsToMany(Topic::class, 'movie_authors')->withPivot('movie_role_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function reacted_topics()
    {
        return $this->belongsToMany(Topic::class, 'reaction_topic')->withTimestamps();
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            $standardRole = Role::where('slug', 'regular')->first();
            if ($standardRole) {
                $user->roles()->sync([$standardRole->id]);
            }

            UserDetail::create(['user_id' => $user->id, 'latest_activity_at' => now(), 'last_seen_at' => now()]);
        });

        static::updated(function (User $user) {
            if (isset($user->getChanges()['moderation_state_id']) && $user->moderation_state_id == ModerationStateEnum::APPROVED->value) {
                // Has to be done like this unfortunately to make sure it triggers updated event for Topic and Post to count up correctly on posts and topicscount
                $topicsToUpdate = Topic::where('user_id', $user->id)->where('moderation_state_id', '!=', ModerationStateEnum::APPROVED->value)->get();

                foreach ($topicsToUpdate as $topic) {
                    $topic->moderation_state_id = ModerationStateEnum::APPROVED->value;
                    $topic->save();
                }

                $postsToUpdate = Post::where('user_id', $user->id)->where('moderation_state_id', '!=', ModerationStateEnum::APPROVED->value)->get();

                foreach ($postsToUpdate as $post) {
                    $post->moderation_state_id = ModerationStateEnum::APPROVED->value;
                    $post->save();
                }
            }
        });
    }
}
