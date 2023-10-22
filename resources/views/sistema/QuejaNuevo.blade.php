@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Queja-Reclamo <small>Nuevo</small></h1>
@stop

@section('content')
    <p>Informacion de la Queja-Reclamo</p>

    @php
        if(session()){
          if(session('message')=='ok'){
            echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Correcto" dismissable>
                Informacion Registrada Correctamente!
            </x-adminlte-alert>';
          }
        }
    @endphp

    <form action="{{route('quejas.store')}}" method="POST">
      @csrf
      <div class="container mt-5">

        <div class="row">
            <div class="col-md-4 mx-auto">
                <x-adminlte-input name="tipo" placeholder="Tipo (Queja O Reclamo)" fgroup-class="w-100" disable-feedback value="{{old('tipo')}}"/>
            </div>
        </div>

        <div class="row">
          <div class="col-md-6 mx-auto">
              <x-adminlte-textarea name="descripcion" placeholder="Descripcion" rows="5" fgroup-class="w-100" disable-feedback value="{{old('descripcion')}}"/>
          </div>
        </div>

        <div class="row">
          <div class=" mx-auto">
            <x-adminlte-button label="Guardar" type="submit" theme="primary" icon="fas fa-save"/>
            <a href="{{route('quejas.index')}}" class="btn btn-secondary">Cancelar</a>
          </div>
        </div>

      </div>
    </form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop