<?php

namespace App\Console\Commands;

use App\Models\Clients\Payments\Scrapers;
use Illuminate\Console\Command;
use Symfony\Component\HttpClient\HttpClient;

use Goutte\Client as gClient;
use Revolution\Google\Sheets\Facades\Sheets;
use Carbon\Carbon;

class ScrapersBCV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:bcv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CronJob to Scraper the values ​​of the reference rates of the BCV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $url        =   'https://www.bcv.org.ve/';
            $client     =   new gClient(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
            $crawler    =   $client->request('GET', $url);

            $Goutte     =   $client->request('GET', 'https://monitordolarvenezuela.com/');
            $filter     =   $Goutte->filter('#Costo')->each(function ($node){ return    $node->text(); });
            $paralelo   =   ( empty($filter) == true ) ? "0.00" : trim(substr( str_replace(',','.',substr($filter[0],'0',  strlen($filter[0]))),   0, -3));

            $euro       =   $crawler->filter('#euro')->each(function ($node){ return    $node->text(); });
            $yuan       =   $crawler->filter('#yuan')->each(function ($node){ return    $node->text(); });
            $lira       =   $crawler->filter('#lira')->each(function ($node){ return    $node->text(); });
            $rublo      =   $crawler->filter('#rublo')->each(function ($node){ return    $node->text(); });
            $dolar      =   $crawler->filter('#dolar')->each(function ($node){ return    $node->text(); });    
        
            $iData  =   [
                'euro'      =>  substr( str_replace(',','.',substr($euro[0],'4',  strlen($euro[0]))),   0, -6),
                'yuan'      =>  substr( str_replace(',','.',substr($yuan[0],'4',  strlen($yuan[0]))),   0, -6),
                'lira'      =>  substr( str_replace(',','.',substr($lira[0],'4',  strlen($lira[0]))),   0, -6),
                'rublo'     =>  substr( str_replace(',','.',substr($rublo[0],'4', strlen($rublo[0]))),  0, -6),
                'dolar'     =>  substr( str_replace(',','.',substr($dolar[0],'4', strlen($dolar[0]))),  0, -6),
                'paralelo'  =>  $paralelo
            ];

            $get    =   Scrapers::getLast();

            $st     =   0;
            if($get == false)
            {
                $sE     =   1;
                $sY     =   1;
                $sL     =   1;
                $sR     =   1;
                $sD     =   1;
            }else{
                
                $iRes  =   [ 'euro'  =>  $get->euro, 'yuan'  =>  $get->yuan, 'lira'  =>  $get->lira, 'rublo' =>  $get->rublo, 'dolar' =>  $get->dolar];
                
                $sD     =   ($iRes['dolar'] <> $iData['dolar']) ? 1 : 0;
            }

            if($sD == 1)
            {
                $insert     =   Scrapers::insertData($iData);
                
                if($insert <> false)
                {

                    $data   =   Scrapers::getLast();
                    $rows = [
                        [round($data->dolar,2), round($data->euro,2), round($data->yuan,2), round($data->lira,2), round($data->rublo,2), round($data->paralelo,2), date_format($data->created_at,"Y-m-d H:i:s")]
                    ];
            
                    Sheets::spreadsheet(env('SPREADSHEET_BCV'))->sheet('BCV')->range('B4:H4')->append($rows);
                    
                    \Log::info(Carbon::now()->toDateString()." - Scraper - Update values of reference rates BCV - Dolar: ".$iData['dolar']." - Euro: ".$iData['euro']." - Yuan: ".$iData['euro']." - Lira: ".$iData['lira']." - Rublo: ".$iData['rublo']."");
                }else{
                    \Log::info(Carbon::now()->toDateString()." - Scraper - It is not possible to update values of reference rates BCV");
                }
            }
        } catch (\Exception $e) {
            
            \Log::info(Carbon::now()->toDateString()." - Scraper - Error: ".$e->getMessage()."");

        }    
        return 0;
    }
}
