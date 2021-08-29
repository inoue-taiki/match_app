<header>
  <!-- ヘッダー部分 -->
  <div id="top-logo">
    <p>EXAMPLE LOGO</p>
  </div>
  ヘッダー
  <ul>
    <li class="nav-item"><a href="{{ route('top.index') }}">トップ</a></li>
    @auth
    <li class="nav-item"><a href="{{ route('logout') }}">ログアウト</a></li>
    @else
    <li class="nav-item"><a href="{{ route('login') }}">ログイン</a></li>
    <li class="nav-item"><a href="{{ route('register') }}">新規登録</a></li>
    @endauth
  </ul>
</header>