<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
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
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li class="{{ request()->routeIs('kasir.transaction.order.create') ? 'active' : '' }}">
                            <a href="{{ route('kasir.transaction.order.create') }}">Sales</a>
                        </li>
                        <li class="{{ request()->routeIs('kasir.transaction.stockOut.index') ? 'active' : '' }}">
                            <a href="{{ route('kasir.transaction.stockOut.index') }}">Stock Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>