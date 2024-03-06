<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <title>FactuSimp</title>
    </head>
    <body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Listado de cfdi enviados</h2>
            <a href="{{ route('cfdi.index') }}" class="btn btn-primary">Facturar</a>
        </div>
        @if ($cfdis->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>RFC Transmisor</th>
                        <th>RFC Receptor</th>
                        <th>Error</th>
                        <th>Status</th>
                        <th>Fecha de envío</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cfdis as $cfdi)
                        <tr>
                            <td>{{ $cfdi->rfc_transmitter }}</td>
                            <td>{{ $cfdi->rfc_receiver }}</td>
                            <td>{{ $cfdi->error }}</td>
                            <td>
                                @if ($cfdi->status == 1)
                                    Envíado
                                @else
                                    Error
                                @endif
                            </td>
                            <td>{{ $cfdi->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $cfdis->links('vendor.pagination.bootstrap-4') }}
            </div>
        @else
            <p>No hay registros de CFDI disponibles.</p>
        @endif
    </div>
    </body>
</html>
