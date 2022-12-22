<?php

namespace App\Models\Clients\Transference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenceFile extends Model
{
    use HasFactory;

    public static function RegFile($data)
    {
        try {
            $new    =   new TransferenceFile();
            $new->identified    =   $data['identified'];
            $new->name          =   $data['name'];
            $new->dir_name      =   $data['dir'];
            return  ( $new->save() ) ? $new->id : false;
            
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function SearchFile($id)
    {
        try {
            $search  =   TransferenceFile::where('identified', '=', $id)->get();
            return $search;
        } catch (\Exception $e) {
            return false;
        }
    }
}
