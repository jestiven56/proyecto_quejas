@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Roles <small>Consulta</small></h1>
@stop

@section('content')
    
    <div class="card">

      <div class="card-header">

        <x-adminlte-button label="Nuevo" type="button" title="Nuevo Rol" class="float-right" data-toggle="modal" data-target="#modalPurple" theme="primary"/>

      </div>
      
      <div class="card-body">

        @php
          $heads = [
              'ID',
              'Nombre',
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
              @foreach($roles as $rol)
                  <tr>
                      <td>{{$rol->id}}</td>
                      <td>{{$rol->name}}</td>
                      <td>
                        
                        <a href="{{route('roles.edit', $rol)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <form style="display: inline" action="{{route('roles.destroy', $rol)}}" method="POST" class="formEliminar">
                          @csrf
                          @method('delete')
                          {!! $btnDelete!!}
                        </form>

                      </td>
                  </tr>
              @endforeach
          </x-adminlte-datatable>
      </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nuevo Rol" theme="primary"
        icon="fas fa-bolt" size='lg' disable-animations>

        <form action="{{route('roles.store')}}" method="post">
          @csrf
          <div class="row">
            <x-adminlte-input label="Nombre" name="nombre" placeholder="Nombre" fgroup-class="col-md-6 mx-auto" disable-feedback/>
          </div>
          <div class="row">
            <x-adminlte-button class="mx-auto mb-2" type="submit" label="Guardar" theme="primary" icon="fas fa-lg fa-save"/>
          </div>
          
        </form>
        

    </x-adminlte-modal>

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