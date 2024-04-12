@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
            <a href="/combined-data">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
         

              <li >
                <a href="/report">
                    <i class="fa fa-reports"></i>
                    <span> Reports</span>
                </a>
            </li>
       
      
             <li >
                <a href="/meeting">
                    <i class="fa fa-meetings"></i>
                    <span> Meetings</span>
                </a>
            </li>
           

            <li >
            <a href="/form">
                    <i class="fa fa-reports"></i>
                    <span> Forms</span>
                </a>
            </li>

                <!-- Duplicated User Management Section -->
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-shapes"></i>
                    <span class="title">Drawings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu text-center">
                 
                    <!-- <li >
                        <a href="products">Products</a>
                    </li> -->
                    <li>
                        <a href="structural">Structural</a>
                    </li> 
                    <li>
                        <a href="architectural">Architectural</a>
                    </li> 
                    <li>
                        <a href="mefps">MEFPS</a>
                    </li> 
                    <li>
                        <a href="asbuilt">AS-BUILT</a>
                    </li> 
                </ul>
            </li>

            <li >
            <a href="inspection">
                    <i class="fa fa-reports"></i>
                    <span> Inspection Test Results</span>
                </a>
            </li>

            <li >
                <a href="directory">
                    <i class="fa fa-directory"></i>
                    <span> Directory</span>
                </a>
            </li>

            

            
            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>

          
           
        </ul>
    </section>
</aside>

