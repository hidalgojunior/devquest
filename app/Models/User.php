<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassGroup;
use App\Models\Presence;
use App\Models\Submission;
use App\Models\Occurrence;

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
        'name',
        'email',
        'password',
        'rm',
        'role',
        'cpf',
        'phone',
        'birthdate',
        'github_username',
        'class_group_id',
        'password_locked',
        'locale',
        'timezone',
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
            'birthdate' => 'date',
            'password_locked' => 'boolean',
        ];
    }

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    // chat relationships
    public function sentMessages()
    {
        return $this->hasMany(Message::class,'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class,'receiver_id');
    }

    /**
     * Set the password attribute, ignoring changes if locked.
     */
    public function setPasswordAttribute($value)
    {
        if ($this->exists && $this->password_locked) {
            // do not change existing password
            return;
        }

        $this->attributes['password'] = Hash::make($value);
        $this->attributes['password_locked'] = true;
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function occurrences()
    {
        return $this->hasMany(Occurrence::class);
    }

    /**
     * Convenience helpers for checking user role.
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
}
