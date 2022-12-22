<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Voucher\VoucherImage;
use Illuminate\Database\Seeder;

class VoucherImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]    =   ['name'     =>  'voucher.png', 'src' => '/src/images/voucher/', 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New VoucherImage();
            $new->name      =   $da['name'];
            $new->src       =   $da['src'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
