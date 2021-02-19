<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('admin/img/AdminLTELogo.png')}}" alt="merselin-shop"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">merselin shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{Auth::user()->profile_photo_url}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview {{(Request::routeIs('admin')?'menu-open':'')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('admin')?'#':route('admin'))}}"
                               class="nav-link {{(Request::routeIs('admin')?'active':'')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{(Request::routeIs('userProfile')?'#':route('userProfile'))}}"
                       class="nav-link {{(Request::routeIs('userProfile')?'active':'')}}">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                @can('view users')
	            <li class="nav-item has-treeview {{(Request::routeIs(['allUsers','roles'])?'menu-open':'')}}">
		            <a href="#" class="nav-link">
			            <i class="nav-icon fas fa-address-book"></i>
			            <p>
				            Users
				            <i class="right fas fa-angle-left"></i>
			            </p>
		            </a>
		            <ul class="nav nav-treeview">
			            <li class="nav-item">
				            <a href="{{(Request::routeIs('allUsers')?'#':route('allUsers'))}}"
				               class="nav-link {{(Request::routeIs('allUsers')?'active':'')}}">
					            <i class="far fa-list-alt nav-icon"></i>
					            <p>Users index</p>
				            </a>
			            </li>
                        @can('view roles')
			            <li class="nav-item">
				            <a href="{{(Request::routeIs('roles')?'#':route('roles'))}}"
				               class="nav-link {{(Request::routeIs('roles')?'active':'')}}">
					            <i class="far fa-address-card nav-icon"></i>
					            <p>Roles</p>
				            </a>
			            </li>
                        @endcan
		            </ul>
	            </li>
                @endcan
                @can('view categories')
                <li class="nav-item has-treeview {{(Request::routeIs(['categories.index','categories.create'])?'menu-open':'')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-object-group"></i>
                        <p>
                            categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('categories.index')?'#':route('categories.index'))}}"
                               class="nav-link {{(Request::routeIs('categories.index')?'active':'')}}">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>categories list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('categories.create')?'#':route('categories.create'))}}"
                               class="nav-link {{(Request::routeIs('categories.create')?'active':'')}}">
                                <i class="far fa-edit nav-icon"></i>
                                <p>add new category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('view attributes')
                <li class="nav-item has-treeview
                    {{(Request::routeIs(['attributes-group.index','attributes-value.index','attributes-group.create','attributes-value.create'])?'menu-open':'')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            attributes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('attributes-group.index')?'#':route('attributes-group.index'))}}"
                               class="nav-link {{(Request::routeIs('attributes-group.index')?'active':'')}}">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>attributes list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('attributes-value.index')?'#':route('attributes-value.index'))}}"
                               class="nav-link {{(Request::routeIs('attributes-value.index')?'active':'')}}">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>attributes value list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('attributes-group.create')?'#':route('attributes-group.create'))}}"
                               class="nav-link {{(Request::routeIs('attributes-group.create')?'active':'')}}">
                                <i class="far fa-edit nav-icon"></i>
                                <p>add new attribute</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('attributes-value.create')?'#':route('attributes-value.create'))}}"
                               class="nav-link {{(Request::routeIs('attributes-value.create')?'active':'')}}">
                                <i class="far fa-edit nav-icon"></i>
                                <p>add new attribute value</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endcan
                @can('view brands')
                <li class="nav-item has-treeview {{(Request::routeIs(['brands.index','brands.create'])?'menu-open':'')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Brands
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('brands.index')?'#':route('brands.index'))}}"
                               class="nav-link {{(Request::routeIs('brands.index')?'active':'')}}">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>brands list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('brands.create')?'#':route('brands.create'))}}"
                               class="nav-link {{(Request::routeIs('brands.create')?'active':'')}}">
                                <i class="far fa-edit nav-icon"></i>
                                <p>add new brand</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('view products')
                <li class="nav-item has-treeview {{(Request::routeIs(['products.index','products.create'])?'menu-open':'')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('products.index')?'#':route('products.index'))}}"
                               class="nav-link {{(Request::routeIs('products.index')?'active':'')}}">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>products list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{(Request::routeIs('products.create')?'#':route('products.create'))}}"
                               class="nav-link {{(Request::routeIs('products.create')?'active':'')}}">
                                <i class="far fa-edit nav-icon"></i>
                                <p>add new product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('view slides')
                <li class="nav-item">
                    <a href="{{(Request::routeIs('slides')?'#':route('slides'))}}"
                       class="nav-link {{(Request::routeIs('slides')?'active':'')}}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Slides
                            <span class="right badge badge-secondary">top home page</span>
                        </p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{(Request::routeIs('loginByPhoneToken')?'#':route('loginByPhoneToken'))}}"
                       class="nav-link {{(Request::routeIs('loginByPhoneToken')?'active':'')}}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <p>
                            Login Phone Token List
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
