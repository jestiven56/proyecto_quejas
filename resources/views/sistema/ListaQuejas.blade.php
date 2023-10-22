@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Queja-Reclamo <small>Consulta</small></h1>
@stop

@section('content')
    <p>Lista Queja-Reclamo</p>
    
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
              'ID',
              'Usuario',
              'Tipo',
              ['label' => 'Descripcion', 'width' => 50],
              ['label' => 'Actions', 'no-export' => true, 'width' => 15],
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
                      <td>{{$queja->id}}</td>
                      <td>{{$queja->usuario_id}}</td>
                      <td>{{$queja->tipo}}</td>
                      <td>{{$queja->descripcion}}</td>
                      <td>
                        
                        <a href="{{route('quejas.edit', $queja)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        @can('Eliminar-Queja')
                          <form style="display: inline" action="{{route('quejas.destroy', $queja)}}" method="POST" class="formEliminar">
                            @csrf
                            @method('delete')
                            {!! $btnDelete!!}
                          </form>
                        @endcan

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