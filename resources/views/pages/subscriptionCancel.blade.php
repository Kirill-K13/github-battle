@extends("layouts.master")

@section('content')

    <article class="cancel">

        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-body text-center">

                            <h1>Hello, <span class="text-primary">{{ Auth::user()->name }}</span>!</h1>

                            <h3>Do you really want to cancel your subscription?</h3>

                            <hr>

                            <form action="{{ route('subscriptionCancel') }}" method="post">
                                {{ csrf_field() }}
                                <p><a href="{{ route('area') }}" class="btn btn-link">No, I wanted to Stay</a></p>
                                <button type="submit" class="btn btn-lg btn-danger">Please Cancel It</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>

@endsection