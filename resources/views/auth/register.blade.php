@extends('layouts.app')

@section('title', 'Գրանցում')

@section('content')
<main class="container">
    <section class="section">
        <div class="row justify-center">
            <div class="col w-50">
                <div class="card card__body">
                    <nav aria-label="Դուք այստեղ եք" class="mb-15">
                        <a href="/" class="link">Գլխավոր</a> / <span>Գրանցում</span>
                    </nav>

                    <h1 class="section-title mb-10">Գրանցում</h1>
                    <p class="text-muted mb-25">Հաշիվը պետք է պատվերների պատմության համար։ Գնել կարելի է նաև առանց դրա։</p>

                    @if($errors->any())
                        <ul style="color: red;" class="mb-20">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('auth.register') }}" method="POST">
                        @csrf
                        <div class="mb-15">
                            <label class="field__label mb-5 block">Անուն</label>
                            <input type="text" name="name" class="input w-100" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-15">
                            <label class="field__label mb-5 block">Էլ․ հասցե</label>
                            <input type="email" name="email" class="input w-100" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-15">
                            <label class="field__label mb-5 block">Գաղտնաբառ (առնվազն 8 նիշ)</label>
                            <input type="password" name="password" class="input w-100" required>
                        </div>

                        <div class="mb-25">
                            <label class="field__label mb-5 block">Կրկնիր գաղտնաբառը</label>
                            <input type="password" name="password_confirmation" class="input w-100" required>
                        </div>

                        <button type="submit" class="btn btn--primary w-100">Ստեղծել հաշիվ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
