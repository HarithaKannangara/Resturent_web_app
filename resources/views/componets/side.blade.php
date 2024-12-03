<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>
<style>
.logo-text {
    font-family: 'Calibri';
    text-align: center;
}

.logo-main {
    font-size: 18px;
    color: #0c84ff;
    font-weight: bold;
    position: relative;
    display: inline-block;
    letter-spacing: 5px;
    line-height: 2px;
}

</style>
<body>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">




        <div class="sidebar">

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <span class="logo-text">
                    <span class="logo-main">Resturent</span><br>

                </span>
            </div>
          </div>


          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item menu-open">
                <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard'))active @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard

                  </p>
                </a>
              </li>






            <li class="nav-item">
                <a href="{{ route('concessions.index') }}" class="nav-link @if(request()->routeIs('concessions'))active @endif">
                    <i class="nav-icon fas fa-book"></i>
                    <p>concessions</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}" class="nav-link @if(request()->routeIs('concessions'))active @endif">
                    <i class="nav-icon fas fa-book"></i>
                    <p>orders</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kitchen.index') }}" class="nav-link @if(request()->routeIs('concessions'))active @endif">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Kitchen</p>
                </a>
            </li>



            </li>
            </nav>
            </div>
      </aside>
</body>
</html>
