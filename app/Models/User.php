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
        'name',
        'email',
        'password',
        'avatar',
        'role',
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
        ];
    }

    // =========================================================================
    // មុខងារបន្ថែមសម្រាប់ឆែកសិទ្ធិ (Role & Permissions) របស់ PHIROM MANAGER
    // =========================================================================

    // ឆែកមើលថាជា ម្ចាស់ប្រព័ន្ធ (Owner) ឬអត់
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    // ឆែកមើលថាជា អ្នកគ្រប់គ្រង (Manager) ឬអត់
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    // ឆែកមើលតួនាទីទូទៅ
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // មុខងារចម្បងសម្រាប់ឆែកមើលសិទ្ធិឌីណាមិកតាមរយៈ Setting Table
    public function canPerform(string $action): bool
    {
        // ប្រសិនបើជា Admin ឬ Owner គឺអាចធ្វើអ្វីបានទាំងអស់ជានិច្ច ១០០%
        if (in_array($this->role, ['admin', 'owner'])) {
            return true;
        }

        // ប្រសិនបើតួនាទីក្នុង DB គឺ 'student' យើងបម្លែងជា 'client' ដើម្បីឱ្យត្រូវនឹងតារាង settings
        $roleKey = ($this->role === 'student') ? 'client' : $this->role;

        return \App\Models\Setting::check("perm_{$roleKey}_{$action}");
    }
}