<?php
namespace App\Helpers;

use Illuminate\Http\Request;

class RajaOngkir
{
    public static function instance()
    {
        return new RajaOngkir();
    }

    public function get_provinces(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: f4c486593c2272db4e4355cc8592819e"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //decode
            $response=json_decode($response,true);
            if(isset($response['rajaongkir']['results'])){
                $provinsi = $response['rajaongkir']['results'];
            }
            else{
                $provinsi = $response['rajaongkir']['status'];
            }
            return $provinsi;
        }
    }

    public function get_cities(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: f4c486593c2272db4e4355cc8592819e"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //decode
            $response=json_decode($response,true);

            if(isset($response['rajaongkir']['results'])){
                $kota = $response['rajaongkir']['results'];
            }
            else{
                $kota = $response['rajaongkir']['status'];
            }
            return $kota;
        }
    }

    public function get_cost($asal, $tujuan, $berat, $kurir){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: f4c486593c2272db4e4355cc8592819e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response=json_decode($response,true);
            if(isset($response['rajaongkir']['results'])){
                $data_ongkir = $response['rajaongkir']['results'];
            }
            else{
                $data_ongkir = $response['rajaongkir']['status'];
            }
            return json_encode($data_ongkir);
        }
    }
}
