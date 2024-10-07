<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Men's Shirts -> {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <img class="product-img prod-detail" src="{{ config('app.url').Storage::url($product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="col-6">
                            <h3 class="prd-title">{{ $product->name }}</h3>
                            <p class="prd-desc">{{ $product->description }}</p>
                            <p class="prd-price">Price: ${{ $product->price }}</p>
                            <form id="payment-form">
                                @csrf
                                <div class="form-group">
                                    <label for="card-element">Credit or debit card</label>
                                    <div id="card-element"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                                <p class="price-desc">Payable :  ${{ $product->price }}</p>
                                <button type="submit" class="btn btn-success">Buy Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const response = await fetch('/payment-intent/{{ $product->id }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });

            const { client_secret } = await response.json();

            const { error, paymentIntent } = await stripe.confirmCardPayment(client_secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: "{{ auth()->user()->name }}",
                    },
                }
            });

            if (error) {
                console.log(error.message);
            } else {
                if (paymentIntent.status === 'succeeded') {
                    window.location.href = '{{ route("payment.success") }}';
                }
            }
        });
    </script>
</x-app-layout>