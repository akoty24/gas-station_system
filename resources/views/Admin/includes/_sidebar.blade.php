@php
    $segment = Request::segment(3);
    $route = Route::currentRouteName();
@endphp
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left">
          <img src="" style="width:40px;height:40px;border-radius:50%" class="" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-top:10px">
          <p style="font-size: 25px">مرحبا <span style="color: black " > عماد</span> </p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <!--<li class="header">MAIN NAVIGATION</li>-->
        <li class="{{ $route == 'admin.index' ? 'active' : '' }}">
            <a href="{{ route('shift_day') }}"><i class="fa fa-dashboard text-aqua"></i> <span style="font-size: 20px"> وردية اليوم</span></a>
        </li>
      

       

    <li class="{{ $segment == 'countries' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
      <a href="{{ route('deposits.index') }}">
           <span style="font-size: 20px">حركة الاستلام والايداع</span>
          <span class="pull-right-container">
          </span>
      </a>
  </li>
      <!-- country -->
      <li class="{{ $segment == 'countries' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
        <a href="{{ route('shifts.index') }}">
           <span style="font-size: 20px"> الورديات السابقة</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
    <li class="{{ $segment == 'countries' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
        <a href="{{ route('devices.index') }}">
         <span style="font-size: 20px">  اسعار البنزين</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>



                
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>