  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg")}}" 
              class="img-circle" alt="{{ Auth::user()->name }}">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}<br/>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Pacienti</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('pacients.add') }}"><i class="fa fa-plus-square"></i> Pacient nou</a></li>
            <li><a href="{{ route('pacients') }}"><i class="fa fa-paper-plane-o"></i> Lista pacienti</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-calendar"></i> <span>Programari</span>
          <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('program.add') }}"><i class="fa fa-plus-square"></i> Intoducere programare</a></li>
            <li><a href="{{ route('program') }}"><i class="fa fa-paper-plane-o"></i> Lista programari</a></li>
          </ul>
          </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-stethoscope"></i> <span> Consultatii</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="{{ route('consults.add') }}"><i class="fa fa-plus-square"></i> Introduce consultatie</a></li>
            <li><a href="{{ route('consults') }}"><i class="fa fa-paper-plane-o"></i> Lista consultatii</a></li>
          </ul>

        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-pause"></i> <span> Concedii medicale</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="{{ route('concedii.add') }}"><i class="fa fa-plus-square"></i> Introduce concediu</a></li>
            <li><a href="{{ route('concedii') }}"><i class="fa fa-paper-plane-o"></i> Lista concediu</a></li>
          </ul>

        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-user-md"></i> <span>Utilizatori</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('users') }}"> <i class="fa fa-facebook-square"></i> Lista utilizatori</a></li>
            <li><a href="{{ route('users.add') }}"> <i class="fa fa-google-plus-square"></i> Adaugare utilizator</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bar-chart"></i> <span>Rapoarte</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"> <i class="fa fa-ambulance"></i> Conceddii medicale</a></li>
            <li><a href="#"> <i class="fa fa-heartbeat"></i> Boli frecvente</a></li>
            <li><a href="#"> <i class="fa fa-users"></i> Pacienti </a></li>
          </ul>
        </li>
        <li>
          <a href="{{ url('/logout') }}"> logout </a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>