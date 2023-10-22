@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Queja-Reclamo <small>Nuevo</small></h1>
@stop

@section('content')
    <p>Informacion de la Queja-Reclamo</p>

    <form action="{{route('quejas.store')}}" method="POST">
      @csrf
      <div class="container mt-5">

        <div class="row">
            <div class="col-md-4 mx-auto">
                <x-adminlte-select name="tipo" label="Tipo (Queja O Reclamo)" fgroup-class="w-100" disable-feedback>
                    <option value="">--Seleccione--</option>
                    <option value="Queja">Queja</option>
                    <option value="Reclamo">Reclamo</option>
                </x-adminlte-select>
            </div>
        </div>

        <div class="row">
          <div class="col-md-6 mx-auto">
              <x-adminlte-textarea name="descripcion" placeholder="Descripcion" rows="5" fgroup-class="w-100" disable-feedback value="{{old('descripcion')}}"/>
          </div>
        </div>

        <div class="row">
          <div class=" mx-auto">
            <input type="hidden" name="id_usuario" value="{{$id_usuario}}">
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
    @if (session("message")){
      <script>
        $(document).ready(function(){

          let message = "{{session('message')}}";
          Swal.fire({
            'title': 'Resultado',
            'text': message,
            'icon': 'success',
            didClose: () => {
              // Redirige a la página deseada después de que se cierre el cuadro de diálogo
              window.location.href = '/quejas';
            }
          })
        });
      </script>
    }

    @endif
@stop