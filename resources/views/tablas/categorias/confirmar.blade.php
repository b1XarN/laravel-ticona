@extends('layout.plantilla')

@section('contenido')
<h1>Desea eliminar registro? Codigo: {{ $categoria->codcategoria }} - Descripcion: {{ $categoria->descripcion}}</h1>
<form method="POST" action="{{route('categoria.destroy',$categoria->codcategoria)}}">    
    @method('delete')
    @csrf
    
    <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>  SI</button>
    <a href="{{route('cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle">NO</i></a>
</form>
@endsection