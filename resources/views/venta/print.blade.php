@extends('shared.layoutAdminLTEv3')

@section('titulo','Venta ')
@section('subtitulo','Factura de venta')
@section('content')
<h2>NOTA DE VENTA</h2>
        <div class="row">
            <div class="col-xs12">
                <strong>Nombre</strong>
                <p >{{$Venta->nombre}}</p>
            </div>            
        </div>
        <div class="row">
        <?php 
        //    print_r($Venta->detalles()->get());
        ?>
            <table>
                <tr>
                    <td>producto</td>
                    <td>precio</td>
                    <td>cant</td>
                    <td>importe</td>
                </tr>
                @foreach($Venta->detalles()->get() as $det)
                <tr>
                    <td>{{$det->producto()->get()[0]->nombre}}</td>
                    <td>{{$det->precio}}</td>
                    <td>{{$det->cant}}</td>
                    <td>{{$det->precio * $det->cant}}</td>
                </tr>
                @endforeach
            </table>
        </div>
<script>
    window.print();
</script>
@endsection
