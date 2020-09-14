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
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex">
                        <i class="fas fa-tachometer-alt mt-auto mb-auto"></i><div class="mt-auto mb-auto">Dashboard</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.supplier.index') || request()->routeIs('admin.supplier.create') || request()->routeIs('admin.supplier.show_edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.supplier.index') }}" class="d-flex">
                        <i class="fas fa-truck mt-auto mb-auto"></i><div class="mb-auto mt-auto">Suppliers</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.product.index') || request()->routeIs('admin.item.create') || request()->routeIs('admin.item.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}" class="d-flex">
                        <i class="fas fa-box mt-auto mb-auto"></i><div class="mb-auto mt-auto">Product</div>
                    </a>
                </li>
                <li class="has-sub {{ request()->routeIs('admin.transaction.order.create') || request()->routeIs('admin.transaction.stockIn.index') || request()->routeIs('admin.transaction.stockIn.create') || request()->routeIs('admin.transaction.stockOut.index') || request()->routeIs('admin.transaction.stockRetur.index') || request()->routeIs('admin.transaction.stockIn.show') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-money-bill-wave mt-auto mb-auto"></i><div class="mb-auto mt-auto">Transaction</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li class="{{ request()->routeIs('admin.transaction.stockIn.index') || request()->routeIs('admin.transaction.stockIn.create') || request()->routeIs('admin.transaction.stockIn.show') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaction.stockIn.index') }}">Stock In</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.transaction.stockRetur.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaction.stockRetur.index') }}">Stock Retur</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub {{ request()->routeIs('admin.finance.akumulasi.index') || request()->routeIs('admin.finance.pengeluaran.index') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-chart-line mt-auto mb-auto"></i><div class="mb-auto mt-auto">Finance</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li class="{{ request()->routeIs('admin.finance.pengeluaran.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.finance.pengeluaran.index') }}">Pengeluaran</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.finance.akumulasi.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.finance.akumulasi.index') }}">Akumulasi</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub {{ request()->routeIs('admin.report.day.index') || request()->routeIs('admin.report.month.index') || request()->routeIs('admin.report.year.index') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-clipboard-list mt-auto mb-auto"></i><div class="mb-auto mt-auto">Report</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li class="{{ request()->routeIs('admin.report.day.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.day.index') }}">Day</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.report.month.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.month.index') }}">Month</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.report.year.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.year.index') }}">Year</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>