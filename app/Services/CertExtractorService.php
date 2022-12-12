<?php declare(strict_types = 1);

namespace App\Services;

use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class CertExtractorService {
    public function extraer_pfisica(string $certPath){
        $fileContent = file_get_contents($certPath);
        $decodesContent = base64_encode($fileContent);
        $pieces = str_split($decodesContent, 64);
        array_unshift($pieces, '-----BEGIN CERTIFICATE-----');
        array_push($pieces, '-----END CERTIFICATE-----');
        $parse = openssl_x509_parse(implode("\r\n", $pieces));
        //dd($parse);
        $certificado['nombre_completo'] = str_replace('"', '', json_encode($parse['subject']['name']));
        $certificado['email'] = str_replace('"', '', json_encode($parse['subject']['emailAddress']));
        $certificado['rfc'] = str_replace('"', '', json_encode($parse['subject']['x500UniqueIdentifier']));
        //dd(strlen($certificado['rfc']));
        if(strlen($certificado['rfc']) == 13){
            //dd('entro');
            $certificado['curp'] = str_replace('"', '', json_encode($parse['subject']['serialNumber']));
            $certificado['rfc_sin_homoclave'] = substr($certificado['rfc'], 0,10);
            $certificado['homoclave'] = substr($certificado['rfc'],10, 13);
            $certificado['sexo'] = substr($certificado['curp'],10, -7);
            $año = substr($certificado['curp'],4, -12);
            $mes = substr($certificado['curp'],6, -10);
            $dia = substr($certificado['curp'],8, -8);
            $fecha = $año.'-'.$mes.'-'.$dia;
            $certificado['fecha_nacimiento'] = date("d/m/Y", strtotime($fecha));
            $certificado['nombre'] = $certificado['nombre_completo'];
            $certificado['primer_ap'] = '';
            $certificado['segundo_ap'] = '';

            $busquedaCURP = new BusquedaCURPService();
            $curpConsulta = $busquedaCURP->obtieneCURPDatos($certificado['curp']);
            if ($curpConsulta['error']) {                
                throw new InternalErrorException($curpConsulta['error_msg']);

            } elseif ($curpConsulta['curp_no_localizado']) {
                throw new NotFoundResourceException('No se encontraron datos asociados a la CURP:' . $certificado['curp']);

            } else {
                $certificado['nombre'] = $curpConsulta['curp_datos']['nombres'];
                $certificado['primer_ap'] = $curpConsulta['curp_datos']['apellido1'];
                $certificado['segundo_ap'] = $curpConsulta['curp_datos']['apellido2'];
            }


//            $curp = strtoupper($certificado['curp'] );
//            $curl = curl_init();
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => env('API_URL_BUSQUEDA_CURP'),
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => '',
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => 'POST',
//                CURLOPT_POSTFIELDS => '{
//		  "security":
//		  {
//		    "tokenId":"' . env('TOKEN_RENAPO') . '"
//		  },
//		  "data":
//		  {
//		   "CURP":"' . $curp . '"
//		  }
//
//		}',
//                CURLOPT_HTTPHEADER => array(
//                    'Content-Type: application/json',
//                ),
//            ));
//            $response = curl_exec($curl);
//            curl_close($curl);
//            $response = json_decode($response);
//            //dd($response);
//            if($response->error->msg == 'Datos obtenidos correctamente'){
//                $certificado['nombre'] = $response->data[0]->nombres;
//                $certificado['primer_ap'] = $response->data[0]->apellido1;
//                $certificado['segundo_ap'] = $response->data[0]->apellido2;
//            }
//            dd($certificado);
            return $certificado;
        }else{
            return false;
        }

    }

    public function extraer_pmoral(string $certPath)
    {
        $fileContent = file_get_contents($certPath);
        $decodesContent = base64_encode($fileContent);
        $pieces = str_split($decodesContent, 64);
        array_unshift($pieces, '-----BEGIN CERTIFICATE-----');
        array_push($pieces, '-----END CERTIFICATE-----');
        $parse = openssl_x509_parse(implode("\r\n", $pieces));

        $certificado['email'] = str_replace('"', '', json_encode($parse['subject']['emailAddress']));
        $rfc = str_replace('"', '', json_encode($parse['subject']['x500UniqueIdentifier']));
        $certificado['razon_social'] = str_replace('"', '', json_encode($parse['subject']['name']));
        $certificado['rfc']= explode(" ", $rfc);
        $certificado['rfc'] = $certificado['rfc'][0];
        if(strlen($certificado['rfc']) == 12){
            //dd(strlen($certificado['rfc']));
            $año = substr($certificado['rfc'],3, -7);
            //dd($año);
            $mes = substr($certificado['rfc'],5, -5);
            $dia = substr($certificado['rfc'],7, -3);
            $fecha = $año.'-'.$mes.'-'.$dia;
            //dd($fecha);
            $certificado['fecha_constitucion'] = date("d/m/Y", strtotime($fecha));
            return $certificado;
        }else{
            return false;
        }

    }
}
