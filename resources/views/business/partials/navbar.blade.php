    <li><a class="bg-green waves-effect waves-dark" href="{{URL::to('business/dashboard')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Dashboard</span></a>
    </li>

    <li> <a class="d-none has-arrow waves-effect waves-dark {{ request()->is('business/users/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
        <i class="icon-user"></i>
        <span class="hide-menu"> Users Management </span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/users/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('business/users/create') ? 'active' : ''}}"  
                href="{{URL::to('business/users/create')}}">Create New</a>
            </li>
            <li><a class="{{ request()->is('admin/users/*') && request()->is('business/users/create') == false  ? 'active' : '' }} "
                href="{{URL::to('business/users/index')}}">View Users</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('business/vendors/*') || request()->is('business/vendor-transactions/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user-tie"></i>
        <span class="hide-menu">Vendor Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/vendors/*') || request()->is('business/vendor-transactions/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('business/vendors/*') ? 'active' : ''}}"  
                href="{{URL::to('business/vendors')}}">Vendor Account</a>
            </li>
            <li><a class="{{ request()->is('business/vendor-transactions/*') ? 'active' : ''}}"  
                href="{{URL::to('business/vendor-transactions')}}">Vendor Transactions</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('business/purchaseinvoices/*') || request()->is('business/purchaseinvoices/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-shopping-cart"></i>
        <span class="hide-menu"> Purchase Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/purchaseinvoices/*') ? 'in' : '' }}">
            <li>
                <a class="{{ request()->is('business/purchaseinvoices/create') ? 'active' : '' }}"  href="{{URL::to('business/purchaseinvoices/create')}}">Add Purchase Invoices</a>
            </li>
            <li>
                <a class="{{ request()->is('business/purchaseinvoices/*') && request()->is('business/purchaseinvoices/create') == false  ? 'active' : '' }}"  href="{{URL::to('business/purchaseinvoices')}}">Purchase Invoices</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('business/products/*') || request()->is('business/units/*') || request()->is('business/stockadjustment/*') || request()->is('business/categories')   ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-boxes"></i>
        <span class="hide-menu">Inventory Mangement </span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/products/*') || request()->is('business/units/*') || request()->is('business/stockadjustment/*') || request()->is('business/categories') ? 'in' : '' }}">
            <li><a 
                class="{{ request()->is('business/stockadjustment/*') ? 'active' : '' }}" 
                href="{{URL::to('business/stockadjustment')}}">Stock Adjustment</a>
            </li>
            <li><a 
                class="{{ request()->is('business/products/*')   ? 'active' : '' }}" 
                href="{{URL::to('business/products')}}">Products</a>
            </li>
            <li><a class="{{ request()->is('business/units/*')  ? 'active' : '' }}" 
                href="{{URL::to('business/units')}}">Units</a>
            </li>
            <li><a class="{{ request()->is('business/categories/*')   ? 'active' : '' }}" 
                href="{{URL::to('business/categories')}}">Category</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('business/customers/*') || request()->is('business/customer-transactions/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-users"></i>
        <span class="hide-menu">Customer Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/customers/*') || request()->is('business/customer-transactions/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('business/customers/*') ? 'active' : ''}}"  
                href="{{URL::to('business/customers')}}">Customer Account</a>
            </li>
            <li><a class="{{ request()->is('business/customer-transactions/*') ? 'active' : ''}}"  
                href="{{URL::to('business/customer-transactions')}}">Customer Transactions</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('business/saleinvoices/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-money-bill-alt"></i>
        <span class="hide-menu"> Sales Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/saleinvoices/*') || request()->is('business/saleinvoices/*') ? 'in' : '' }}">
            <li><a class="{{ request()->is('business/saleinvoices/*') ? 'active' : '' }}"  href="{{URL::to('business/saleinvoices')}}">Sale Invoices</a>
            </li>
        </ul>
    </li>

    <li><a class="has-arrow waves-effect waves-dark {{ request()->is('business/reports/*')  ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
        <i class="fas fa-file-alt"></i>
        <span class="hide-menu"> Report Managment</span></a>
        <ul aria-expanded="false" class="collapse {{ request()->is('business/reports/*') || request()->is('business/reports/*') ? 'in' : '' }}">

            <li><a class="{{ request()->is('business/reports/inventoryReport*') ? 'active' : '' }}" href="{{URL::to('business/reports/inventoryReport')}}">Inventory Report</a>
            </li>
            
            <li><a class="{{ request()->is('business/reports/customerLedger*') ? 'active' : '' }}" href="{{URL::to('business/reports/customerLedger')}}">Customer Ledger</a>
            </li>

            <li><a class="{{ request()->is('business/reports/vendorLedger*') ? 'active' : '' }}" href="{{URL::to('business/reports/vendorLedger')}}">Vendor Ledger</a>
            </li>

            <li><a class="{{ request()->is('business/reports/saleReport*') ? 'active' : '' }}" href="{{URL::to('business/reports/saleReport')}}">Sale Report</a>
            </li>

            <li><a class="{{ request()->is('business/reports/purchaseReport*') ? 'active' : '' }}" href="{{URL::to('business/reports/purchaseReport')}}">Purchase Report</a>
            </li>

            

        </ul>
    </li>


    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <i class="ti-settings"></i>
        <span class="hide-menu">Settings</span></a>
        <ul aria-expanded="false" class="collapse">
            <li>
                <a href="{{URL::to('business/settings/general')}}">General Settings</a>
            </li>  
            <li>
                <a href="{{URL::to('business/settings/address')}}">Address Settings</a>
            </li>  
        </ul>
    </li>


    <li><a class=" waves-effect waves-dark" href="{{URL::to('/business/logout')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Logout</span></a>
    </li>
