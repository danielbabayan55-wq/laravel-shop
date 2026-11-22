@extends('layouts.app')

@section('title', 'Ապրանքի խմբագրում')

@section('content')

<main>
    <h2>Խմբագրել՝ {{ $product->name }}</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p><input type="text" name="name" value="{{ old('name', $product->name) }}"></p>
        <p><input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"></p>
        <p><textarea name="description">{{ old('description', $product->description) }}</textarea></p>
        <p><input type="file" name="image"></p>
        <button type="submit">Save Changes</button>
    </form>
</main>
@endsection