<?php

namespace Database\Seeders;

use App\Models\Clients\Country\Municipality;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Alto Orinoco')];
        $data[1]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Atabapo')];
        $data[2]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Atures')];
        $data[3]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Autana')];
        $data[4]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Manapiare')];
        $data[5]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Maroa')];
        $data[6]   = ['estate' => 1, 'status' => $status, 'name' => ucfirst('Rio Negro')];
        
        $data[7]   = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Anaco')];
        $data[8]   = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Aragua')];
        $data[9]   = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Manuel Ezequiel Bruzual')];
        $data[10]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Diego Bautista Urbaneja')];
        $data[11]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Fernando Penalver')];
        $data[12]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Francisco Del Carmen Carvajal')];
        $data[13]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('General Sir Arthur McGregor')];
        $data[14]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Guanta')];
        $data[15]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Independencia')];
        $data[16]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Jose Gregorio Monagas')];
        $data[17]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Juan Antonio Sotillo')];
        $data[18]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Juan Manuel Cajigal')];
        $data[19]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Libertad')];
        $data[20]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Francisco de Miranda')];
        $data[21]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Pedro Maria Freites')];
        $data[22]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Piritu')];
        $data[23]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('San Jose de Guanipa')];
        $data[24]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('San Juan de Capistrano')];
        $data[25]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Santa Ana')];
        $data[26]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Simon Bolivar')];
        $data[27]  = ['estate' => 2, 'status' => $status, 'name' => ucfirst('Simon Rodriguez')];
       
        $data[28]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('Achaguas')];
        $data[29]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('Biruaca')];
        $data[30]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('Munoz')];
        $data[31]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('Paez')];
        $data[32]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('Pedro Camejo')];
        $data[33]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('Romulo Gallegos')];
        $data[34]  = ['estate' => 3, 'status' => $status, 'name' => ucfirst('San Fernando')];
        
        $data[35]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Atanasio Girardot')];
        $data[36]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Bolivar')];
        $data[37]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Camatagua')];
        $data[38]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Francisco Linares Alcantara')];
        $data[39]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Jose angel Lamas')];
        $data[40]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Jose Felix Ribas')];
        $data[41]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Jose Rafael Revenga')];
        $data[42]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Libertador')];
        $data[43]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Mario Briceno Iragorry')];
        $data[44]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Ocumare de la Costa de Oro')];
        $data[45]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('San Casimiro')];
        $data[46]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('San Sebastian')];
        $data[47]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Santiago Marino')];
        $data[48]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Santos Michelena')];
        $data[49]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Sucre')];
        $data[50]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Tovar')];
        $data[51]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Urdaneta')];
        $data[52]  = ['estate' => 4, 'status' => $status, 'name' => ucfirst('Zamora')];
       
        $data[53]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Alberto Arvelo Torrealba')];
        $data[54]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Andres Eloy Blanco')];
        $data[55]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Antonio Jose de Sucre')];
        $data[56]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Arismendi')];
        $data[57]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Barinas')];
        $data[58]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Bolivar')];
        $data[59]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Cruz Paredes')];
        $data[60]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Ezequiel Zamora')];
        $data[61]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Obispos')];
        $data[62]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Pedraza')];
        $data[63]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Rojas')];
        $data[64]  = ['estate' => 5, 'status' => $status, 'name' => ucfirst('Sosa')];
        
        $data[65]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Caroni')];
        $data[66]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Cedeno')];
        $data[67]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('El Callao')];
        $data[68]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Gran Sabana')];
        $data[69]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Heres')];
        $data[70]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Piar')];
        $data[71]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Angostura (Raul Leoni)')];
        $data[72]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Roscio')];
        $data[73]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Sifontes')];
        $data[74]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Sucre')];
        $data[75]  = ['estate' => 6, 'status' => $status, 'name' => ucfirst('Padre Pedro Chien')];
        
        $data[76]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Bejuma')];
        $data[77]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Carlos Arvelo')];
        $data[78]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Diego Ibarra')];
        $data[79]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Guacara')];
        $data[80]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Juan Jose Mora')];
        $data[81]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Libertador')];
        $data[82]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Los Guayos')];
        $data[83]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Miranda')];
        $data[84]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Montalban')];
        $data[85]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Naguanagua')];
        $data[86]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Puerto Cabello')];
        $data[87]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('San Diego')];
        $data[88]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('San Joaquin')];
        $data[89]  = ['estate' => 7, 'status' => $status, 'name' => ucfirst('Valencia')];
       
        $data[90]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Anzoategui')];
        $data[91]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Tinaquillo')];
        $data[92]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Girardot')];
        $data[93]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Lima Blanco')];
        $data[94]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Pao de San Juan Bautista')];
        $data[95]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Ricaurte')];
        $data[96]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Romulo Gallegos')];
        $data[97]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('San Carlos')];
        $data[98]  = ['estate' => 8, 'status' => $status, 'name' => ucfirst('Tinaco')];
        
        $data[99]  = ['estate' => 9, 'status' => $status, 'name' => ucfirst('Antonio Diaz')];
        $data[100] = ['estate' => 9, 'status' => $status, 'name' => ucfirst('Casacoima')];
        $data[101] = ['estate' => 9, 'status' => $status, 'name' => ucfirst('Pedernales')];
        $data[102] = ['estate' => 9, 'status' => $status, 'name' => ucfirst('Tucupita')];
        
        $data[103] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Acosta')];
        $data[104] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Bolivar')];
        $data[105] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Buchivacoa')];
        $data[106] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Cacique Manaure')];
        $data[107] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Carirubana')];
        $data[108] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Colina')];
        $data[109] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Dabajuro')];
        $data[110] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Democracia')];
        $data[111] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Falcon')];
        $data[112] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Federacion')];
        $data[113] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Jacura')];
        $data[114] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Jose Laurencio Silva')];
        $data[115] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Los Taques')];
        $data[116] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Mauroa')];
        $data[117] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Miranda')];
        $data[118] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Monsenor Iturriza')];
        $data[119] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Palmasola')];
        $data[120] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Petit')];
        $data[121] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Piritu')];
        $data[122] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'San Francisco')];
        $data[123] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[124] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Tocopero')];
        $data[125] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Union')];
        $data[126] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Urumaco')];
        $data[127] = ['estate' => 10, 'status' => $status, 'name' => ucfirst( 'Zamora')];
        
        $data[128] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Camaguan')];
        $data[129] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Chaguaramas')];
        $data[130] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'El Socorro')];
        $data[131] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Jose Felix Ribas')];
        $data[132] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Jose Tadeo Monagas')];
        $data[133] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Juan German Roscio')];
        $data[134] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Julian Mellado')];
        $data[135] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Las Mercedes')];
        $data[136] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Leonardo Infante')];
        $data[137] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Pedro Zaraza')];
        $data[138] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Ortiz')];
        $data[139] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'San Geronimo de Guayabal')];
        $data[140] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'San Jose de Guaribe')];
        $data[141] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Santa Maria de Ipire')];
        $data[142] = ['estate' => 11, 'status' => $status, 'name' => ucfirst( 'Sebastian Francisco de Miranda')];
        
        $data[143] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Iribarren')];
        $data[144] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Andres Eloy Blanco')];
        $data[145] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Crespo')];
        $data[146] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Jimenez')];
        $data[147] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Moran')];
        $data[148] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Palavecino')];
        $data[149] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Simon Planas')];
        $data[150] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Torres')];
        $data[151] = ['estate' => 12, 'status' => $status, 'name' => ucfirst( 'Urdaneta')];
        
        $data[152] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Alberto Adriani')];
        $data[153] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Andres Bello')];
        $data[154] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Antonio Pinto Salinas')];
        $data[155] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Aricagua')];
        $data[156] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Arzobispo Chacon')];
        $data[157] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Campo Elias')];
        $data[158] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Caracciolo Parra Olmedo')];
        $data[159] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Cardenal Quintero')];
        $data[160] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Guaraque')];
        $data[161] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Julio Cesar Salas')];
        $data[162] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Justo Briceno')];
        $data[163] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Libertador')];
        $data[164] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Miranda')];
        $data[165] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Obispo Ramos de Lora')];
        $data[166] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Padre Noguera')];
        $data[167] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Pueblo Llano')];
        $data[168] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Rangel')];
        $data[169] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Rivas Davila')];
        $data[170] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Santos Marquina')];
        $data[171] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[172] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Tovar')];
        $data[173] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Tulio Febres Cordero')];
        $data[174] = ['estate' => 13, 'status' => $status, 'name' => ucfirst( 'Zea')];
        
        $data[175] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Acevedo')];
        $data[176] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Andres Bello')];
        $data[177] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Baruta')];
        $data[178] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Brion')];
        $data[179] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Buroz')];
        $data[180] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Carrizal')];
        $data[181] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Chacao')];
        $data[182] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Cristobal Rojas')];
        $data[183] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'El Hatillo')];
        $data[184] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Guaicaipuro')];
        $data[185] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Independencia')];
        $data[186] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Lander')];
        $data[187] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Los Salias')];
        $data[188] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Paez')];
        $data[189] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Paz Castillo')];
        $data[190] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Pedro Gual')];
        $data[191] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Plaza')];
        $data[192] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Simon Bolivar')];
        $data[193] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[194] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Urdaneta')];
        $data[195] = ['estate' => 14, 'status' => $status, 'name' => ucfirst( 'Zamora')];
        
        $data[196] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Acosta')];
        $data[197] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Aguasay')];
        $data[198] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Bolivar')];
        $data[199] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Caripe')];
        $data[200] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Cedeno')];
        $data[201] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Ezequiel Zamora')];
        $data[202] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Libertador')];
        $data[203] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Maturin')];
        $data[204] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Piar')];
        $data[205] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Punceres')];
        $data[206] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Santa Barbara')];
        $data[207] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Sotillo')];
        $data[208] = ['estate' => 15, 'status' => $status, 'name' => ucfirst( 'Uracoa')];
        $data[209] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Antolin del Campo')];
        
        $data[210] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Arismendi')];
        $data[211] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Garcia')];
        $data[212] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Gomez')];
        $data[213] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Maneiro')];
        $data[214] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Marcano')];
        $data[215] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Marino')];
        $data[216] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Peninsula de Macanao')];
        $data[217] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Tubores')];
        $data[218] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Villalba')];
        $data[219] = ['estate' => 16, 'status' => $status, 'name' => ucfirst( 'Diaz')];
        
        $data[220] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Agua Blanca')];
        $data[221] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Araure')];
        $data[222] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Esteller')];
        $data[223] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Guanare')];
        $data[224] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Guanarito')];
        $data[225] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Monsenor Jose Vicente de Unda')];
        $data[226] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Ospino')];
        $data[227] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Paez')];
        $data[228] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Papelon')];
        $data[229] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'San Genaro de Boconoito')];
        $data[230] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'San Rafael de Onoto')];
        $data[231] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Santa Rosalia')];
        $data[232] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[233] = ['estate' => 17, 'status' => $status, 'name' => ucfirst( 'Turen')];
       
        $data[234] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Andres Eloy Blanco')];
        $data[235] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Andres Mata')];
        $data[236] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Arismendi')];
        $data[237] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Benitez')];
        $data[238] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Bermudez')];
        $data[239] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Bolivar')];
        $data[240] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Cajigal')];
        $data[241] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Cruz Salmeron Acosta')];
        $data[242] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Libertador')];
        $data[243] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Marino')];
        $data[244] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Mejia')];
        $data[245] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Montes')];
        $data[246] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Ribero')];
        $data[247] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[248] = ['estate' => 18, 'status' => $status, 'name' => ucfirst( 'Valdez')];
        
        $data[249] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Andres Bello')];
        $data[250] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Antonio Romulo Costa')];
        $data[251] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Ayacucho')];
        $data[252] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Bolivar')];
        $data[253] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Cardenas')];
        $data[254] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Cordoba')];
        $data[255] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Fernandez Feo')];
        $data[256] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Francisco de Miranda')];
        $data[257] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Garcia de Hevia')];
        $data[258] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Guasimos')];
        $data[259] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Independencia')];
        $data[260] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Jauregui')];
        $data[261] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Jose Maria Vargas')];
        $data[262] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Junin')];
        $data[263] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Libertad')];
        $data[264] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Libertador')];
        $data[265] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Lobatera')];
        $data[266] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Michelena')];
        $data[267] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Panamericano')];
        $data[268] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Pedro Maria Urena')];
        $data[269] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Rafael Urdaneta')];
        $data[270] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Samuel Dario Maldonado')];
        $data[271] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'San Cristobal')];
        $data[272] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Seboruco')];
        $data[273] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Simon Rodriguez')];
        $data[274] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[275] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Torbes')];
        $data[276] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'Uribante')];
        $data[277] = ['estate' => 19, 'status' => $status, 'name' => ucfirst( 'San Judas Tadeo')];
        
        $data[278] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Andres Bello')];
        $data[279] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Bocono')];
        $data[280] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Bolivar')];
        $data[281] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Candelaria')];
        $data[282] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Carache')];
        $data[283] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Escuque')];
        $data[284] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Jose Felipe Marquez Canizalez')];
        $data[285] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Juan Vicente Campos Elias')];
        $data[286] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'La Ceiba')];
        $data[287] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Miranda')];
        $data[288] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Monte Carmelo')];
        $data[289] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Motatan')];
        $data[290] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Pampan')];
        $data[291] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Pampanito')];
        $data[292] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Rafael Rangel')];
        $data[293] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'San Rafael de Carvajal')];
        $data[294] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[295] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Trujillo')];
        $data[296] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Urdaneta')];
        $data[297] = ['estate' => 20, 'status' => $status, 'name' => ucfirst( 'Valera')];
        
        $data[298] = ['estate' => 21, 'status' => $status, 'name' => ucfirst( 'Vargas')];
       
        $data[299] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'San Felipe')];
        $data[300] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Bolivar')];
        $data[301] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Bruzual')];
        $data[302] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Cocorote')];
        $data[303] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Independencia')];
        $data[304] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Jose Antonio Paez')];
        $data[305] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'La Trinidad')];
        $data[306] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Manuel Monge')];
        $data[307] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Nirgua')];
        $data[308] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Pena')];
        $data[309] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Aristides Bastidas')];
        $data[310] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[311] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Urachiche')];
        $data[312] = ['estate' => 22, 'status' => $status, 'name' => ucfirst( 'Jose Joaquin Veroes')];
        
        $data[313] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Almirante Padilla')];
        $data[314] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Baralt')];
        $data[315] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Cabimas')];
        $data[316] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Catatumbo')];
        $data[317] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Colon')];
        $data[318] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Francisco Javier Pulgar')];
        $data[319] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Paez')];
        $data[320] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Jesus Enrique Losada')];
        $data[321] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Jesus Maria Semprun')];
        $data[322] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'La Canada de Urdaneta')];
        $data[323] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Lagunillas')];
        $data[324] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Machiques de Perija')];
        $data[325] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Mara')];
        $data[326] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Maracaibo')];
        $data[327] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Miranda')];
        $data[328] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Rosario de Perija')];
        $data[329] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'San Francisco')];
        $data[330] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Santa Rita')];
        $data[331] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Simon Bolivar')];
        $data[332] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Sucre')];
        $data[333] = ['estate' => 23, 'status' => $status, 'name' => ucfirst( 'Valmore Rodriguez')];
        $data[334] = ['estate' => 24, 'status' => $status, 'name' => ucfirst( 'Libertador')];

        foreach ($data as $d => $da) 
        {
            $new    =   New Municipality();
            $new->name          =   $da['name'];
            $new->estate_id     =   $da['estate'];
            $new->status_id     =   $da['status'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
