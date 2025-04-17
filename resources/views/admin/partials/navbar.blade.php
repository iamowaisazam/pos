    <li><a class="bg-green waves-effect waves-dark" href="{{URL::to('admin/dashboard')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Dashboard</span></a>
    </li>

        <li> <a class="has-arrow waves-effect waves-dark {{ request()->is('admin/users/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-user"></i>
            <span class="hide-menu"> Users Management </span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/users/*') ? 'in' : '' }}">
                <li><a class="{{ request()->is('admin/users/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/users/create')}}">Create New</a></li>
                <li><a class="{{ request()->is('admin/users/*') && request()->is('admin/users/create') == false  ? 'active' : '' }} "
                    href="{{URL::to('admin/users/index')}}">View Users</a></li>
            </ul>
        </li>

      <li> <a class="has-arrow waves-effect waves-dark {{ request()->is('admin/roles/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-people"></i>
            <span class="hide-menu"> Roles Management </span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/roles/*') ? 'in' : '' }} ">
                <li><a class="{{ request()->is('admin/roles/create') ? 'active' : ''}}"  href="{{URL::to('admin/roles/create')}}">Create New</a></li>
                <li><a class="{{ request()->is('admin/roles/*') && request()->is('admin/roles/create') == false  ? 'active' : '' }}" href="{{URL::to('admin/roles/index')}}">View Roles</a></li>
            </ul>
     </li>
    

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/vendors/*') || request()->is('admin/vendor-transactions/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user-tie"></i>
        <span class="hide-menu">Vendor Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/vendors/*') || request()->is('admin/vendor-transactions/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/vendors/*') ? 'active' : ''}}"  
                href="{{URL::to('admin/vendors')}}">Vendor Account</a>
            </li>
            <li><a class="{{ request()->is('admin/vendor-transactions/*') ? 'active' : ''}}"  
                href="{{URL::to('admin/vendor-transactions')}}">Vendor Transactions</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/purchaseinvoices/*') || request()->is('admin/purchaseinvoices/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-shopping-cart"></i>
        <span class="hide-menu"> Purchase Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/purchaseinvoices/*') ? 'in' : '' }}">
            <li>
                <a class="{{ request()->is('admin/purchaseinvoices/create') ? 'active' : '' }}"  href="{{URL::to('admin/purchaseinvoices/create')}}">Add Purchase Invoices</a>
            </li>
            <li>
                <a class="{{ request()->is('admin/purchaseinvoices/*') && request()->is('admin/purchaseinvoices/create') == false  ? 'active' : '' }}"  href="{{URL::to('admin/purchaseinvoices')}}">Purchase Invoices</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/products/*') || request()->is('admin/units/*') || request()->is('admin/stockadjustment/*') || request()->is('admin/categories')   ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-boxes"></i>
        <span class="hide-menu">Inventory Mangement </span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/products/*') || request()->is('admin/units/*') || request()->is('admin/stockadjustment/*') || request()->is('admin/categories') ? 'in' : '' }}">
            <li><a 
                class="{{ request()->is('admin/stockadjustment/*') ? 'active' : '' }}" 
                href="{{URL::to('admin/stockadjustment')}}">Stock Adjustment</a>
            </li>
            <li><a 
                class="{{ request()->is('admin/products/*')   ? 'active' : '' }}" 
                href="{{URL::to('admin/products')}}">Products</a>
            </li>
            <li><a class="{{ request()->is('admin/units/*')  ? 'active' : '' }}" 
                href="{{URL::to('admin/units')}}">Units</a>
            </li>
            <li><a class="{{ request()->is('admin/categories/*')   ? 'active' : '' }}" 
                href="{{URL::to('admin/categories')}}">Category</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/customers/*') || request()->is('admin/customer-transactions/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-users"></i>
        <span class="hide-menu">Customer Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/customers/*') || request()->is('admin/customer-transactions/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/customers/*') ? 'active' : ''}}"  
                href="{{URL::to('admin/customers')}}">Customer Account</a>
            </li>
            <li><a class="{{ request()->is('admin/customer-transactions/*') ? 'active' : ''}}"  
                href="{{URL::to('admin/customer-transactions')}}">Customer Transactions</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/saleinvoices/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-money-bill-alt"></i>
        <span class="hide-menu"> Sales Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/saleinvoices/*') || request()->is('admin/saleinvoices/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('admin/saleinvoices/*') ? 'active' : '' }}"  href="{{URL::to('admin/saleinvoices')}}">Sale Invoices</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/reports/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-file-alt"></i>
        <span class="hide-menu"> Report Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('admin/reports/*') || request()->is('admin/reports/*') ? 'in' : '' }}">

            <li><a class="{{ request()->is('admin/reports/inventoryReport*') ? 'active' : '' }}" href="{{URL::to('admin/reports/inventoryReport')}}">Inventory Report</a>
            </li>
            
            <li><a class="{{ request()->is('admin/reports/customerLedger*') ? 'active' : '' }}" href="{{URL::to('admin/reports/customerLedger')}}">Customer Ledger</a>
            </li>

            <li><a class="{{ request()->is('admin/reports/vendorLedger*') ? 'active' : '' }}" href="{{URL::to('admin/reports/vendorLedger')}}">Vendor Ledger</a>
            </li>

            <li><a class="{{ request()->is('admin/reports/saleReport*') ? 'active' : '' }}" href="{{URL::to('admin/reports/saleReport')}}">Sale Report</a>
            </li>

            <li><a class="{{ request()->is('admin/reports/purchaseReport*') ? 'active' : '' }}" href="{{URL::to('admin/reports/purchaseReport')}}">Purchase Report</a>
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
            <li>
                <a href="{{URL::to('admin/settings/theme')}}">Theme Settings</a>
            </li>  
        </ul>
    </li>


    <li><a class=" waves-effect waves-dark" href="{{URL::to('/admin/logout')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Logout</span></a>
    </li>
