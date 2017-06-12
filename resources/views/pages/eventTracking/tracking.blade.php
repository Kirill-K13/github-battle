@extends("layouts.master")

@section('content')

    <article class="subscription">

        <div class="col-xs-12 col-sm-8 col-md-8">

            <div class="panel panel-default">
                <div id="add" class="panel-heading">Subscribe to news of the repository:</div>
                <div class="panel-body">

                    <div class="col-sm-12 col-md-6">

                        @if(session('error'))
                            <h4 class="help-block">{{ session('error') }}</h4>
                        @endif
                        <form action="{{ route('add-watch') }}" method="POST" role="form">
                            {{ csrf_field() }}
                            {{--LOGIN--}}

                            <span class="help-block" id="help-login"></span>

                            <div class="input-group">
                                <input id="login" type="text" class="form-control" name="login" placeholder="Login:"
                                       required autofocus {{ $access }}>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="getListRepos('login')" id="button-login" {{ $access }}>
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                </span>
                            </div>
                            <br>

                            {{--REPOSITORY--}}
                            <div class="form-group{{ $errors->has('repository') ? ' has-error' : '' }}">

                                <select class="form-control" id="list-login" name="repository" {{ $access }}>
                                    <option>Choose repository</option>
                                </select><br>

                                @if ($errors->has('repository'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('repository') }}</strong>
                                    </span><br>
                                @endif

                            </div>
                            <input type="submit" name="add_watch" class="btn btn-primary btn-sm pull-right" id="submit" value="Subscription" disabled>
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <ul class="list-group">
                            @foreach($repositories as $item)
                                <li class="list-group-item">
                                    {{ $item['full_name'] }}

                                    <form action="{{ route('del-watch') }}" method="POST" class="pull-right">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="full_name" value="{{ $item['full_name'] }}">
                                        <input type="submit" value="Delete" class="buttonDanger" {{ $access }} style="margin-top: -12px">
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div id="add" class="panel-heading">Subscribe to news of the user:</div>
                <div class="panel-body">

                    @if(session('userError'))
                        <h4 class="help-block">{{ session('userError') }}</h4>
                    @endif
                    <form action="{{ route('add-follow') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        {{--LOGIN1--}}

                        <span class="help-block" id="help-login"></span>

                        <div class="input-group">
                            <input id="login" type="text" class="form-control" name="login" placeholder="Login:" required autofocus {{ $access }}>
                            <span class="input-group-btn">
                                <input type="submit" class="btn btn-primary" value="Add" {{ $access }}>
                            </span>
                        </div>
                    </form>
                    <br>

                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item">
                                {{ $user['login'] }}

                                <form action="{{ route('del-follow') }}" method="POST" class="pull-right">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="login" value="{{ $user['login'] }}">
                                    <input type="submit" value="Delete" class="buttonDanger" {{ $access }} style="margin-top: -12px">
                                </form>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-xs-12">

            @if( !$is_subscribed )
                <h3 class="text-danger">The features of this web application are not available! <br>
                    <small>You need to <a href="{{ route('cabinet') }}">subscription</a> to keep your application running!</small>
                </h3>
            @endif

        </div>


    </article>

@endsection