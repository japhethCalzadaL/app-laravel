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

                @if(session('success'))
                    <div class="success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="field">
                    <label for="archivo">Seleccionar Archivo:</label>
                    <input type="file" name="file" id="file" accept=".pdf, .doc, .docx">
                </div>

                <div class="field">
                    <button type="submit">Timbrar</button>
                </div>
            </form>
        </div>
    </body>
</html>
