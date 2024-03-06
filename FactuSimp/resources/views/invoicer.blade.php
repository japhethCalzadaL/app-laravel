<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>FactuSimp</title>
    </head>
    <body>
        <div class="container">
            <form action="{{ route('cfdi.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2>Agrega el archivo XML a timbrar</h2>
                <div class="campo">
                    <label for="archivo">Seleccionar Archivo:</label>
                    <input type="file" name="archivo" id="archivo" accept=".pdf, .doc, .docx">
                </div>
                @error('archivo')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="campo">
                    <button type="submit">Timbrar</button>
                </div>
            </form>
        </div>
    </body>
</html>
