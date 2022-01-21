@if(auth()->user()->can('shipping_menu'))
<li class="nav-item shipping-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-map"></i>

        <p>
            Shipping
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('states.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='states.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create State</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('states.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='states.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List State</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('districts.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='districts.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create District</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('districts.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='districts.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List District</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('areas.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='areas.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Area</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('areas.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='areas.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Area</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('clusters.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='clusters.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Cluster</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clusters.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='clusters.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Cluster</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('shippingmethods.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='shippingmethods.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Method</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('shippingmethods.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='shippingmethods.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Method</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('shippings.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='shippings.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Shipping</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('shippings.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='shippings.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Shipping</p>
            </a>
        </li>
    </ul>
</li>
@endif