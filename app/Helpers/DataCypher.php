<?php

namespace App\Helpers;

use App\Helpers\Cypher;

class DataCypher extends Cypher
{
    public function __construct($key)
    {
        parent::__construct($key,'AES-256-CBC');
    }

    /**
     * Funcion utilizada para decifrar el valor dado
     * @param   string  $input (Texto a Descifrar)
     * @return  array
     */
    public function UnCypher($input, $keygen)
    {
        return json_decode($this->decrypt($input, $keygen), true);
    }

     /**
     * Funcion utilizada para encriptar el valor dado
     * @param   string  $input (Texto a Descifrar)
     * @return  array
     */
    public function CypherData($input, $keygen)
    {
        return  $this->encrypt($input, $keygen);
    }    
}
