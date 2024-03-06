<?php
namespace App\Services;

use Illuminate\Http\Request;
use SimpleXMLElement;

class XmlService
{
    public function xml(Request $request)
    {
        $file = $request->file('file');
        $xmlContent = file_get_contents($file->getRealPath());
        $xml = new SimpleXMLElement($xmlContent, LIBXML_NOCDATA, false, 'UTF-8');
        $xml->registerXPathNamespace('cfdi', 'http://www.sat.gob.mx/cfd/4');

        $date = $xml->xpath('//cfdi:Comprobante/@Fecha');
        $date = count($date) > 0 ? (string)$date[0] : null;

    }
}
