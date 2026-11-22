@extends('layouts.app')

@section('title', 'Ավելացնել ապրանք')

@section('content')
    <main>
        <h2>Ավելացնել ապրանք</h2>

        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p><input type="text" name="name" placeholder="Անվանում" value="{{ old('name') }}"></p>
            <p><input type="number" name="price" placeholder="Գին" value="{{ old('price') }}" step="0.01"></p>
            <p><textarea name="description" placeholder="Նկարագրություն">{{ old('description') }}</textarea></p>
            <p><input type="file" name="image"></p>
            <p><button type="submit">Ավելացնել</button></p>
        </form>
    </main>
@endsection