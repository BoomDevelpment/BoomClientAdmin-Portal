<?php 

namespace App\Helpers;

class Cypher
{
    /**
     * Llave de Encriptacion
     */
    protected $key;

    /**
     * Algoritmo para Encriptacion
     */
    protected $cipher;

    public function __construct($key, $cipher = 'AES-256-CBC')
    {
        $key    =   (string) $key;

        if(static::supported($key, $cipher))
        {
            $this->key      =   $key;
            $this->cipher   =   $cipher;
        }else{
            throw new \RuntimeException('The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths.');
        }
    }

    public function supported($key, $cipher)
    {
        $length     =   mb_strlen($key, '8bit');

        return  ($cipher === 'AES-128-CBC' && $length === 16) ||
                ($cipher === 'AES-256-CBC' && $length === 32);
    }

    /**
     * Cifra el valor dato
     * @param mixed $value
     * @return string
     * @throw \Exception
     */
    public function encrypt($value, $keygen)
    {
        $iv     =   random_bytes(16);
        $value  =   \openssl_encrypt(
            serialize($value),
            $this->cipher, $keygen, 0, $iv
        );

        if($value === false)
        {
            throw new \Exception('Could not encrypt the data.');
        }

        $mac    =   $this->hash($iv = base64_encode($iv), $value, $keygen);

        $json   =   json_encode(compact('iv', 'value', 'mac'));

        if(!is_string($json))
        {
            return  ['status' => false, 'message' => 'Could not encrypt the data.'];
        }else{
            return ['status' => true, 'cypher' => base64_encode($json), 'keygen' => $keygen];
        }
    
    }

    /**
     * Decifrar el Valor dado
     * @param   mixed   $payload
     * @return  string
     * @throw \Exception
     */
    public function decrypt($payload, $keygen)
    {
        $payload    =   $this->getJsonPayload($payload, $keygen);

        $iv         =   base64_decode($payload['iv']);

        $decrypted  =   \openssl_decrypt(
            $payload['value'], $this->cipher, $keygen, 0, $iv
        );

        if($decrypted === false)
        {
            throw new \Exception('Could not decrypt the data.'); 
        }

        return unserialize($decrypted);
    }

    /**
     * Crea el Mac para la concatenacion del vector de iniciacion y el valor cifrado
     * @param string    $iv
     * @param mixed     $value
     * @return string
     */
    public function hash($iv, $value, $keygen)
    {
        return hash_hmac('sha256', $iv.$value, $keygen);
    }
    
    /**
     * Obtener el arreglo del payload en formato Json
     * @param   string  $payload
     * @return  array
     * @throw   \Exception
     */
    public function getJsonPayload($payload, $keygen)
    {
        $payload    =   json_decode(base64_decode($payload), true);

        if(!$this->validPayload($payload, $keygen))
        {
            throw new \Exception('The payload is invalid.');
        }

        if(!$this->validMac($payload, $keygen))
        {
            throw new \Exception('The MAC is invalid.');
        }

        return $payload;
    }

    /**
     * Verifica que el payload es valido
     * @param   mixed   $payload
     * @return  bool
     */
    public function validPayload($payload, $keygen)
    {
        return  is_array($payload) && isset(
            $payload['iv'], $payload['value'], $payload['mac']
        );
    }

    /**
     * Determina si el Mac de este Payload es Valido
     * @param   array   $payload
     * @return  bool
     */
    public function validMac($payload, $keygen)
    {
        $calculate  =   $this->calculateMac($payload, $bytes = random_bytes(16), $keygen);
        
        return  hash_equals(
            hash_hmac('sha256', $payload['mac'], $bytes, true), $calculate
        );
    }

    /**
     * Calcula el hash del Payload Dado
     * @param   array   $payload
     * @param   string  $bytes
     * @return  string
     */
    public function calculateMac($payload, $bytes, $keygen)
    {
        return hash_hmac(
            'sha256', $this->hash($payload['iv'], $payload['value'], $keygen), $bytes, true
        );
        
    }
}
