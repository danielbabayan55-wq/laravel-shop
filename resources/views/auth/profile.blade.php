@section('content')
<main class="container">
    <section class="section">
        <div class="row justify-center">
            <div class="col w-50">
                <div class="card card__body">
                    <nav aria-label="Դուք այստեղ եք" class="mb-15">
                        <a href="/" class="link">Գլխավոր</a> / <span>Իմ էջը</span>
                    </nav>

                    <h1 class="section-title mb-20">Իմ էջը</h1>

                    @if(session('success'))
                        <p class="text-success mb-15">{{ session('success') }}</p>
                    @endif

                    @if($errors->any())
                        <ul style="color: red;" class="mb-20">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-15">
                            <label class="field__label mb-5 block">Անուն</label>
                            <input type="text" name="name" class="input w-100" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-25">
                            <label class="field__label mb-5 block">Էլ․ փոստ</label>
                            <input type="email" name="email" class="input w-100" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn--primary w-100">Թարմացնել տվյալները</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
