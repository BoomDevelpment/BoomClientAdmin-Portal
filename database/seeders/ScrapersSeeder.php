<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\Scrapers;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpClient\HttpClient;

use Goutte\Client;

class ScrapersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url        =   'http://www.bcv.org.ve/';


        $client     =   new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
        $crawler    =   $client->request('GET', $url);

        $euro       =   $crawler->filter('#euro')->each(function ($node){ return    $node->text(); });
        $yuan       =   $crawler->filter('#yuan')->each(function ($node){ return    $node->text(); });
        $lira       =   $crawler->filter('#lira')->each(function ($node){ return    $node->text(); });
        $rublo      =   $crawler->filter('#rublo')->each(function ($node){ return    $node->text(); });
        $dolar      =   $crawler->filter('#dolar')->each(function ($node){ return    $node->text(); });    
                
        $Goutte     =   $client->request('GET', 'https://monitordolarvenezuela.com/');
        $filter     =   $Goutte->filter('#Costo')->each(function ($node){ return    $node->text(); });
        $paralelo   =   ( empty($filter) == true ) ? "0.00" : trim(substr( str_replace(',','.',substr($filter[0],'0',  strlen($filter[0]))),   0, -3));

        $data  =   [
            'euro'      =>  substr( str_replace(',','.',substr($euro[0],'4',  strlen($euro[0]))),   0, -6),
            'yuan'      =>  substr( str_replace(',','.',substr($yuan[0],'4',  strlen($yuan[0]))),   0, -6),
            'lira'      =>  substr( str_replace(',','.',substr($lira[0],'4',  strlen($lira[0]))),   0, -6),
            'rublo'     =>  substr( str_replace(',','.',substr($rublo[0],'4', strlen($rublo[0]))),  0, -6),
            'dolar'     =>  substr( str_replace(',','.',substr($dolar[0],'4', strlen($dolar[0]))),  0, -6),
            'paralelo'  =>  $paralelo
        ];

        $new    =   new Scrapers();
        $new->euro      =   $data['euro'];
        $new->yuan      =   $data['yuan'];
        $new->lira      =   $data['lira'];
        $new->rublo     =   $data['rublo'];
        $new->dolar     =   $data['dolar'];
        $new->paralelo  =   $data['paralelo'];
        $new->status_id =   Status::where('name', 'like', '%act%')->first()->id;;

        try {

            $new->save();

        } catch (\Exception $e) {

            dd($e->getMessage());
            var_dump($e->getMessage());
        }
    }
}
