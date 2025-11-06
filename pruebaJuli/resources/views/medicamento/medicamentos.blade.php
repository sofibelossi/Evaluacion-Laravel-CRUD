@extends('layout')
@section('contenido')
@php
    $sortField = $sortField ?? 'id';
    $sortDirection = $sortDirection ?? 'asc';
    $buscar = $buscar ?? '';
@endphp
<h1>Lista de medicamentos</h1>
<div class="col-6">
    <form action="{{ route('buscar') }}" method="GET">
        <div class="row">
            <div class="col-6">
            <input type="text" name="buscar" placeholder="Buscar por marca o laboratorio" class="form-control">
            </div>
            <div class="col-6">
            <button type="submit" class="btn btn-info">Buscar</button>
            </div>
        </div>
</form>

    </div> <br>
<a href="{{ route('medicamentos.create') }}"  class="btn btn-primary">Nuevo</a>
<table class="table table-info table-striped mt-4">
<thead>
    <tr>
        <th scope="col"> 
             <a href="?sort=id&direction={{ $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    Id
                    @if($sortField === 'id')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a>
    </th>
        <th scope="col"> <a href="?sort=nombre&direction={{ $sortField === 'nombre' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    Nombre
                    @if($sortField === 'nombre')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a></th>
        <th scope="col"> <a href="?sort=marca&direction={{ $sortField === 'marca' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    Marca
                    @if($sortField === 'marca')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a></th>
        <th scope="col"> <a href="?sort=laboratorio&direction={{ $sortField === 'laboratorio' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    Laboratorio
                    @if($sortField === 'laboratorio')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a></th>
        <th scope="col">
             <a href="?sort=dosis&direction={{ $sortField === 'dosis' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    Dosis
                    @if($sortField === 'dosis')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a>
        </th>
        <th scope="col">imagen</th>
        <th scope="col">acciones</th>
    </tr>
</thead>
<tbody>
    @foreach($medicamentos as $medicamento)
    <tr>
        <td>{{$medicamento->id}}</td>
        <td>{{$medicamento->nombre}}</td>
        <td>{{$medicamento->marca}}</td>
        <td>{{$medicamento->laboratorio}}</td>
        <td>{{$medicamento->dosis}}</td>
        <td><img src="{{asset('imagenes/'.$medicamento->imagen)}}" style="width: 100px; heigth: 100px;" ></td>
        <td>
            <form action="{{route ('medicamentos.destroy',$medicamento->id)}}" method="post">
            <a href="/medicamentos/{{$medicamento->id}}/edit" class="btn btn-info">Editar</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection