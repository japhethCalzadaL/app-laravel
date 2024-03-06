<?php

namespace App\Http\Controllers;

use App\Services\XmlService;
use Illuminate\Http\Request;

class CfdiController extends Controller
{

    public function __construct(protected XmlService $xmlService)
    {
        $this->xmlService = $xmlService;
    }

    public function create(Request $request)
    {
        $messages = [
            'required' => 'Es necesario el archivo xml para poder timbrar',
            'mimes'    => 'El archivo debe ser de tipo :values.',
            'max'      => 'El tamaño máximo del archivo es :max kilobytes.',
        ];

        $request->validate([
            'archivo' => 'required|mimes:xml|max:1024',
        ], $messages);

        $this->xmlService->xml($request);
    }
}
