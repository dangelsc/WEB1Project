@extends('shared.layoutAdminLTEv3')

@section('titulo','Categoria')
@section('subtitulo','Lista')
@section('content')

    <div class="row">
        <div class="pull-right">
            <!--<a href="/categoria/create"></a>-->
            <a class="btn btn-success" 
                href="{{ route('categoria.create')}}">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>
    @if($msg = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$msg}}</p>
    </div>
    @endif
    <?php $i=0;?>
    <table class="table">
        <tr>
            <th>Nº</th>
            <th>nombre</th>
            <th>accion</th>
        </tr>
        @foreach($lista as $categoria)
        <tr>
            <td>{{++$i}}</td>
            <td>{{ $categoria->nombre}}</td>
            <td>
                <form action="{{ route('categoria.destroy',$categoria->id_categoria) }}" method="post">
                    <a href="{{route('categoria.edit',$categoria->id_categoria)}}">
                        <i class="fas fa-edit fa-lg"></i>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Borra" >
                        <i class="fas fa-trashfa-lg text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $lista->links() !!}
@endsection