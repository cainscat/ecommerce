<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            @php
                $getUnreadNotification = App\Models\NotificationModel::getUnreadNotification();
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">{{ $getUnreadNotification->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">
                        {{ $getUnreadNotification->count() }} Notifications
                    </span>

                    @foreach($getUnreadNotification as $noti)
                        <div class="dropdown-divider"></div>
                        <a href="{{ $noti->url }}?noti_id={{ $noti->id }}" class="dropdown-item">
                            <div>{{ $noti->message }}</div>
                            <div class="text-secondary fs-7">{{ date('d-m-Y h:i A', strtotime($noti->created_at)) }}</div>
                        </a>
                    @endforeach

                    <div class="dropdown-divider"></div>
                    <a href="{{ url('admin/notification') }}" class="dropdown-item dropdown-footer">
                        See All Notifications
                    </a>

                </div>
            </li>
        </ul>
    </div>
</nav>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <div class="brand-link">
            <span class="brand-text fw-light" style="margin-left: 0px;">
                {{ Auth::user()->name }}
            </span>
        </div>
    </div>
    <div class="sidebar-wrapper">


        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Admin</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/customer/list') }}" class="nav-link @if(Request::segment(2) == 'customer') active @endif">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>Customer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/orders/list') }}" class="nav-link @if(Request::segment(2) == 'orders') active @endif">
                        <i class="nav-icon bi bi-cart-dash-fill"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/category/list') }}" class="nav-link @if(Request::segment(2) == 'category') active @endif">
                        <i class="nav-icon bi bi-card-list"></i>
                        <p>Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/sub_category/list') }}" class="nav-link @if(Request::segment(2) == 'sub_category') active @endif">
                        <i class="nav-icon bi bi-list-columns-reverse"></i>
                        <p>Sub Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/brand/list') }}" class="nav-link @if(Request::segment(2) == 'brand') active @endif">
                        <i class="nav-icon bi bi-journal"></i>
                        <p>Brand</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/color/list') }}" class="nav-link @if(Request::segment(2) == 'color') active @endif">
                        <i class="nav-icon bi bi-palette-fill"></i>
                        <p>Color</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/product/list') }}" class="nav-link @if(Request::segment(2) == 'product') active @endif">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Product</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/discount_code/list') }}" class="nav-link @if(Request::segment(2) == 'discount_code') active @endif">
                        <i class="nav-icon bi bi-ticket-perforated-fill"></i>
                        <p>Discount Code</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/shipping_charge/list') }}" class="nav-link @if(Request::segment(2) == 'shipping_charge') active @endif">
                        <i class="nav-icon bi bi-ev-front-fill"></i>
                        <p>Shipping Charge</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/slider/list') }}" class="nav-link @if(Request::segment(2) == 'slider') active @endif">
                        <i class="nav-icon bi bi-file-slides-fill"></i>
                        <p>Slider</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/partner/list') }}" class="nav-link @if(Request::segment(2) == 'partner') active @endif">
                        <i class="nav-icon bi bi-globe2"></i>
                        <p>Partner Logo</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/contact_us') }}" class="nav-link @if(Request::segment(2) == 'contact_us') active @endif">
                        <i class="nav-icon bi bi-envelope-at-fill"></i>
                        <p>Contact Us</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/page/list') }}" class="nav-link @if(Request::segment(2) == 'page') active @endif">
                        <i class="nav-icon bi bi-journal-album"></i>
                        <p>Page</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/blog_category/list') }}" class="nav-link @if(Request::segment(2) == 'blog_category') active @endif">
                        <i class="nav-icon bi bi-bootstrap-fill"></i>
                        <p>Blog Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/blog/list') }}" class="nav-link @if(Request::segment(2) == 'blog') active @endif">
                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>Blog</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/system-setting') }}" class="nav-link @if(Request::segment(2) == 'system-setting') active @endif">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>System Setting</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/payment-setting') }}" class="nav-link @if(Request::segment(2) == 'payment-setting') active @endif">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Payment Setting</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/home-setting') }}" class="nav-link @if(Request::segment(2) == 'home-setting') active @endif">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Home Setting</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/smtp-setting') }}" class="nav-link @if(Request::segment(2) == 'smtp-setting') active @endif">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>SMTP Setting</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
