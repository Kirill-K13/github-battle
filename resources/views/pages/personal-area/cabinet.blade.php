@extends("layouts.master")

@section('content')

    <article class="cabinet elementFirst">

        @if( $is_subscribed )

            <h3 class="text-success">
                You are subscribed and you can use this application.
            </h3>
            <hr>

        @else

            <h3 class="text-danger">The features of this web application are not available! <br>
                <small>You need to <strong>subscription</strong> to keep your application running:</small>
            </h3>
            <hr>

        @endif

        @foreach($plans as $plan)
            <div class="col-sm-6 col-md-4">
                <div class="panel {{ ( $is_subscribed && $subscription->stripe_plan ==  $plan->id ) ? 'panel-success' :  'panel-primary' }} plan-panel">

                    <div class="panel-heading text-uppercase">
                        {{ $plan->id }}
                        @if( $is_subscribed &&  ( $subscription->stripe_plan ==  $plan->id ) )
                            <button onclick='location.href="{{ route('confirmCancellation') }}"' class="buttonDanger pull-right" style="margin-top: -5px">Cancel Subscription</button>
                        @endif
                    </div>

                    <div class="panel-body center">
                        <h3 class="modal-title">
                            {{ $plan->name }}
                        </h3>

                        <img src="{{ asset('images/' . $plan->name . '.png') }}" alt="{{ $plan->name }}" height="100">

                        <p>{{ $plan->currency }} {{ $plan->amount / 100 }} / {{ $plan->interval }}</p>
                    </div>

                    <div class="panel-footer">
                        @if( $is_subscribed &&  ( $subscription->stripe_plan ==  $plan->id ) )
                            <a href="#" class="btn btn-default btn-block">
                                Current Plan
                            </a>
                        @else
                            <a href="{{ route('plan', $plan->id) }}" class="btn btn-success btn-block">
                                Subscribe
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        @endforeach

        @if( $is_subscribed && $subscription->onGracePeriod())

             <div class="col-xs-12">
                <div class="alert alert-warning">

                    <h3 class="modal-title">
                        Subscription expiring at {{ $subscription->ends_at->toFormattedDateString() }} <br>
                        <form method="post" action="{{ route('subscriptionResume') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Resume Subscription</button>
                        </form>
                    </h3>

                </div>
             </div>

        @elseif(Auth::user()->onTrial('main'))

                <div class="col-xs-12">
                    <div class="alert alert-warning">
                        <h3 class="modal-title">
                            Trial period expiring at {{ $subscription->trial_ends_at->toFormattedDateString() }} <br>
                        </h3>
                    </div>
                </div>

        @endif

        @if (session('status'))
            <div class="col-xs-12">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status') }}
                </div>
            </div>
        @endif

    </article>

@endsection