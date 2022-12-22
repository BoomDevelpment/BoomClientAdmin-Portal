<?php

namespace App\Models\Clients\General;

use App\Models\Clients\Country\Estados;
use App\Models\Clients\Donative\DonativeImage;
use App\Models\Clients\Donative\DonativeVideo;
use App\Models\Clients\Invoices\InvoicesStatus;
use App\Models\Clients\Invoices\InvoicesType;
use App\Models\Clients\Payments\AccountBank;
use App\Models\Clients\Payments\AccountBankEntity;
use App\Models\Clients\Payments\AccountBankType;
use App\Models\Clients\Payments\CreditCard;
use App\Models\Clients\Payments\CreditCardEntity;
use App\Models\Clients\Payments\CreditCardType;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Paypal\Paypal;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function bank()      {   return $this->hasOne(Bank::class);                  }
    public function gender()    {   return $this->hasOne(Gender::class);                }
    public function profile()   {   return $this->hasOne(Profile::class);               }
    public function role()      {   return $this->hasOne(Role::class);                  }
    public function user()      {   return $this->hasOne(User::class);                  }
    
    public function client()    {   return $this->hasOne(Client::class);                }
    public function operator()  {   return $this->hasOne(Operator::class);              }
    
    public function scraper()   {   return $this->hasOne(Scrapers::class);              }
    
    public function abentitie() {   return $this->hasOne(AccountBankEntity::class);     }
    public function abtype()    {   return $this->hasOne(AccountBankType::class);       }
    public function ab()        {   return $this->hasOne(AccountBank::class);           }

    public function ccentitie() {   return $this->hasOne(CreditCardEntity::class);      }
    public function cctype()    {   return $this->hasOne(CreditCardType::class);        }
    public function cc()        {   return $this->hasOne(CreditCard::class);            }

    public function transtatus()    {   return $this->hasOne(TransferenceStatus::class);    }
    public function transtype()     {   return $this->hasOne(TransferenceType::class);      }
    public function transmethod()   {   return $this->hasOne(TransferenceMethod::class);    }

    public function invstatus()     {   return $this->hasOne(InvoicesStatus::class);        }
    public function invtype()       {   return $this->hasOne(InvoicesType::class);          }

    public function paypal()        {   return $this->hasOne(Paypal::class);                }

    public function donimage()      {   return $this->hasOne(DonativeImage::class);         }
    public function donvideo()      {   return $this->hasOne(DonativeVideo::class);         }
    
    public function estado()        {   return $this->belongsTo(Estados::class);         }
}
