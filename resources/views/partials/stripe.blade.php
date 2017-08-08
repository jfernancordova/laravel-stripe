<form action="{{route('subscribe')}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <script
            src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="pk_test_Cdp9Nmr37P2QYX9gAa9reAzC"
            data-name="Laravel - Stripe"
            data-description="Premium">
    </script>
</form>