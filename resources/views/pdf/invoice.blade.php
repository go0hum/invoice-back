<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    html, body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0; 
    }

    .container {
        width: 100%;
        padding: 5%;
    }

    .col-left, .col-center, .col-right {
        float: left;
        width: 30%;
    }

    .col-left p, .col-center p, .col-full p, .p-spacing p{
        margin: 0;
        padding: 0;
    }

     .col-left h1 {
        margin: 0;
        padding: 0 0 20px 0;
    }

    .col-right {
        text-align: right;
    }

    .col-right img {
        width: 100px;
        height: auto;
        padding: 20px;
    }

    .clear {
        clear: both;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        border: 1px solid #000;
        padding: 8px;
    }

    .col-full {
        width: 90%;
    }

    hr {
        padding: 0;
        margin: 20px 0;
    }

    </style>
</head>
<body>

<div class="container">
    <div class="col-left">
        <h1>{{ $emisor->compania }}</h1>
        <p>Nombre: {{ $emisor->nombre }}</p>
        <p>Apellido: {{ $emisor->apellido }}</p>
        <p>Email: {{ $emisor->email }}</p>
        <p>Telefono: {{ $emisor->telefono }}</p>
        <p>Sitio web: {{ $emisor->sitioweb }}</p>
        @if($emisor->direccion)
            <p>Direccion: {{ $emisor->direccion }}</p>
        @endif
        @if($emisor->ciudad)
            <p>Ciudad: {{ $emisor->ciudad }}</p>
        @endif
        @if($emisor->estado)
            <p>Estado: {{ $emisor->estado }}</p>
        @endif
        @if($emisor->codigoPostal)
            <p>Codigo Postal: {{ $emisor->codigoPostal }}</p>
        @endif
        @if($emisor->pais)
            <p>Pais: {{ $emisor->pais }}</p>
        @endif
    </div>
    <div class="col-center">
        @if($cliente->compania)
            <h1>{{ $cliente->compania }}</h1>
        @endif
        <p>Nombre: {{ $cliente->nombre }}</p>
        <p>Apellido: {{ $cliente->apellido }}</p>
        <p>Email: {{ $cliente->email }}</p>
        @if($cliente->direccion)
            <p>Direccion: {{ $cliente->direccion }}</p>
        @endif
        @if($cliente->ciudad)
            <p>Ciudad: {{ $cliente->ciudad }}</p>
        @endif
        @if($cliente->estado)
            <p>Estado: {{ $cliente->estado }}</p>
        @endif
        @if($cliente->codigoPostal)
            <p>Codigo Postal: {{ $cliente->codigoPostal }}</p>
        @endif
        @if($cliente->pais)
            <p>Pais: {{ $cliente->pais }}</p>
        @endif
    </div>
    <div class="col-right">
      <img src="{{ $image }}">
    </div>
    <div class="clear"></div>   
    <div class="col-full"><hr /></div>
    <div class="col-full">
        <p>Numero de factura: {{ $numeroFactura }}</p>
        <p>Fecha de factura: {{ $fechaFactura }}</p>
        <p>Vencimiento de factura: {{ $fechaVencimiento }}</p>
    </div> 
    <div class="col-full"><hr /></div>
    <div class="col-full">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        $precio = (float) $item->precio;
                    @endphp
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>$ {{ number_format($precio, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="clear"></div>   
    <div class="col-full"><hr /></div>
    <div class="col-left">
        &nbsp;
    </div>
    <div class="col-center">
        &nbsp;
    </div>
    <div class="col-right p-spacing">
        <p>Subtotal: $ {{ number_format($subtotal, 2) }}</p>
        @if($impuesto)
            <p>Impuesto: {{ $impuesto }} %</p>
        @endif
        @if($descuento)
            <p>Descuento: {{ $descuento }} %</p>
        @endif
        @if($total)
            <p>Total: $ {{ number_format($total, 2) }}</p>
        @endif
    </div>
</div>
        
</body>
</html>