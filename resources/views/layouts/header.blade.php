<header>
    <nav class="navbar navbar-expand-md d-block navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="col-9">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-4">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('storage/Logos/Logo.svg') }}" alt="CheckUp" height="65">
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
                                    <a class="btn btn-success" href="{{ route('login') }}">{{ __('Войти') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item authentication-links">
                                    <a class="btn btn-success" id = "reg-btn" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Заказы</a></li>
                                    <li><a class="dropdown-item" href="#">Документы</a></li>
                                    <li><a class="dropdown-item" href="#">Настройка</a></li>
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