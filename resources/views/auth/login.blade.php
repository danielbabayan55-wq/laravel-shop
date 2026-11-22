@extends('layouts.app')

@section('title', 'Մուտք')

@section('content')
<main class="container">
    <section class="section">
        <div class="row justify-center">
            <div class="col w-50">
                <div class="card card__body">
                    <nav aria-label="Դուք այստեղ եք" class="mb-15">
                        <a href="/" class="link">Գլխավոր</a> / <span>Մուտք</span>
                    </nav>

                    <h1 class="section-title mb-20">Մուտք</h1>

                    @if($errors->any())
                        <ul style="color: red;" class="mb-20">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <div class="mb-15">
                            <label class="field__label mb-5 block">Էլ․ հասցե</label>
                            <input type="email" name="email" class="input w-100" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-25">
                            <label class="field__label mb-5 block">Գաղտնաբառ</label>
                            <input type="password" name="password" class="input w-100" required>
                        </div>

                        <button type="submit" class="btn btn--primary w-100">Մուտք գործել</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
