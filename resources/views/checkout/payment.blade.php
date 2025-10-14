@extends('template')

@section('content')
<div class="max-w-lg mx-auto py-10 px-10">
    <h2 class="text-2xl font-semibold mb-6">Payment</h2>

    <div id="payment-element"></div>
    <button id="submit" class="mt-6 bg-black text-white px-6 py-2 rounded hover:bg-gray-700 w-full">
        Pay ${{ number_format($total, 2) }}
    </button>
    <div id="error-message" class="text-red-500 mt-2"></div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe("{{ config('services.stripe.key') }}");
const elements = stripe.elements({ clientSecret: "{{ $clientSecret }}" });
const paymentElement = elements.create("payment");
paymentElement.mount("#payment-element");

document.getElementById("submit").addEventListener("click", async (e) => {
    e.preventDefault();

    const { error, paymentIntent } = await stripe.confirmPayment({
        elements,
        confirmParams: {},
        redirect: 'if_required'
    });

    if (error) {
        document.getElementById("error-message").textContent = error.message;
    } else if (paymentIntent && paymentIntent.status === "succeeded") {
        await fetch("{{ route('checkout.confirm') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ payment_intent_id: paymentIntent.id })
        });

        window.location.href = "{{ route('orders.index') }}";
    }
});
</script>
@endsection
