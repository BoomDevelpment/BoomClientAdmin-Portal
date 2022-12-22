<?php

namespace Database\Seeders;

use App\Models\Clients\Pivot\OperatorUser;
use App\Models\Clients\Profile\Operator;
use App\Models\User;
use Illuminate\Database\Seeder;

class OperatorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user       =   User::get();
        $operator   =   Operator::get();

        foreach ($operator as $o => $op) 
        {
            foreach ($user as $u => $us) 
            {
                
                if($op->name == $us->name)
                {
                    $new                =   new OperatorUser();
                    $new->operator_id   =   $op->id;
                    $new->user_id       =   $us->id;

                    try {
                        $new->save();
                    } catch (\Exception $e) {
                        var_dump($e->getMessage());
                    }
                }
            }            
        }
    }
}
