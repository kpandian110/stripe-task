<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Men's Shirts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="img-box">
                                <img class="product-img" src="{{ config('app.url').Storage::url($product->image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="prd-info row">
                                <div class="col-8">
                                    <h3 class="title">{{ $product->name }}</h3>
                                    <p class="price">Price: ${{ $product->price }}</p>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('products.buy', $product->id) }}" class="btn btn-sm btn-success">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
