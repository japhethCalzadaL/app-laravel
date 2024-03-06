<?php

namespace App\Http\Controllers;

use App\Services\XmlService;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xml|max:1024',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $xmlService = $this->xmlService->xml($request);

        $errors = new MessageBag(['error' => 'Error en el servicio']);
        return redirect()->back()->withErrors($errors)->withInput();
    }
}
