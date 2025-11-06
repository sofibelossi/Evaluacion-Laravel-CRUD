@extends('layout')
@section('contenido')
<center>
<h1>Registro de usuario</h1>
<div style="width:400px;heigth:200;border: solid 1px;border-radius:10px;padding:15px;">
<form action="{{route ('register')}}" method="post">
@csrf
<label class="form-label">Nombre</label>
<input type="text" name="name" value="{{ old('name') }}" class="form-control">
 @error('name')
   <small class="font-bold text-danger">{{ $message }}</small>
 @enderror
 <label class="form-label">Email</label>
<input type="email" name="email" value="{{ old('email') }}" class="form-control">
 @error('email')
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror
 <label class="form-label">Contraseña</label>
<input type="password" name="password" class="form-control">
 @error('password')
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror
 <label class="form-label">Confirmar contraseña</label>
<input type="password" name="password_confirmation" value="{{ old('email') }}" class="form-control">
 @error('password_confirmation')
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror
 <button type="submit" class="btn btn-outline-primary mt-3">Registrar</button>
</form>
</div>
</center>
@endsection