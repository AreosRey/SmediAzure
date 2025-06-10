@extends('layouts.base')

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('sidebar')
  @include('layouts.sidebar')
@endsection

  {{-- Contenido principal --}}
  @section('content')
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Listado de Localidades</h2>
              </div>
            </div>

            <div class="card shadow">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table datatables table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre de la Localidad</th>
                        <th>Municipio</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($localidades as $localidad)
                        <tr>
                          <td>{{ $localidad->id_localidad }}</td>
                          <td>{{ $localidad->localidad }}</td>
                          <td>{{ $localidad->municipio->municipio ?? 'N/A' }}</td>
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
