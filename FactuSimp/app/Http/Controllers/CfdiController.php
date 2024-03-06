<?php

namespace App\Http\Controllers;

use App\Models\Cfdi;
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

    public function index()
    {
        return view('cfdi');
    }

    public function list()
    {
        return view('list', [
            'cfdis'     => Cfdi::latest()->paginate(10)
        ]);
    }


    public function create(Request $request)
    {
        $cfdiData = [];
        $cfdiData["status"] = true;

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

        $xmlService = $this->xmlService->validateXML($request, $cfdiData);
        Cfdi::create($cfdiData);

        if (!$xmlService) {
            return redirect()->back()->withErrors(['error' => $cfdiData["error"]])->withInput();
        }

        return redirect()->route('cfdi.index')->with('success','Cfdi timbrado exitosamente');


    }
}
