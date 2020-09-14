
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            {{-- <img src="{{ asset('images/icon/logo.png') }}" alt="Cool Admin" /> --}}
            <h1>Toko Jaya Abadi</h1>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('kasir.dashboard') }}" class="d-flex">
                        <i class="fas fa-tachometer-alt mt-auto mb-auto"></i><div class="mt-auto mb-auto">Dashboard</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('kasir.customer.index') || request()->routeIs('kasir.customer.create') || request()->routeIs('kasir.customer.show_edit') ? 'active' : '' }}">
                    <a href="{{ route('kasir.customer.index') }}" class="d-flex">
                        <i class="fas fa-male fa-2x mt-auto mb-auto"></i><div class="mb-auto mt-auto">Customers</div>
                    </a>
                </li>
                <li class="has-sub {{ request()->routeIs('kasir.transaction.order.create') || request()->routeIs('kasir.transaction.stockIn.index') || request()->routeIs('kasir.transaction.stockIn.create') || request()->routeIs('kasir.transaction.stockOut.index') || request()->routeIs('kasir.transaction.stockRetur.index') || request()->routeIs('kasir.transaction.stockIn.show') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-money-bill-wave mt-auto mb-auto"></i><div class="mb-auto mt-auto">Transaction</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="{{ request()->routeIs('kasir.transaction.order.create') ? 'active' : '' }}">
                            <a href="{{ route('kasir.transaction.order.create') }}">Sales</a>
                        </li>
                        <li class="{{ request()->routeIs('kasir.transaction.stockOut.index') ? 'active' : '' }}">
                            <a href="{{ route('kasir.transaction.stockOut.index') }}">Stock Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>