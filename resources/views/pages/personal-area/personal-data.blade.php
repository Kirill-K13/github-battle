@extends("layouts.master")

@section('content')

    <article class="elementFirst">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Your personal data:</strong></div>
                        <div class="panel-body">

                            <div class="col-sm-12 col-md-5 panel panel-default">
                                <div class="panel-body">

                                    <div class="col-xs-12">
                                        <form action="{{ route('change-data') }}" method="post">
                                            {{ csrf_field() }}
                                            <label class="control-label">Nane:</label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required><br>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                            <label class="control-label">Email:</label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            <hr>
                                            <input type="submit" class="btn btn-primary btn-sm pull-right" value="Change">
                                        </form>
                                    </div>

                                    @if( !is_null($plan) )
                                        <div class="col-xs-12 change-card">
                                            <form action="{{ route('change-card') }}" method="post" id="payment-form">
                                                {{ csrf_field() }}
                                                <div>
                                                    Current credit or debit card (last four numbers: {{ $user->	card_last_four }} )<br>
                                                    <button type="button" class="btn btn-default btn-sm" onclick="$('#card').toggle()">
                                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                        Change card
                                                    </button>
                                                </div>

                                                <div id="card" style="display:none;">
                                                    <label for="card-element">
                                                        New credit or debit card:
                                                    </label>
                                                    <div id="card-element">
                                                        <!-- a Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Used to display Element errors -->
                                                    <div id="card-errors" role="alert"></div><hr>

                                                    <input type="submit" class="btn btn-primary btn-sm  pull-right" value="Change">
                                                </div>

                                            </form>
                                            <script src="https://js.stripe.com/v3/"></script>
                                            <script src="{{ asset('js/stripe-form.js')}}"></script>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-1"></div>

                            @if( !is_null($plan) )
                                <div class="col-sm-12 col-md-6  panel panel-default">
                                    <div class="panel-body">

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
                                            <a href="{{ route('cabinet') }}" class="pull-right">Change current plan</a>
                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 col-md-6  panel panel-default">
                                    <div class="panel-body">

                                        <div class="panel-body">
                                            <h3 class="text-danger">The features of this web application are not available! <br>
                                                <small>You need to <a href="{{ route('cabinet') }}">subscription</a> to keep your application running!</small>
                                            </h3>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            @if(Auth::user()->onTrial('main'))
                                <div class="col-sm-12 col-md-6 pull-right">
                                    <div class="alert alert-warning">
                                        <h3 class="modal-title">
                                            Trial period expiring at {{ Auth::user()->subscription('main')->trial_ends_at->toFormattedDateString() }} <br>
                                        </h3>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection
