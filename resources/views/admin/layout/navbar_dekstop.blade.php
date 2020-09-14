<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="form-header">
                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                    <button class="au-btn--submit" type="button">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
                <div class="header-button">
                    <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-comment-more"></i>
                            {{-- <span class="quantity">1</span> --}}
                            <div class="mess-dropdown js-dropdown">
                                <div class="mess__title">
                                    {{-- <p>You have 2 news message</p> --}}
                                    <p>You have not news message</p>
                                </div>
                                {{-- <div class="mess__item">
                                    <div class="image img-cir img-40">
                                        <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                    </div>
                                    <div class="content">
                                        <h6>Michelle Moreno</h6>
                                        <p>Have sent a photo</p>
                                        <span class="time">3 min ago</span>
                                    </div>
                                </div> --}}
                                {{-- <div class="mess__item">
                                    <div class="image img-cir img-40">
                                        <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                    </div>
                                    <div class="content">
                                        <h6>Diane Myers</h6>
                                        <p>You are now connected on message</p>
                                        <span class="time">Yesterday</span>
                                    </div>
                                </div> --}}
                                <div class="mess__footer">
                                    {{-- <a href="#">View all messages</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-email"></i>
                            {{-- <span class="quantity">1</span> --}}
                            <div class="email-dropdown js-dropdown">
                                <div class="email__title">
                                    <p>You have not New Emails</p>
                                </div>
                                {{-- <div class="email__item">
                                    <div class="image img-cir img-40">
                                        <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                    </div>
                                    <div class="content">
                                        <p>Meeting about new dashboard...</p>
                                        <span>Cynthia Harvey, 3 min ago</span>
                                    </div>
                                </div>
                                <div class="email__item">
                                    <div class="image img-cir img-40">
                                        <img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                    </div>
                                    <div class="content">
                                        <p>Meeting about new dashboard...</p>
                                        <span>Cynthia Harvey, Yesterday</span>
                                    </div>
                                </div>
                                <div class="email__item">
                                    <div class="image img-cir img-40">
                                        <img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                    </div>
                                    <div class="content">
                                        <p>Meeting about new dashboard...</p>
                                        <span>Cynthia Harvey, April 12,,2018</span>
                                    </div>
                                </div> --}}
                                <div class="email__footer">
                                    {{-- <a href="#">See all emails</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            @if (count(Session::get('stock_return_proses')) > '0' || count(Session::get('barang_expire')) > '0')
                            <span class="quantity">{{ count(Session::get('stock_return_proses')) + count(Session::get('barang_expire')) }}</span>
                            @endif
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have {{ count(Session::get('stock_return_proses')) + count(Session::get('barang_expire')) > '0' ? count(Session::get('stock_return_proses')) + count(Session::get('barang_expire')) : 'not' }} Notifications</p>
                                </div>
                                @forelse (Session::get('barang_expire') as $barang_expire)
                                <a href="{{ route('admin.transaction.stockIn.index') }}#item{{ $barang_expire->id }}" class="{{ $barang_expire->bg_alert }}">
                                    <div class="notifi__item">
                                        <div class="bg-c3 img-cir img-40">
                                            <i class="zmdi zmdi-file-text"></i>
                                        </div>
                                        <div class="content">
                                            <p class="texts-white">Kamu Mempunyai Barang {{ $barang_expire->items()->first()->name }} Stock {{ $barang_expire->stock }} yang {{ $barang_expire->message }}</p>
                                            <span class="date texts-white">{{ $barang_expire->created_at->format('Y F d H:i') }}</span>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                    
                                @endforelse
                                @forelse (Session::get('stock_return_proses') as $return)
                                <a href="{{ route('admin.transaction.stockRetur.index') }}">
                                    <div class="notifi__item">
                                        <div class="bg-c3 img-cir img-40">
                                            <i class="zmdi zmdi-file-text"></i>
                                        </div>
                                        <div class="content">
                                            <p>Kamu Mempunyai Stock Return Terbaru</p>
                                            <span class="date">{{ $return->created_at->format('Y F d H:i') }}</span>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                    
                                @endforelse
                                <div class="notifi__footer">
                                    {!! count(Session::get('stock_return_proses')) > '3' ? '<a href="#">All notifications</a>' : ''!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ asset('images/icon/avatar-01.jpg') }}" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ auth()->user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ auth()->user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline-block w-100">
                                        @csrf
                                        <button type="submit" class="btn w-100 h-100 text-left"><i class="zmdi zmdi-power"></i>Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>