<?php 

namespace App\Helpers;

use App\Models\General\Status;
use App\Models\Paypal\Paypal;
use GuzzleHttp\Client as GuzzleClient;

class PaypalClient
{
    private     $client;
    private     $accessToken;
    
    public function __construct()
    {
        $credentials    =   Paypal::WHERE('status_id', 'like', '%'. Status::WHERE('name', 'LIKE', '%act%')->get()[0]->id .'%')->get();

        if(COUNT($credentials) > 0)
        {
            if( $credentials[0]->mode == 'live' )
            {
                $baseUri    =   'https://api-m-paypal.com';
            }else{
                $baseUri    =   'https://api-m.sandbox.paypal.com';
            }
            $clientId       =   $credentials[0]->client;
            $secret         =   $credentials[0]->secret;

        }else{

            if(config('paypal')['credentials']['settings']['mode'] === 'live')
            {
                $clientId   =   config('paypal')['credentials']['live_client'];
                $secret     =   config('paypal')['credentials']['live_secret'];
                $baseUri    =   'https://api-m-paypal.com';
            }else{
                $clientId   =   config('paypal')['credentials']['sandbox_client'];
                $secret     =   config('paypal')['credentials']['sandbox_secret'];
                $baseUri    =   'https://api-m.sandbox.paypal.com';
            }
        }

        try {
            $this->client       =   new GuzzleClient(['verify' => false,'base_uri' => $baseUri]);
            $this->accessToken  =   $this->getAccessToken($clientId, $secret);


        } catch (\Exception $e) {   $this->accessToken  =   false;  $this->client = false;    }
    }

    private function getAccessToken($clientId, $secret)
    {
        try {
            $response   =   $this->client->request('POST', '/v1/oauth2/token', [
                'header'    =>  [
                    'Accept'        =>  'application/json',
                    'Content-Type'  =>  'application/x-www-form-urlencoded',
                ],
                'body'  =>  'grant_type=client_credentials',
                'auth'  =>  [
                    $clientId, 
                    $secret, 
                    'basic'
                ]
            ]);
          
            $data   =   json_decode($response->getBody(), true);

            return  $data['access_token'];

        } catch (\Exception $e)  { return false; }
    }

    private function getHeaders()
    {
        return  [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type'  => 'application/json'
        ];
    }

    public function CreateOrder($iData)
    {
        $response = $this->client->request('POST', '/v2/checkout/orders', [
                'headers'   =>  $this->getHeaders(),
                'body'      =>  $this->OrderBody($iData)
            ],
        );

        $result     =   json_decode($response->getBody(), true);
        
        foreach ($result['links'] as $r => $res) {   if($res['rel'] == "approve")  { $link   =   $res['href'];   }   }

        $iResult    =   [
            'orderID'   =>  $result['id'],
            'status'    =>  $result['status'],
            'link'      =>  $link
        ];
        
        return $iResult;
    }

    private function OrderBody($iData)
    {
        return json_encode([
            "intent"            =>  "CAPTURE",
            "purchase_units"    =>  [
                [
                    "amount"    =>  [
                        "currency_code" =>  "USD",
                        "value" =>  $iData["amount"]
                    ],
                ],
            ],
            "application_context"   =>  [
                "brand_name"    =>  "BoomSolutions - Venezuela",
                "landing_page"  =>  "NO_PREFERENCE",
                "user_action"   =>  "PAY_NOW",
                "return_url"    =>  $iData["http"]."://".$iData["host"]."/paypal/process",
                "cancel_url"    =>  $iData["http"]."://".$iData["host"]."/paypal/cancel"                
            ]
        ]);
    }
}
