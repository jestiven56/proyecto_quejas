@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Solicitudes <small>Consulta</small></h1>
@stop

@section('content')
    <p>Lista Solicitudes</p>
    
    <div class="card">
      @can('Crear-Queja')
        <div class="card-head">
          <a type="button" href="{{route('quejas.create')}}" title="Nueva Queja-Reclamo" class="btn btn-primary mr-3 mt-2 float-right">
            Nuevo
          </a>
        </div>
      @endcan
      
      <div class="card-body">

        @php
          $heads = [
              
              ['label' => 'fecha', 'width' => 20],
              'Usuario',
              'Tipo',
              ['label' => 'Descripcion', 'width' => 50],
              ['label' => 'Estado', 'no-export' => true, 'width' => 10],
              ['label' => 'Acciones', 'no-export' => true, 'width' => 10],
          ];

          
          $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';
          $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>';
          
          $config=[
            'language' =>[
              'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                      ],
            'lengthMenu' => [5, 10, 20],
          ]
          @endphp

          {{-- Minimal example / fill data using the component slot --}}
          <x-adminlte-datatable  id="table1" :heads="$heads" :config="$config">
              @foreach($quejas as $queja)
                  <tr>
                      <td>{{$queja->fecha_sin_hora}}</td>
                      <td>{{$queja->email_usuario}}</td>
                      <td>{{$queja->tipo}}</td>
                      <td>{{$queja->descripcion}}</td>
                      <td>
                        @if($queja->estado==1)
                          <span class="badge badge-danger">Pendiente</span>
                        @else
                          <span class="badge badge-success">Atendido</span>
                        @endif
                      <td>
                        <a href="{{route('quejas.edit', $queja)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Ver">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                        @if(($queja->id_usuario==Auth::user()->id || Auth::user()->hasRole('Administrador')) && $queja->estado==1)
                          
                          <a href="{{route('quejas.show', $queja)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Seguimiento">
                              <i class="fa fa-lg fa-fw fa-forward"></i>
                          </a>
                        @endif

                      </td>
                  </tr>
              @endforeach
          </x-adminlte-datatable>
      </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>
  $(document).ready(function(){
    $('.formEliminar').submit(function(e){
      e.preventDefault();
      Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if(result.isConfirmed){
          this.submit();
        }
      });
    });
  });
</script>

@stop