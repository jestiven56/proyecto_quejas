@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Permisos <small>Consulta</small></h1>
@stop

@section('content')
    
    <div class="card">

      <div class="card-header">

        <x-adminlte-button label="Nuevo" type="button" title="Nuevo Permiso" class="float-right" data-toggle="modal" data-target="#modalPurple" theme="primary"/>

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
              @foreach($permisos as $permiso)
                  <tr>
                      <td>{{$permiso->id}}</td>
                      <td>{{$permiso->name}}</td>
                      <td>
                        
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" data-toggle="modal" data-target="#modalEditar" data-id="{{ $permiso->id }}" title="Editar">
                          <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>

                        <form style="display: inline" action="{{route('permisos.destroy', $permiso)}}" method="POST" class="formEliminar">
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
    <x-adminlte-modal id="modalPurple" title="Nuevo Permiso" theme="primary"
        icon="fas fa-bolt" size='lg' disable-animations>

        <form action="{{route('permisos.store')}}" method="post">
          @csrf
          <div class="row">
            <x-adminlte-input label="Permiso" name="permiso" placeholder="Aqui su Permiso" fgroup-class="col-md-6 mx-auto" disable-feedback/>
          </div>
          <div class="row">
            <x-adminlte-button class="mx-auto mb-2" type="submit" label="Guardar" theme="primary" icon="fas fa-lg fa-save"/>
          </div>
          
        </form>
        

    </x-adminlte-modal>

    <x-adminlte-modal id="modalEditar" title="Editar Permiso" theme="primary"
        icon="fas fa-pen" size='lg' disable-animations>
      <!-- Formulario para editar permiso -->
      <form id="formEditarPermiso" method="post">
        @csrf
        @method('put')
        <div class="row">
          <x-adminlte-input label="Permiso" name="permiso" placeholder="Aquí su Permiso" fgroup-class="col-md-6 mx-auto" disable-feedback />
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
<script>
  $(document).ready(function(){
    // Manejar el evento de hacer clic en el botón de editar
    $('.btn-edit').click(function(){
      var permisoId = $(this).data('id');
      var url = '/permisos/' + permisoId + '/edit'; // Ruta para obtener datos del permiso

      // Realizar una solicitud AJAX para obtener los datos del permiso
      $.get(url, function(data){
        // Rellenar el formulario en el modal de edición con los datos del permiso
        $('#formEditarPermiso input[name="permiso"]').val(data.name);

        // Configurar la acción del formulario para enviar datos de actualización al servidor
        $('#formEditarPermiso').attr('action', '/permisos/' + permisoId);
      });
    });
  });
</script>


@stop