@extends('shared.layoutAdminLTEv3')

@section('titulo','Usuario')
@section('subtitulo','Lista')
@section('content')
    <div class="row">
        <div class="pull-rigth" >
            <a class="btn btn-success" href="{{ route('usuario.create')}}">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>

    </div>
    @if($msg = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$msg}}</p>
    </div>
    @endif
    <table class="table">
        <tr>
            <th>Nº</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Login</th>
            <th>acciones</th>
        </tr>
        @foreach($lista as $usuario)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$usuario->nombre}}</td>
            <td>{{$usuario->apellidos}}</td>
            <td>{{$usuario->login}}</td>
            <td>
                <form action="{{route('usuario.destroy',$usuario->id_usuario)}}"
                     method="post">
                    <a href="{{route('usuario.edit',$usuario->id_usuario)}}">
                        <i class="fas fa-edit fa-lg"></i>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit">
                        <i class="fas fa-trash fa-lg text-danger" ></i>
                    </button>

                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $lista->links()!!}
@endsection