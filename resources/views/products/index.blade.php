@extends('layouts.app')

@section('title', 'Ապրանքներ')

@section('content')
    @if(auth()->check() && auth()->user()->role->name === 'Admin')
        <a href="{{ route('products.create') }}">+ Ավելացնել ապրանք</a>
    @endif
    <main>
        <h2>Ապրանքների ցանկ</h2>
        <hr>

        @foreach($products as $product)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3>{{ $product->name }} — {{ $product->price }} ֏</h3>
                <p>{{ $product->description }}</p>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="150" alt="{{ $product->name }}">
                @endif

                @if(auth()->check() && auth()->user()->role->name === 'Admin')
                    <div style="margin-top: 10px;">
                        <a href="{{ route('products.edit', $product) }}">Խմբագրել</a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Ջնջե՞լ ապրանքը')">Ջնջել</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </main>
@endsection