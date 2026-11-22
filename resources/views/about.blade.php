@extends('layouts.app')

@section('title', 'Մեր մասին')

@section('content')
<main class="container">
    <section class="section">
        <h1>{{ $title ?? 'Մեր մասին' }}</h1>

        @if(session('feedback'))
            <p style="color: green;">Спасибо! Ваш отзыв отправлен на модерацию.</p>
        @elseif(session('deleted'))
            <p style="color: orange;">Отзыв удален.</p>
        @elseif(session('approved'))
            <p style="color: green;">Отзыв одобрен и опубликован.</p>
        @elseif($errors->any())
            <p style="color: red;">Пожалуйста, заполните все поля формы.</p>
        @endif

        <section>
            @forelse($items ?? [] as $item)
                <div class="about-block">
                    <h2>{{ $item->name ?? $item['name'] ?? '' }}</h2>
                    <p>{{ $item->description ?? $item['description'] ?? '' }}</p>
                </div>
            @empty
                <div class="about-block">
                    <h2>PROJECT SITY</h2>
                    <p>Բարի գալուստ մեր առցանց խանութ։ Մենք առաջարկում ենք որակյալ ապրանքներ մատչելի գներով։</p>
                </div>
            @endforelse
        </section>

        <hr>

        <section>
            <h3>Оставить отзыв</h3>
            <form action="/about/feedback" method="POST">
                @csrf

                <div>
                    <label>Ваше имя:</label><br>
                    <input type="text" name="name" class="input" required>
                </div>
                <br>
                <div>
                    <label>Сообщение:</label><br>
                    <textarea name="message" rows="4" class="input" required></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn--primary">Отправить отзыв</button>
            </form>
        </section>

        <hr>

        <section>
            <h3>Отзывы клиентов</h3>
            @if(empty($feedback) || count($feedback) === 0)
                <p>Пока нет ни одного отзыва.</p>
            @else
                @foreach($feedback as $fb)
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <strong>{{ $fb->name ?? $fb['name'] }}</strong>
                        <p>{{ $fb->message ?? $fb['message'] }}</p>

                        @if(auth()->check() && auth()->user()->role->name === 'Admin')
                            <div style="display: flex; gap: 10px;">
                                <form action="/about/approve" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $fb->id ?? $fb['id'] }}">
                                    <button type="submit" class="btn btn--sm">Одобрить</button>
                                </form>

                                <form action="/about/delete" method="POST" onsubmit="return confirm('Удалить этот отзыв?');">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $fb->id ?? $fb['id'] }}">
                                    <button type="submit" class="btn btn--sm">Удалить</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </section>
    </section>
</main>
@endsection
