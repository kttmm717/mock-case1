<header class="header">
    <div class="header__container">
        <img src="{{asset('img/coachtech-logo.svg')}}" alt="">
        @if(!in_array(Route::currentRouteName(), ['register', 'login', 'verification.notice']))
        <form class="search-form" action="">
            @csrf
            <input type="text" name="search" placeholder="何をお探しですか？">
            <button><img src="{{asset('img/search_icon.jpeg')}}" alt="検索画像"></button>
        </form>
        @endif
        <nav>
            <ul class="header__ul">
                @if(Auth::check())
                    <form action="/logout" method="post">
                        @csrf
                        <li>ログアウト</li>
                    </form>
                    <li><a href="/mypage">マイページ</a></li>
                    <li><a href="/sell">出品</a></li>
                @else
                    <li><a href="/login">ログイン</a></li>
                    <li><a href="/register">会員登録</a></li>
                @endif
            </ul>
        </nav>
</header>