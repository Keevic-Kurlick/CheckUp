<header>
    <nav class="navbar navbar-expand-md d-block navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="col-9">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-4">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('storage/logos/Logo.svg') }}" alt="CheckUp" height="65">
                        </a>
                    </div>
                    <div class="col-12 col-md-7 logo-text-block">
                        <span class = "logo-text">Оформление медицинских справок</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="nav justify-content-end">
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest

                            @if (Route::has('login'))
                                <li class="nav-item authentication-links">
                                    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Войти') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item authentication-links">
                                    <a class="btn btn-primary" id = "reg-btn" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown authentication-links-mobile">
                                <a class="dropdown-toggle navbar-dark btn btn-success navbar-toggler" href="#" id="dropdownHeader" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="navbar-toggler-icon"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownHeader">
                                    @if (Route::has('login'))
                                        <a class="dropdown-item" href="{{ route('login') }}">{{ __('Войти') }}</a>
                                    @endif
                                    @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                    @endif
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a style = "font-size: 16px; font-weight: bolder" class="nav-link dropdown-toggle"
                                   href="#" id="navbarDropdown"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="{{ asset('storage/logos/home.svg') }}" alt="Кабинет" height="35">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @can('hasAccessToAdminPanel', \App\Models\User::class)
                                        <li><a class="dropdown-item" href="{{ route('admin.index') }}">Админ панель</a></li>
                                    @endcan

                                    @can('canOrder', \App\Models\User::class)
                                        <li><a class="dropdown-item" href="{{ route('profile.orders.list') }}">Заказы</a></li>
                                        <li><a class="dropdown-item" href="{{ route('profile.documents') }}">Документы</a></li>
                                    @endcan
                                    @can('hasAccessToDoctorOrders', \App\Models\User::class)
                                            <li><a class="dropdown-item" href="{{ route('orders.index') }}">Заказы</a></li>
                                    @endcan
                                    <li><hr class="dropdown-divider"></li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
