<?php

namespace App\Models\Clients\Profile;

use App\Models\Admins\Clients\ClientsActivation;
use App\Models\Admins\Clients\ClientsRecurrence;
use App\Models\Admins\Promotions\Promotions;
use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\Country\Municipality;
use App\Models\Clients\CustomerServices\CustomerServices;
use App\Models\Clients\General\Gender;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\CreditCard;
use App\Models\Clients\Pivot\ClientUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function status()        {   return $this->belongsTo(Status::class);             }
    public function gender()        {   return $this->belongsTo(Gender::class);             }    
    public function clientab()      {   return $this->hasOne(AccountBank::class);           }
    public function clientcc()      {   return $this->hasOne(CreditCard::class);            }
    
    public function estate()        {   return $this->belongsTo(Estate::class);             }
    public function city()          {   return $this->belongsTo(City::class);               }
    public function municipality()  {   return $this->belongsTo(Municipality::class);       }

    public function customers()     {   return $this->hasMany(CustomerServices::class);     }
    public function promotion()     {   return $this->belongsTo(Promotions::class);         }
    
    public function recurrences()   {   return $this->hasMany(ClientsRecurrence::class);    }
    public function activations()   {   return $this->hasMany(ClientsActivation::class);    }    



    public static function GetClient($data)
    {
        try {
            $user   =   Client::where($data['field'], $data['id'])->firstOrFail();
            return  $user;

        } catch (\Exception $e) {
                return false;
        }
    }

    public static function UpdClient($data)
    {
        try {
            $client                     =   Client::findOrFail($data['iId']);
            
            $pivot                      =   ClientUser::where('client_id', '=', $data['iId'])->get();
            $user                       =   User::findOrFail($pivot[0]->user_id);

            

            $client->name               =   ( ( isset($data['iName']) )         ?   ucfirst($data['iName'])     : '' );
            $client->birthday           =   ( ( isset($data['iBirthday']) )     ?   $data['iBirthday']              : date("Y-m-d", strtotime( date("Y-m-d")."- 18 year")) );
            $client->gender_id          =   ( ( isset($data['iGender']) )       ?   $data['iGender']                : '1' );
            $client->address            =   ucfirst($data['iAddress']);
            $client->estate_id          =   $data['iState'];
            $client->city_id            =   $data['iTown'];
            $client->municipality_id    =   $data['iMunicipality'];
            $client->latitude           =   ( ( isset($data['iLatitud']) )      ?   $data['iLatitud']               : '00.000000' );
            $client->longitude          =   ( ( isset($data['iLongitud']) )     ?   $data['iLongitud']              : '-00.000000' );
            $client->phone_principal    =   ( ( isset($data['iPhone']) )        ?   intval(preg_replace('/[^0-9]+/', '', $data['iPhone']), 10)                 : '' );
            $client->phone_alternative  =   ( ( isset($data['iPhoneAlt']) )     ?   intval(preg_replace('/[^0-9]+/', '', $data['iPhoneAlt']), 10)              : '' );
            $client->email_principal    =   ( ( isset($data['iEmail']) )        ?   strtolower($data['iEmail'])     : '' );
            $client->email_alternative  =   ( ( isset($data['iEmailAlt']) )     ?   strtolower($data['iEmailAlt'])  : '' );
            $client->instagram          =   ( ( isset($data['iInstagram']) )    ?   strtolower($data['iInstagram']) : '' );
            $client->facebook           =   ( ( isset($data['iFacebook']) )     ?   strtolower($data['iFacebook'])  : '' );
            $client->twitter            =   ( ( isset($data['iTwitter']) )      ?   strtolower($data['iTwitter'])   : '' );
            $client->youtube            =   ( ( isset($data['iYoutube']) )      ?   strtolower($data['iYoutube'])   : '' );
            $client->advertising        =   ( ( isset($data['iYoutube']) )      ?   strtoupper($data['iAdvs'])      : 'NO' );
            $client->save();
            
            $user->name                 =   ( ( isset($data['iName']) )         ?   strtoupper($data['iName'])      : '' );
            $user->email                =   ( ( isset($data['iEmail']) )        ?   strtolower($data['iEmail'])     : '' );
            $user->save();

        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
