<?php

namespace Database\Seeders;

use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Image;

class TransferenceZelleSeeder extends Seeder
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

        $iData   =   [
            'identified'    =>  $identified,
            'client_id'     =>  1,
            'subject'       =>  'TRANSFERENCE ZELLE TEST',
            'title'         =>  'TRANSFERENCE ZELLE TEST',
            'date_trans'    =>  '2022-01-01',
            'reference'     =>  strtoupper(Str::random(17)),
            'total'         =>  ROUND(1,2),
            'bs'            =>  ROUND( (1 * $divisa->dolar) ,2),
            'description'   =>  'TRANSFERENCE ZELLE TEST',
            'type'          =>  TransferenceType::where('name', 'LIKE', '%dol%')->first()->id,
            'status'        =>  $status->id,
        ];

        $reg    =   TransferenceZelle::RegisteTrans($iData);

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
                'method'        =>  TransferenceMethod::where('name', 'like', '%zel%')->first()->id
            ];
    
            $pen        =   TransferencePending::RegisteTrans($iPend);

            $trans      =   TransferencePending::where('identified', '=', $identified)->first()->transaction;

            $iPend      =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $trans], ['confirmed', 0]])->first();

            if($myWallet->confirm($iPend) == true)
            {
                $report             =   TransferenceZelle::where('identified', '=', $identified)->first();
        
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
            $img->save(base_path('public/files/zelle/'.$fileName.''));

            $data   =   [
                'identified'    =>  $identified,
                'name'          =>  $fileName,
                'dir'           =>  'files/zelle'
            ];

            $rTransference  =   TransferenceFile::RegFile($data);

        }
    }
}
