<?php

namespace App\Models\Clients\Paypal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalOrder extends Model
{
    use HasFactory;

    public static function DataInsert($data)
    {

        try {
            $new                =   new PaypalOrder();
            $new->identified    =   $data['identified'];
            $new->client_id     =   $data['client_id'];
            $new->invoice_id    =   $data['invoice_id'];
            $new->order_id      =   $data['orderID'];
            $new->currency      =   $data['currency'];
            $new->amount        =   $data['amount'];
            $new->tax           =   $data['tax'];
            $new->total         =   $data['total'];
            $new->link          =   $data['link'];
            
            return  ( $new->save() ) ? true : false;

        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public static function DataUpdate($data)
    {
        try {
            $up     =   PaypalOrder::where('order_id', '=', $data['orderID'])->first();
            $up->status         =   $data['status'];
            $up->paypal_client  =   $data['paypal_client'];
            $up->paypal_email   =   $data['paypal_email'];
            $up->gross_amount   =   $data['gross_amount'];
            $up->paypal_fee     =   $data['paypal_fee'];
            $up->net_amount     =   $data['net_amount'];
            $up->transaction_id =   $data['transactionID'];

            return  ( $up->save() ) ? true : false;

        } catch (\Exception $e) {
            return false;
        }

    }

    public static function DataGet($data)
    {
        try {
            $getInfo     =   PaypalOrder::where('order_id', '=', $data)->first();
            return  $getInfo;

        } catch (\Exception $e) {
            return false;
        }
    }
}
