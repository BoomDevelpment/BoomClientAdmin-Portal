<?php

namespace App\Models;

use App\Models\Clients\General\Profile;
use App\Models\Clients\General\Status;
use App\Models\Clients\Pivot\ClientUser;
use App\Models\Clients\Pivot\OperatorUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWalletFloat;
use Bavix\Wallet\Interfaces\WalletFloat;

use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements Wallet, WalletFloat
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet,  HasWallets, HasWalletFloat;

    public function status()    {   return $this->belongsTo(Status::class);                     }
    public function client()    {   return $this->hasOne(ClientUser::class,     'user_id');     }
    public function operator()  {   return $this->hasOne(OperatorUser::class,   'user_id');     }
    public function profile()   {   return $this->belongsTo(Profile::class);                    }

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
    ];
}
