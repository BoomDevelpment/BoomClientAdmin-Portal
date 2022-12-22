<?php

namespace Database\Seeders;

use App\Models\Clients\General\Bank;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferenceMovil;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use Image;

class TransferenceMovilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user       =   User::find(1);

        $myWallet   =   $user->getWallet($user->identified);

        $identified =   random_int(10000000, 99999999);

        $divisa     =   Scrapers::getLast();

        $status     =   TransferenceStatus::where([ ['status_id', '=', 1], ['name', 'like', '%pen%'] ])->first();
        $type       =   TransferenceType::where([ ['status_id', '=', 1], ['name', 'like', '%bol%'] ])->first();
        $bank       =   Bank::where('name', 'LIKE', '%banplu%')->first();

        $iData  =   [
            'identified'    =>  $identified,
            'client_id'     =>  1,
            'subject'       =>  'TRANSFERENCE TEST',
            'title'         =>  'TRANSFERENCE TEST',
            'date_trans'    =>  '2022-01-01',
            'dni'           =>  '123456789',
            'phone'         =>  '584241234567',
            'reference'     =>  strtoupper(Str::random(17)),
            'total'         =>  round( ( $divisa->dolar / $divisa->dolar), 2),
            'bs'            =>  round($divisa->dolar,2),
            'description'   =>  'TRANSFERENCE TEST',
            'bank'          =>   $bank->id,
            'type'          =>   $type->id,
            'status'        =>   $status->id,
        ];

        $reg    =   TransferenceMovil::RegisteTrans($iData);

        if($reg)
        {
            $transaction    =   $myWallet->depositFloat($iData['total'], 
            [
                'Description'   =>  $iData['description'],
                'USD'           =>  $iData['total'],
                'BS'            =>  $iData['bs'],
                'DIVISA'        =>  $divisa->dolar,
            ], false);
        
            $iPend   =   [
                'identified'    =>  $identified,
                'client'        =>  $user->client->client_id,
                'transaction'   =>  $transaction->id,
                'status'        =>  $status->id,
                'method'        =>  TransferenceMethod::where('name', 'like', '%movil%')->first()->id
            ];
    
            $pen        =   TransferencePending::RegisteTrans($iPend);

            $trans      =   TransferencePending::where('identified', '=', $identified)->first()->transaction;

            $iPend      =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $trans], ['confirmed', 0]])->first();

            if($myWallet->confirm($iPend) == true)
            {
                $report             =   TransferenceMovil::where('identified', '=', $identified)->first();
        
                $report->status_id  =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                $report->save();
    
                $pending            =   TransferencePending::where('identified', '=', $identified)->first();
                $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                $pending->save();
    
            }

            $fileName   =   $user->client->client_id.'-'.$identified.'.jpg';

            $img        =   Image::make(public_path('\src\images\supPaypal.png')); 
    
            $img->text('$ '.$iData['total'].'', 510, 112.5, function($font) {  
                $font->size(12);  $font->file(public_path('src\images\fonts\Montserrat-Italic.ttf')); $font->color('#00000');  $font->align('center');  $font->valign('bottom');    
            });
            $img->text($user->name, 300, 170, function($font) {  
                $font->size(12);  $font->file(public_path('src\images\fonts\Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
            });
            $img->text('test@boomsolutions.com', 300, 195, function($font) {  
                $font->size(12);  $font->file(public_path('src\images\fonts\Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
            });   
            $img->text('$ '.$iData['total'].'', 250, 257, function($font) {  
                $font->size(20);  $font->file(public_path('src\images\fonts\Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
            });   
            $img->text('$ 0.00', 230, 307, function($font) {  
                $font->size(20);  $font->file(public_path('src\images\fonts\Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
            });
            $img->text('$ '.$iData['total'].'', 240, 364, function($font) {  
                $font->size(20);  $font->file(public_path('src\images\fonts\Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
            });
            $img->save(base_path('public/files/movil/'.$fileName.''));

            $data   =   [
                'identified'    =>  $identified,
                'name'          =>  $fileName,
                'dir'           =>  'files/movil'
            ];

            $rTransference  =   TransferenceFile::RegFile($data);
        }
    }
}
