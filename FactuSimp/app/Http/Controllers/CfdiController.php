<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CfdiController extends Controller
{
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

    }
}
