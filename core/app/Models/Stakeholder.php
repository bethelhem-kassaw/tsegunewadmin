<?php

namespace App\Models;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class Stakeholder extends Authenticatable implements HasName
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'photo_path',
        'password',
        'company_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function canAccessFilament(): bool
    // {
    //     dd(false);
    //     return true;
    // }
    public function canAccessPanel(): bool
    {

        return $this->hasRole('super-admin');
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'stakeholder_role');
    }
    public function hasRole($role)
    {
        if($this->roles()->where('slug', $role)->first()){
            return true;
        }
        return false;
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'stakeholder_permission');
    }
    public function hasPermission($name)
    {
        $permission = Permission::where('slug', $name)->first();
        if($permission){

            $found = \DB::table('stakeholder_permission')->where('permission_id', $permission->id)->andWhere('stakeholder_id', auth()->user()->id)->first();
            if($found){
                return true;
            }
        }
        return false;
    }
    public function hasRoles($roles)
    {
        if($this->roles()->whereIn('slug', $roles)->first()){
            return true;
        }
        return false;
    }
    public function sendPasswordResetNotification($token)
    {
        $url = env('APP_URL').'/admin/password/reset/'.$token.'?email='.$this->email;
        $this->notify(new ResetPasswordNotification($url, $token));
    }
    public function worksFor()
    {
        return $this->belongsTo(SellProvider::class, 'company_id');
    }
}
