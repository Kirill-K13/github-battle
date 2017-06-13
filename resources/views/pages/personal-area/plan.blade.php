@extends("layouts.master")

@section('content')
    <article class="plan elementFirst">

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="panel panel-default">

                        <div class="panel-heading text-uppercase">
                            {{ $plan->statement_descriptor }}
                            <span class="pull-right">{{ $plan->currency }} {{ $plan->amount / 100 }} / {{ $plan->interval }}</span>
                        </div>

                        <div class="panel-body">
                            <ul class="list-group">
                                @for($i = 1; isset($plan->metadata['advantage-'.$i]); $i++)
                                    <li class="list-group-item">{{ $plan->metadata['advantage-'.$i] }}</li>
                                @endfor
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
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
                                        <div class="col-xs-12">
                                            <label for="card-element">
                                                Credit or debit card:
                                            </label>
                                            <div id="card-element">
                                                <!-- a Stripe Element will be inserted here. -->
                                            </div>

                                            <!-- Used to display Element errors -->
                                            <div id="card-errors" role="alert"></div><br>

                                            <input type="hidden" name="plan" value="{{ $plan['id'] }}">
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <button class="btn btn-primary pull-left">Make $ {{ $plan['amount'] / 100 }} Payment</button>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <button type="button" class="btn btn-success pull-right" onclick="$('#coupon').toggle(); $('#btn-coupon').hide();" id="btn-coupon">Add coupon</button>
                                            <input type="text" name="coupon" placeholder="Coupon" class="form-control StripeElement" id="coupon" style="display: none">
                                        </div>

                                    </div>
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