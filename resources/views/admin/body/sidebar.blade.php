<?php use Illuminate\Support\Facades\Auth; ?>
<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <?php
                if(Auth::user()->admin_profile==1) : ?>

                <li>
                    <a href="{{route('suppliers.list')}}">
                        <i class="ri-barcode-line"></i>
                        <span>Suppliers</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('category.list')}}">
                        <i class="ri-stack-line"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li><a href="{{route('product.list')}}">
                        <i class="ri-drop-line"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('product.withdrawList')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Replenish</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('user.list')}}" class="waves-effect">
                        <i class="ri-user-line"></i>
                        <span>Administrate Users</span>
                    </a>
                </li>
                <?php else : ?>
                <?php endif; ?>

                <li>
                    <a href="{{route('invoice.all')}}">
                        <i class="ri-shopping-bag-line"></i>
                        <span>Invoices</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
