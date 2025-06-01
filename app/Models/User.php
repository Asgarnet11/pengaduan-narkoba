<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nik',
        'telp',
        'foto'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'admin_id');
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMasyarakat()
    {
        return $this->role === 'masyarakat';
    }

    // Profile photo helper
    public function getProfilePhotoUrl()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        // Generate initials avatar if no photo
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=256&bold=true&color=7F9CF5&background=EBF4FF';
    }
}
