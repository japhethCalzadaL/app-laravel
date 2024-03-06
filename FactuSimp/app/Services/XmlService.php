<?php
namespace App\Services;

use App\Models\Cfdi;
use Illuminate\Http\Request;
use SimpleXMLElement;
use Illuminate\Support\Facades\Validator;

class XmlService
{
    /**
     * function function
     *
     * @param Request $request
     * @param array $cfdi
     * @return array
     */
    public function validateXML(Request $request, &$cfdiData)
    {
        $response = [];

        $file = $request->file('file');
        $xmlContent = file_get_contents($file->getRealPath());
        $xml = new SimpleXMLElement($xmlContent);
        $xml->registerXPathNamespace('cfdi', 'http://www.sat.gob.mx/cfd/4');

        $validateDate = $this->validateDate($xml, $cfdiData);
        $validateMethodPayment = $this->validateMethodPayment($xml);
        $validateUseCfdi = $this->validateUseCfdi($xml);

        $this->rfcData($xml, $cfdiData);

        if (!$validateDate) {
            $response["error"] = true;
            $response["message"] = 'El campo Fecha no cumple con el patrón requerido.';
            $cfdiData["error"] = $response["message"];
            $cfdiData["status"] = false;

            return $response;
        }

        if (!$validateMethodPayment) {
            $response["error"] = true;
            $response["message"] = 'El campo FormaPago no contiene un valor del catálogo c_FormaPago.';
            $cfdiData["error"] = $response["message"];
            $cfdiData["status"] = false;

            return $response;
        }

        if (!$validateUseCfdi) {
            $response["error"] = true;
            $response["message"] = 'La clave del campo UsoCFDI debe corresponder
            con el tipo de persona (física o moral)';

            $cfdiData["error"] = $response["message"];
            $cfdiData["status"] = false;

            return $response;
        }

        $response["error"] = false;
        $response["message"] = 'Se ha timbrado exitosamente.';

        return $response;
    }

    /**
     * validateDate function
     *
     * @param SimpleXMLElement $xml
     * @param array $cfdiData
     * @return boolean
     */
    public function validateDate(SimpleXMLElement $xml, array &$cfdiData)
    {
        $date = $xml->xpath('//cfdi:Comprobante/@Fecha');
        $date = count($date) > 0 ? (string)$date[0] : null;

        $rule = [
            'date' => ['regex:/^(20[1-9][0-9])-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])T(([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9])$/'],
        ];

        $validador = Validator::make(['date' => $date], $rule);

        return $validador->passes();
    }

    /**
     * validateMethodPayment function
     *
     * @param SimpleXMLElement $xml
     * @return boolean
     */
    public function validateMethodPayment(SimpleXMLElement $xml)
    {
        $allowedPaymentMethods = [
            '01', '02', '03', '04', '05', '06', '08', '12', '13', '14',
            '15', '17', '23', '24', '25', '26', '27', '28', '29', '30',
            '31', '99'
        ];

        $methodPayment = $xml->xpath('//cfdi:Comprobante/@FormaPago');
        $methodPayment = count($methodPayment) > 0 ? (string)$methodPayment[0] : null;

        if ($methodPayment !== null && in_array($methodPayment, $allowedPaymentMethods)) {

            return true;
        }

        return false;
    }

    public function validateUseCfdi(SimpleXMLElement $xml)
    {
        $allowedUseCfdi =  [
            'G01', 'G02', 'G03', 'I01', 'I02', 'I03', 'I04', 'I05', 'I06',
            'I07', 'I08', 'D01', 'D02', 'D03', 'D04', 'D05', 'D06', 'D07',
            'D08', 'D09', 'D10', 'P01'
        ];

        $useCfdi = $xml->xpath('//cfdi:Receptor/@UsoCFDI');
        $useCfdi = count($useCfdi) > 0 ? (string)$useCfdi[0] : null;

        if ($useCfdi !== null && in_array($useCfdi, $allowedUseCfdi)) {

            return true;
        }

        return false;
    }

    /**
     * validateDate function
     *
     * @param SimpleXMLElement $xml
     * @param array $cfdiData
     * @return void
     */
    public function rfcData(SimpleXMLElement $xml, array &$cfdiData)
    {
        $rfcTransmitter = $xml->xpath('//cfdi:Emisor/@Rfc');
        $rfcTransmitter = count($rfcTransmitter) > 0 ? (string)$rfcTransmitter[0] : null;

        $rfcReceiver = $xml->xpath('//cfdi:Receptor/@Rfc');
        $rfcReceiver = count($rfcReceiver) > 0 ? (string)$rfcReceiver[0] : null;

        $cfdiData["rfc_transmitter"] = $rfcTransmitter;
        $cfdiData["rfc_receiver"] = $rfcReceiver;

    }

}


