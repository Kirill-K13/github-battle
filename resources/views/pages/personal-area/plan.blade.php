@extends("layouts.master")

@section('content')
    <article class="plan">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0">
                    <div class="col-xs-12 center">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel panel-primary">
                            <div class="panel-heading text-uppercase">Subscribe to plan: {{ $plan->name }}</div>
                            <div class="panel-body stripe-form">

                                <form action="{{ route('subscribe') }}" method="POST" id="payment-form">
                                    {{ csrf_field() }}

                                    <div class="form-row">
                                        <label for="card-element">
                                            Credit or debit card:
                                        </label>
                                        <div id="card-element">
                                            <!-- a Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display Element errors -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="plan" value="{{ $plan['id'] }}">
                                    <button class="btn btn-primary pull-left">Make $ {{ $plan['amount'] / 100 }} Payment</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('js/stripe-form.js' )}}"></script>

    </article>

@endsection