@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col w-100">
                <h1 class="section-title mb-30">Նախընտրածներ</h1>

                @if($products->isEmpty())
                    <p>Ձեր նախընտրածների ցանկը դատարկ է։ <a href="/catalog" class="btn btn-primary btn-sm">Անցնել կատալոգ</a></p>
                @else
                    <form method="post" action="/wishlist/clear" class="mb-30">
                        @csrf
                        <button type="submit" class="btn btn-sm">Մաքրել ցանկը</button>
                    </form>

                    <div class="grid-auto gap-20 mb-30">
                        @foreach($products as $p)
                            <article class="card">
                                <picture class="card__media ratio-3-2">
                                    <img class="img cover"
                                         src="{{ $p->image ? asset('storage/' . $p->image) : asset('images/no-image.png') }}"
                                         alt="{{ $p->name }}" loading="lazy">
                                </picture>

                                <div class="card__body">
                                    <h3>{{ $p->name }}</h3>
                                </div>

                                <div class="card__footer">
                                    <p class="card__price">
                                        @php
                                            $finalPrice = $p->discount > 0 ? round($p->price * (1 - $p->discount / 100)) : $p->price;
                                        @endphp
                                        {{ number_format($finalPrice, 0, '.', ' ') }} ֏
                                    </p>

                                    <form method="post" action="/cart/add">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm"><span>Գնել</span></button>
                                    </form>

                                    <form method="post" action="/wishlist/toggle">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                                        <button type="submit" class="btn btn-sm" title="Հեռացնել">❌</button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
