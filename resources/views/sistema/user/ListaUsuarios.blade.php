@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios <small>Roles</small></h1>
@stop

@section('content')
    
    <div class="card">
      
      <div class="card-body">

        @php
          $heads = [
              'ID',
              'Nombre',
              'Correo',
              ['label' => 'Actions', 'no-export' => true, 'width' => 15],
          ];

          
          $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
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
              @foreach($users as $user)
                  <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        
                        <a href="{{route('asignar.edit', $user)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>

                        <form style="display: inline" action="{{route('asignar.destroy', $user)}}" method="POST" class="formEliminar">
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