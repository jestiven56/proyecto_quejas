@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Solicitud <small>Respuesta</small></h1>
@stop

@section('content')
    <p>Informacion de la Solicitud</p>

    <form action="{{route('quejas.guardarSeguimiento')}}" method="POST">
      @csrf
      <div class="container mt-5">

        <div class="row">
            <div class="col-md-4 mx-auto">
                <x-adminlte-input name="tipo" label="Tipo" placeholder="Tipo" value="{{$queja->tipo}}" fgroup-class="w-100" readonly disable-feedback />
            </div>
        </div>

        <div class="row">
          <div class="col-md-6 mx-auto">
              <x-adminlte-textarea name="descripcion" placeholder="Descripcion" readonly rows="5" fgroup-class="w-100" disable-feedback >
                {{$queja->descripcion}}
              </x-adminlte-textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mx-auto">
              <x-adminlte-textarea name="respuesta" placeholder="Respuesta" rows="5" fgroup-class="w-100" >
                {{$queja->respuesta}}
              </x-adminlte-textarea>
          </div>
        </div>



        <div class="row">
          <div class=" mx-auto">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('quejas.index')}}" class="btn btn-secondary">Volver</a>
            <input type="hidden" name="id" value="{{$queja->id}}">
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