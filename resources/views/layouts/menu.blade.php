<div class="container">
    <div id="under-header-menu">
        <ul>
            @if(Auth::guest() || Auth::user()->can('seeServices', \App\Models\User::class))
                <li>
                    <a style="color:#848484; font-stretch: expanded; font-size: 18px; font-weight: bolder" href="{{ route('menu.services.list') }}">Услуги</a>
                </li>
            @endif
            <li>
                <a style="color:#848484; font-stretch: expanded; font-size: 18px; font-weight: bolder" href="{{ route('main') }}">О нас</a>
            </li>
        </ul>
    </div>
</div>
