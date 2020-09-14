
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
                <li class="{{ request()->routeIs('admin.customer.index') || request()->routeIs('admin.customer.create') || request()->routeIs('admin.customer.show_edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.customer.index') }}" class="d-flex">
                        <i class="fas fa-male fa-2x mt-auto mb-auto"></i><div class="mb-auto mt-auto">Customers</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.product.index') || request()->routeIs('admin.item.create') || request()->routeIs('admin.item.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}" class="d-flex">
                        <i class="fas fa-box mt-auto mb-auto"></i><div class="mb-auto mt-auto">Products</div>
                    </a>
                </li>
                <li class="has-sub {{ request()->routeIs('admin.transaction.order.create') || request()->routeIs('admin.transaction.stockIn.index') || request()->routeIs('admin.transaction.stockIn.create') || request()->routeIs('admin.transaction.stockOut.index') || request()->routeIs('admin.transaction.stockRetur.index') || request()->routeIs('admin.transaction.stockIn.show') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-money-bill-wave mt-auto mb-auto"></i><div class="mb-auto mt-auto">Transaction</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="{{ request()->routeIs('admin.transaction.order.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaction.order.create') }}">Sales</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.transaction.stockIn.index') || request()->routeIs('admin.transaction.stockIn.create') || request()->routeIs('admin.transaction.stockIn.show') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaction.stockIn.index') }}">Stock In</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.transaction.stockOut.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaction.stockOut.index') }}">Stock Out</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.transaction.stockRetur.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaction.stockRetur.index') }}">Stock Retur</a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="has-sub {{ request()->routeIs('admin.finance.akumulasi.index') || request()->routeIs('admin.finance.pengeluaran.index') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-chart-line mt-auto mb-auto"></i><div class="mb-auto mt-auto">Finance</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="{{ request()->routeIs('admin.finance.pengeluaran.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.finance.pengeluaran.index') }}">Pengeluaran</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.finance.akumulasi.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.finance.akumulasi.index') }}">Akumulasi</a>
                        </li>
                    </ul>
                </li> --}}
                <li class="has-sub {{ request()->routeIs('admin.report.day.index') || request()->routeIs('admin.report.month.index') || request()->routeIs('admin.report.year.index') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-clipboard-list mt-auto mb-auto"></i><div class="mb-auto mt-auto">Report</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                <li class="{{ request()->routeIs('admin.user.index') || request()->routeIs('admin.user.create') || request()->routeIs('admin.user.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class="d-flex">
                        <i class="fas fa-users mt-auto mb-auto"></i><div class="mt-auto mb-auto">Users</div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>