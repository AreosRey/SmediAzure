@extends('layouts.base')

@push('styles')
  <!-- DataTables Bootstrap 4 CSS -->
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
@endpush

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('sidebar')
  @include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h5 page-title mb-0">Listado de Municipios</h2>
        <a href="{{ route('municipios.create') }}" class="btn btn-primary mb-2">+ Nuevo Municipio</a>
      </div>

      @if(session('success'))
        <div class="alert alert-{{ session('alert_type', 'success') }} alert-dismissible fade show" role="alert">
          @if(session('alert_type') === 'danger')
            <span class="fe fe-alert-triangle fe-16 mr-2"></span>
            <b>¡Eliminado!</b>
          @else
            <span class="fe fe-check-circle fe-16 mr-2"></span>
            <b>¡Éxito!</b>
          @endif
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      @endif

      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-body">
            <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12">
                  <table class="table datatables dataTable no-footer" id="dataTable-1" role="grid" aria-describedby="dataTable-1_info">
                    <thead>
                      <tr role="row">
                        <th>ID</th>
                        <th>Nombre Municipio</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($municipios as $municipio)
                        <tr role="row" class="odd">
                          <td>{{ $municipio->id_municipio }}</td>
                          <td>{{ $municipio->municipio }}</td>
                          <td>
                            <a href="{{ route('municipios.show', $municipio->id_municipio) }}" class="btn btn-sm btn-outline-info">Ver</a>
                            <a href="{{ route('municipios.edit', $municipio->id_municipio) }}" class="btn btn-sm btn-outline-warning">Editar</a>

                            <!-- Botón para lanzar modal eliminar -->
                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#confirmModal{{ $municipio->id_municipio }}">
                              Eliminar
                            </button>

                            <!-- Modal eliminar -->
                            <div class="modal fade" id="confirmModal{{ $municipio->id_municipio }}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel{{ $municipio->id_municipio }}" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel{{ $municipio->id_municipio }}">Confirmar Eliminación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>

                                  <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar el municipio <strong>{{ $municipio->municipio }}</strong>?
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    <form action="{{ route('municipios.destroy', $municipio->id_municipio) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                  </div>

                                </div>
                              </div>
                            </div>

                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Aquí pueden ir paginación e info si usas DataTables -->
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

<script>
  $(document).ready(function () {
    $('#dataTable-1').DataTable({
      autoWidth: true,
      lengthMenu: [
        [16, 32, 64, -1],
        [16, 32, 64, "Todos"]
      ],
      language: {
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ entradas",
        info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        paginate: {
          previous: "Anterior",
          next: "Siguiente"
        },
        zeroRecords: "No se encontraron resultados",
        infoEmpty: "Mostrando 0 a 0 de 0 entradas",
        infoFiltered: "(filtrado de _MAX_ entradas totales)"
      }
    });
  });
</script>
@endpush
