@extends("layouts.master")

@section('content')

    <article class="battle">
        {{--FORM--}}
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Github-battle</div>
                        <div class="panel-body">

                            @if(session('error'))
                                <h3 class="help-block">{{ session('error') }}</h3>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('get-data') }}">
                                {{ csrf_field() }}
                                <div class="col-xs-12 col-sm-12 col-md-5">

                                    {{--LOGIN1--}}
                                    <div class="form-group">
                                        <label for="login1" class="col-xs-12 col-md-6 control-label pull-left">
                                            User-1 Login:
                                        </label>
                                        <div class="col-md-6">

                                            <div class="input-group">
                                                <input id="login1" type="text" class="form-control" name="login1"
                                                       required autofocus>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"
                                                            onclick="getListRepos('login1')" id="button-login1">
                                                        <span class="glyphicon glyphicon-search"
                                                              aria-hidden="true"></span>
                                                    </button>
                                                </span>
                                            </div>

                                            <span class="help-block" id="help-login1"></span>
                                        </div>
                                    </div>

                                    {{--REPOSITORY1--}}
                                    <div class="form-group{{ $errors->has('repository1') ? ' has-error' : '' }}">
                                        <label for="repository1" class="col-md-6 control-label">
                                            Choose repository:
                                        </label>

                                        <div class="col-md-6">
                                            <select class="form-control" id="list-login1" name="repository1">
                                                <option>Repository</option>
                                            </select>

                                            @if ($errors->has('repository1'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('repository1') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                {{--VS--}}
                                <div class="col-xs-12 col-sm-12 col-md-2 center">
                                    <img src="{{asset('images/vs2.png')}}" alt="vs" width="100">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-5">
                                    {{--LOGIN2--}}
                                    <div class="form-group">
                                        <label for="login2" class="col-md-6 control-label">
                                            User-2 Login:
                                        </label>

                                        <div class="col-md-6">

                                            <div class="input-group">
                                                <input id="login2" type="text" class="form-control" name="login2"
                                                       required>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"
                                                            onclick="getListRepos('login2')" id="button-login2">
                                                        <span class="glyphicon glyphicon-search"
                                                              aria-hidden="true"></span>
                                                    </button>
                                                </span>
                                            </div>

                                            <span class="help-block" id="help-login2"></span>

                                        </div>
                                    </div>


                                    {{--REPOSITORY2--}}
                                    <div class="form-group{{ $errors->has('repository2') ? ' has-error' : '' }}">
                                        <label for="repository" class="col-md-6 control-label">Choose
                                            repository:</label>

                                        <div class="col-md-6">

                                            <select class="form-control" id="list-login2" name="repository2">
                                                <option>Repository</option>
                                            </select>

                                            @if ($errors->has('repository2'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('repository2') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>


                                <div class="col-xs-12 center">
                                    {{--SUBMIT--}}
                                    <input type="submit" id="submit" class="btn btn-sm btn-default" value="Battle!" disabled>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

@include('pages.results')

@endsection