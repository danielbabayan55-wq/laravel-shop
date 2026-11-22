<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT SITY</title>
    <meta name="description" content="5000+ ապրանք, անվճար առաքում Երևանում, 2 տարվա երաշխիք">

    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Armenian:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    <a href="#main" class="skip-link">Անցնել բովանդակությանը</a>

    <header class="header">
        <input type="checkbox" id="nav" class="nav-toggle">

        <div class="row align-center justify-between">
            <div class="col">
                <a href="/" class="logo">PROJECT SITY</a>
            </div>

            <div class="col">
                <label for="nav" class="burger">
                    <span></span><span></span><span></span>
                    <span class="visually-hidden">Մենյու</span>
                </label>

                <nav aria-label="Գլխավոր մենյու">
                    <ul class="menu flex align-center gap-10">
                        <li><a href="{{ route('home') }}">Գլխավոր</a></li>
                        <li class="has-sub">
                            <a href="/catalog">Կատալոգ <span aria-hidden="true">▾</span></a>
                            <ul class="submenu">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="/catalog?category={{ $category->id }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/contact">Կապ</a></li>
                        <li><a href="/news">Նորություններ</a></li>
                        <li><a href="{{ route('about') }}">Մեր մասին</a></li>
                        <li>
                            <a href="/wishlist">
                                <span style="color: red;">♥</span> Նախընտրածներ ({{ count(session('wishlist', [])) }})
                            </a>
                        </li>

                        @if(auth()->check() && auth()->user()->role->name === 'Admin')
                            <li><a href="{{ route('products.index') }}">Կառավարման վահանակ</a></li>
                        @elseif(auth()->check())
                            <li><a href="{{ route('profile') }}">Իմ էջը</a></li>
                        @else
                            <a href="/login">Մուտք</a>
                            <a href="/register">Գրանցում</a>
                        @endif

                        <li>
                            <a href="/cart" class="btn btn--primary btn--sm">
                                Զամբյուղ <span class="count">{{ array_sum(session('cart', [])) }}</span><span
                                    class="visually-hidden"> ապրանք</span>
                            </a>
                        </li>

                        @auth
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn">Ելք</button>
                                </form>
                            </li>
                        @endauth
                    </ul>

                </nav>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="row flex-wrap">
            <div class="col w-40 w-md-100">
                <p class="logo mb-10"><a href="/"></a></p>
                <p>Ուսումնական նախագիծ</p>
            </div>

            <div class="col w-25 w-md-50 w-sm-100">
                <h2 class="footer__title">Բաժիններ</h2>
                <nav aria-label="Ստորին մենյու">
                    <ul>
                        <li><a href="/catalog.php">Կատալոգ</a></li>
                        <li><a href="/cart.php">Զամբյուղ</a></li>
                        <li><a href="/checkout.php">Պատվերի ձևակերպում</a></li>
                        <li><a href="/contact.php">Կապ</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col w-25 w-md-50 w-sm-100" id="contact">
                <h2 class="footer__title">Կապ</h2>
                <ul>
                    <li>Երևան, Աբովյան 1</li>
                    <li><a href="tel:+37410000000">+374 10 00 00 00</a></li>
                    <li><a href="mailto:info@technomarket.example">info@projectsity.example</a></li>
                </ul>
            </div>
        </div>

        <div class="row flex-wrap justify-between footer__bottom">
            <div class="col">© 2026 Projectsity</div>
            <div class="col">PHP + MySQL</div>
        </div>
    </footer>

</body>

</html>