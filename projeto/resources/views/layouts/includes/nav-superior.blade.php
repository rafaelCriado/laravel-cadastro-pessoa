<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white  navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Início</a>
          </li>

        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout')}}">
              Sair <i class="nav-icon fas fa-sign-out-alt"></i>
            </a>
          </li>
        </ul>
        <!-- #include('layouts.includes.aside-right') -->
      </nav>
      <!-- /.navbar -->
