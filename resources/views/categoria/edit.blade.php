@extends('shared.layoutAdminLTEv3')

@section('titulo','Categoria ')
@section('subtitulo','Nuevo ')
@section('content')

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

    <form action="{{ route('categoria.update',$categorial->id_categoria)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs12">
                <strong>Nombre</strong>
                <input type="text" name="nombre" value="{{$categorial->nombre}}" class="form-control">
            </div>
            
        </div>
        <div class="row">
            <div class="col-xs12">
                <button type="submit" class="btn btn-primary" >Enviar</button>
            </div>
        </div>    

    </form>

@endsection