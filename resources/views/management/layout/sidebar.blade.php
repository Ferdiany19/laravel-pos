
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('management.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('management.dashboard') }}" class="d-flex">
                        <i class="fas fa-tachometer-alt mt-auto mb-auto"></i><div class="mt-auto mb-auto">Dashboard</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('management.supplier.index') || request()->routeIs('management.supplier.create') || request()->routeIs('management.supplier.show_edit') ? 'active' : '' }}">
                    <a href="{{ route('management.supplier.index') }}" class="d-flex">
                        <i class="fas fa-truck mt-auto mb-auto"></i><div class="mb-auto mt-auto">Suppliers</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('management.product.index') || request()->routeIs('management.item.create') || request()->routeIs('management.item.show') ? 'active' : '' }}">
                    <a href="{{ route('management.product.index') }}" class="d-flex">
                        <i class="fas fa-box mt-auto mb-auto"></i><div class="mb-auto mt-auto">Products</div>
                    </a>
                </li>
                <li class="has-sub {{ request()->routeIs('management.transaction.order.create') || request()->routeIs('management.transaction.stockIn.index') || request()->routeIs('management.transaction.stockIn.create') || request()->routeIs('management.transaction.stockOut.index') || request()->routeIs('management.transaction.stockRetur.index') || request()->routeIs('management.transaction.stockIn.show') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-money-bill-wave mt-auto mb-auto"></i><div class="mb-auto mt-auto">Transaction</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="{{ request()->routeIs('management.transaction.stockIn.index') || request()->routeIs('management.transaction.stockIn.create') || request()->routeIs('management.transaction.stockIn.show') ? 'active' : '' }}">
                            <a href="{{ route('management.transaction.stockIn.index') }}">Stock In</a>
                        </li>
                        <li class="{{ request()->routeIs('management.transaction.stockRetur.index') ? 'active' : '' }}">
                            <a href="{{ route('management.transaction.stockRetur.index') }}">Stock Retur</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub {{ request()->routeIs('management.finance.akumulasi.index') || request()->routeIs('management.finance.pengeluaran.index') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-chart-line mt-auto mb-auto"></i><div class="mb-auto mt-auto">Finance</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="{{ request()->routeIs('management.finance.pengeluaran.index') ? 'active' : '' }}">
                            <a href="{{ route('management.finance.pengeluaran.index') }}">Pengeluaran</a>
                        </li>
                        <li class="{{ request()->routeIs('management.finance.akumulasi.index') ? 'active' : '' }}">
                            <a href="{{ route('management.finance.akumulasi.index') }}">Akumulasi</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub {{ request()->routeIs('management.report.day.index') || request()->routeIs('management.report.month.index') || request()->routeIs('management.report.year.index') ? 'active' : '' }}">
                    <a class="js-arrow d-flex" href="#">
                        <i class="fas fa-clipboard-list mt-auto mb-auto"></i><div class="mb-auto mt-auto">Report</div><i class="fas fa-arrow-right ml-auto mt-auto mb-auto rotate-0"></i>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="{{ request()->routeIs('management.report.day.index') ? 'active' : '' }}">
                            <a href="{{ route('management.report.day.index') }}">Day</a>
                        </li>
                        <li class="{{ request()->routeIs('management.report.month.index') ? 'active' : '' }}">
                            <a href="{{ route('management.report.month.index') }}">Month</a>
                        </li>
                        <li class="{{ request()->routeIs('management.report.year.index') ? 'active' : '' }}">
                            <a href="{{ route('management.report.year.index') }}">Year</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>