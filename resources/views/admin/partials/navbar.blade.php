
    
    <li><a class="bg-green waves-effect waves-dark" href="{{URL::to('admin/dashboard')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Dashboard</span></a>
    </li>


    <li> <a class="d-none has-arrow waves-effect waves-dark {{ request()->is('admin/users/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
        <i class="icon-user"></i>
        <span class="hide-menu"> Users Management </span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/users/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/users/create') ? 'active' : ''}}"  
                href="{{URL::to('admin/users/create')}}">Create New</a>
            </li>
            <li><a class="{{ request()->is('admin/users/*') && request()->is('admin/users/create') == false  ? 'active' : '' }} "
                href="{{URL::to('admin/users/index')}}">View Users</a>
            </li>
        </ul>
    </li>

    <li> <a class="d-none has-arrow waves-effect waves-dark {{ request()->is('admin/roles/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-user"></i>
            <span class="hide-menu"> Roles Management </span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/roles/*') ? 'in' : '' }} ">
            <li><a class="{{ request()->is('admin/roles/create') ? 'active' : ''}}"  href="{{URL::to('admin/roles/create')}}">Create New</a></li>
            <li><a class="{{ request()->is('admin/roles/*') && request()->is('admin/roles/create') == false  ? 'active' : '' }}" href="{{URL::to('admin/roles/index')}}">View Roles</a>
            </li>
        </ul>
    </li>

    @if(Auth::user()->role_id == 1)
        <li><a class=" waves-effect waves-dark {{ request()->is('admin/companies/*') ? 'active' : '' }}" href="{{URL::to('/admin/companies')}}" 
            aria-expanded="false"><i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Companies</span></a>
        </li>
    @endif
    
    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/customers/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu"> Customers</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/customers/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/customers/create/edit') ? 'active' : ''}}"  
                href="{{URL::to('admin/customers/create/edit')}}">Create New</a></li>
            <li><a 
                class="{{ request()->is('admin/customers/*') && request()->is('admin/customers/create/edit') == false  ? 'active' : '' }}" 
                href="{{URL::to('admin/customers')}}">View Customers</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/products/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu"> Products</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/products/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/products/create') ? 'active' : ''}}"  
                href="{{URL::to('admin/products/create')}}">Create New</a></li>
            <li><a 
                class="{{ request()->is('admin/products/*') && request()->is('admin/products/create/edit') == false  ? 'active' : '' }}" 
                href="{{URL::to('admin/products')}}">View Products</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/orders/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu"> Orders</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/orders/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/orders/create/edit') ? 'active' : ''}}"  
                href="{{URL::to('admin/orders/create/edit')}}">Create New</a></li>
            <li><a 
                class="{{ request()->is('admin/orders/*') && request()->is('admin/orders/create/edit') == false  ? 'active' : '' }}" 
                href="{{URL::to('admin/orders')}}">View Orders</a>
            </li>
        </ul>
    </li>



    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <i class="ti-settings"></i>
        <span class="hide-menu">Settings</span></a>
        <ul aria-expanded="false" class="collapse">
            <li>
                <a href="{{URL::to('admin/settings/general')}}">General Settings</a>
            </li>  
            <li>
                <a href="{{URL::to('admin/settings/address')}}">Address Settings</a>
            </li>  
        </ul>
    </li>

    <li><a class=" waves-effect waves-dark" href="{{URL::to('/admin/logout')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Logout</span></a>
    </li>