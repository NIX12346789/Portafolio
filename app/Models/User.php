<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'TUsuario';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_usuario';
    public $incrementing = false;
    protected $fillable = [
        'id_usuario',
        'Nombre',
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
        //'password' => 'hashed',
    ];

    public static function generateUserId()
    {
        $lastUser = DB::table('TUsuario')->orderBy('id_usuario', 'desc')->first();
        if (!$lastUser) {
            return 'U001';
        }
        $lastIdNumber = intval(substr($lastUser->id_usuario, 1));
        $newIdNumber = $lastIdNumber + 1;
        return 'U' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
    }
    public function getNameAttribute()
    {
        return $this->Nombre;
    }
}
