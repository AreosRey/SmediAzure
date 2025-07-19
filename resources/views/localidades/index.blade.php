@extends('layouts.base')

@push('styles')
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
          <h2 class="h5 page-title mb-0">Listado de Localidades</h2>
          <a href="{{ route('localidades.create') }}" class="btn btn-primary mb-2">+ Nueva Localidad</a>
        </div>

        {{-- Alertas --}}
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

        <div class="card shadow">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table datatables table-striped" id="dataTable-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre de la Localidad</th>
                    <th>Municipio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($localidades as $localidad)
                    <tr>
                      <td>{{ $localidad->id_localidad }}</td>
                      <td>{{ $localidad->localidad }}</td>
                      <td>{{ $localidad->municipio->municipio ?? 'N/A' }}</td>
                      <td>
                        <a href="{{ route('localidades.edit', $localidad->id_localidad) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                        <a href="{{ route('localidades.show', $localidad->id_localidad) }}" class="btn btn-sm btn-outline-info">Ver</a>

                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#confirmModal{{ $localidad->id_localidad }}">
                          Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal{{ $localidad->id_localidad }}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel{{ $localidad->id_localidad }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                              <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel{{ $localidad->id_localidad }}">Confirmar Eliminación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar la localidad <strong>{{ $localidad->localidad }}</strong>?
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                <form action="{{ route('localidades.destroy', $localidad->id_localidad) }}" method="POST">
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
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"]
        ],
        "language": {
          "search": "Buscar:",
          "lengthMenu": "Mostrar _MENU_ entradas",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
          "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          },
          "zeroRecords": "No se encontraron resultados",
          "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
          "infoFiltered": "(filtrado de _MAX_ entradas totales)"
        }
      });
    });
  </script>
@endpush
