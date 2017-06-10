@extends("layouts.master")

@section('content')

<article class="stripe">
    @if( $is_subscribed )

        <h3 class="text-success">
            You are subscribed and you can use this application  <br>
            <small>
                it has <strong>{{ $subscription->stripe_plan }}</strong> plan.
            </small>
        </h3>

        @if( $subscription->onGracePeriod() )

            <div class="alert alert-warning">
                <h3 class="modal-title">Subscription expiring at {{ $subscription->ends_at->toFormattedDateString() }}</h3>
            </div>

            <form method="post" action="{{ route('subscriptionResume') }}">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success">Resume Subscription</button>
            </form>
            <br>

        @else
            <a href="{{ route('confirmCancellation') }}" class="btn btn-danger">Cancel Subscription</a>
        @endif

    @else

        <h3 class="text-danger">The features of this web application are not available! <br>
            <small>You need to <strong>subscription</strong> to keep your application running:</small>
        </h3>

    @endif

        @foreach($plans as $plan)
            <div class="col-sm-4">
                <div class="panel {{ ( $is_subscribed && $subscription->stripe_plan ==  $plan->id ) ? 'panel-success' :  'panel-primary' }}">
                    <div class="panel-heading text-uppercase">{{ $plan->id }}</div>
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


</article>

@endsection