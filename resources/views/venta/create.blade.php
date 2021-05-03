@extends('shared.layoutAdminLTEv3')

@section('titulo','Venta ')
@section('subtitulo','Nuevo ')
@section('content')
<div ng-app="tienda" ng-controller="venta">

    <a href="{{ route('categoria.index')}}">
        <i class = "fas fa-backward"></i>
    </a>
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Ooop! hay errores</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

   

    <form action="{{ route('venta.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-xs12">
                <strong>Nombre</strong>
                <input type="text" name="nombre" class="form-control">
            </div>
            
        </div>

        <div class="row" ng-init="ListaProductos={{
        json_encode($productos)}}" >
        <select name="a" ng-model="producto"
            ng-options="item.nombre for item in ListaProductos track by item.id_producto"
        ></select>
        <strong> producto: </strong> @{{ producto.nombre }}
        <strong> Bs.: </strong> @{{ producto.precio }}
        <input type="number" min="1" max="@{{producto.cant}}" name="n" ng-model="cant">
        <strong>IMPORTE:</strong>
        Bs.:@{{cant*producto.precio}}
        <button type="button" ng-click="agregar()">agregar</button>
    </div>



         

        <table>
            
            <tr ng-repeat="prod in carrito">
                <td>@{{prod.producto.nombre}}</td>
                <td>@{{prod.precio}}</td>
                <td>@{{prod.cant}}</td>
                <td>@{{prod.precio*prod.cant}}</td>
            </tr>
            <tr>
                <td rowspan="3">@{{total}}</td>
            </tr>
        </table>
        <input type="hidden" name="detalle" value="@{{detalle}}" ng-model="detalle" ng-value="detalle">
        
        <div class="row">
            <div class="col-xs12">
                <button type="submit" class="btn btn-primary" >Enviar</button>
            </div>
        </div>  
    </form>
</div>



<script src="/javascript/angular.min.js"></script>
<script>
angular.module('tienda',[])
.controller('venta',function($scope){
    $scope.carrito=[];
    $scope.total=0;
    $scope.detalle="";
    $scope.agregar=function(){
        //detalle venta
        $scope.carrito.push({
            id_producto:$scope.producto.id_producto,
            producto:$scope.producto,
            cant:$scope.cant,
            precio:$scope.producto.precio
        });
        actualizar();
    }
    function actualizar(){
        $scope.total=0;
        for(i=0;i<$scope.carrito.length;i++){
            $scope.total=$scope.total+($scope.carrito[i].cant*
                            $scope.carrito[i].precio);
        }
        $scope.detalle=JSON.stringify($scope.carrito);
    }
});

</script>

@endsection