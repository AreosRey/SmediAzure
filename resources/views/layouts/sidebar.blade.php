<aside class="sidebar-left border-right shadow" id="leftSidebar" data-simplebar style="background-color: #2A5C8A;">
  <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-white ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
  </a>
  <nav class="vertnav navbar navbar-dark">
    <div class="w-100 mb-4 d-flex">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard') }}">
        <img 
          src="{{ asset('img/login/logo_smedi.jpg') }}" 
          alt="SMEDI Logo" 
          class="navbar-brand-img brand-sm" 
          style="height: 60px; width: auto; max-width: 100%; object-fit: contain; padding: 4px;"
        >
      </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item">
            <a class="nav-link pl-3 text-white" href="{{ route('dashboard') }}" style="background-color: rgba(255,255,255,0.15);">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-1 item-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3 text-white" href="{{ route('municipios.index') }}">
            <i class="fe fe-map-pin fe-16"></i>
            <span class="ml-1 item-text">Municipios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3 text-white" href="{{ route('localidades.index') }}">
            <i class="fe fe-navigation fe-16"></i>
            <span class="ml-1 item-text">Localidades</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3 text-white" href="{{ route('estado-energia.index') }}">
            <i class="fe fe-battery fe-16"></i>
            <span class="ml-1 item-text">Estado de Energia</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3 text-white" href="{{ route('dispositivos.index') }}">
            <i class="fe fe-hard-drive fe-16"></i>
            <span class="ml-1 item-text">Dispositivos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3 text-white" href="{{ route('ubicacion_antenas.index') }}">
            <i class="fe fe-wifi fe-16"></i>
            <span class="ml-1 item-text">Ubicacion Antenas</span>
            </a>
        </li>
    </ul>
  </nav>
</aside>

<style>
    /* Estilos personalizados */
    #leftSidebar {
        --sidebar-blue: #2A5C8A;
        --hover-blue: #1E4A6D;
        --active-blue: #3A7BAA;
    }
    
  
</style>