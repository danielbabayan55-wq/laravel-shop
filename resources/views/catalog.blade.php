@extends('layouts.app')

@section('content')
<main class="container">
    <h1>Կատալոգ</h1>

    <section id="products">
        <div class="row">
            <aside class="col w-25">
                <form method="get" action="/catalog" class="card card__body">
                    <h3 class="mb-15">Կատեգորիա</h3>
                    <div class="mb-20">
                        <label class="block mb-5">
                            <input type="radio" name="category" value="" {{ empty(request('category')) ? 'checked' : '' }}> Բոլորը
                        </label>
                        @foreach($categories as $cat)
                            <label class="block mb-5">
                                <input type="radio" name="category" value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'checked' : '' }}>
                                {{ $cat->name }}
                            </label>
                        @endforeach
                    </div>

                    <h3 class="mb-15">Գին, ֏</h3>
                    <div class="row gap-10 mb-20">
                        <div class="col w-50">
                            <label class="field__label">Սկսած</label>
                            <input type="number" name="min_price" class="input" placeholder="0" value="{{ request('min_price') }}">
                        </div>
                        <div class="col w-50">
                            <label class="field__label">Մինչև</label>
                            <input type="number" name="max_price" class="input" placeholder="600000" value="{{ request('max_price') }}">
                        </div>
                    </div>

                    <h3 class="mb-15">Ցուցադրել</h3>
                    <div class="mb-20">
                        <label class="block mb-5">
                            <input type="radio" name="stock" value="" {{ empty(request('stock')) ? 'checked' : '' }}> Բոլորը
                        </label>
                        <label class="block mb-5">
                            <input type="radio" name="stock" value="in" {{ request('stock') === 'in' ? 'checked' : '' }}> Միայն առկաները
                        </label>
                        <label class="block mb-5">
                            <input type="radio" name="stock" value="sale" {{ request('stock') === 'sale' ? 'checked' : '' }}> Միայն զեղչվածները
                        </label>
                    </div>

                    <div class="row gap-10">
                        <button type="submit" class="btn btn-primary">Կիրառել</button>
                        <a href="/catalog" class="btn">Մաքրել</a>
                    </div>
                </form>
            </aside>

            <div class="col w-75">
                @if($products->isNotEmpty())
                    <div class="grid-auto gap-20 mb-30">
                        @foreach($products as $p)
                            <article class="card">
                                @if($p->discount > 0)
                                    <span class="card__badge">{{ $p->discount }}%</span>
                                @endif

                                <picture class="card__media ratio-3-2">
                                    <img class="img-cover"
                                         src="{{ $p->image ? asset('storage/' . $p->image) : asset('images/no-image.png') }}"
                                         alt="{{ $p->name }}" width="600" height="400" loading="lazy">
                                </picture>

                                <div class="card__body">
                                    <h3>{{ $p->name }}</h3>
                                    <p class="card__meta">{{ $p->description }}</p>

                                    @if($p->stock > 0)
                                        <p class="card__stock text-success">Մնացել է {{ $p->stock }} հատ</p>
                                    @else
                                        <p class="card__stock text-danger">Առկա չէ</p>
                                    @endif

                                    <div class="card__footer">
                                        <p class="card__price">
                                            @if($p->discount > 0)
                                                @php $finalPrice = round($p->price * (1 - $p->discount / 100)); @endphp
                                                {{ number_format($finalPrice, 0, '.', ' ') }} ֏
                                                <br><del class="text-muted">{{ number_format($p->price, 0, '.', ' ') }} ֏</del>
                                            @else
                                                {{ number_format($p->price, 0, '.', ' ') }} ֏
                                            @endif
                                        </p>

                                        <form method="post" action="/cart/add">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $p->id }}">
                                            <input type="hidden" name="back" value="/catalog">
                                            <button type="submit" class="btn btn--primary btn--sm"><span>Գնել</span></button>
                                        </form>

                                        @php $inWishlist = in_array($p->id, session('wishlist', [])); @endphp
                                        <form method="post" action="/wishlist/toggle" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                            <button type="submit" class="btn btn--sm" title="Նախընտրածներ">
                                                {{ $inWishlist ? '❤️' : '🤍' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p>Ապրանքներ չեն գտնվել:</p>
                @endif
            </div>
        </div>
    </section>
</main>

@endsection