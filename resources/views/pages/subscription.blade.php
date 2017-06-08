@extends("layouts.master")

@section('content')

    <article class="subscription">

        <div class="col-xs-12 col-sm-6 col-md-4">
            <h2>Add repository:</h2>
            {{--Add watch to repository--}}
            <form action="{{ route('add-watch') }}" method="POST" role="form">
                {{ csrf_field() }}
                {{--LOGIN1--}}

                <span class="help-block" id="help-login"></span>

                <div class="input-group">
                    <input id="login" type="text" class="form-control" name="login" placeholder="Login:"
                           required autofocus>
                    <span class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="getListRepos('login')"
                                    id="button-login">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                </div>
                <br>

                {{--REPOSITORY1--}}
                <div class="form-group{{ $errors->has('repository') ? ' has-error' : '' }}">

                    <select class="form-control" id="list-login" name="repository">
                        <option>Choose repository</option>
                    </select><br>

                    @if ($errors->has('repository'))
                        <span class="help-block">
                            <strong>{{ $errors->first('repository') }}</strong>
                        </span><br>
                    @endif


                </div>
                <input type="submit" name="add_watch" class="btn btn-primary btn-sm pull-right" id="submit" value="Subscription">
            </form>
            <br>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4">
            <h2>Remove repository:</h2>
            <ul class="list-group">
                  @foreach($repositories as $item)
                      <li class="list-group-item">
                          {{ $item['full_name'] }}

                          <form action="{{ route('del-watch') }}" method="POST" class="pull-right">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <input type="hidden" name="full_name" value="{{ $item['full_name'] }}">
                              <input type="submit" value="Delete" class="buttonDanger" style="margin-top: -12px">
                          </form>
                      </li>
                  @endforeach
              </ul>
        </div>


        <div class="col-xs-12 col-sm-6 col-md-4">
            <h2>Remove users:</h2>
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item">
                        {{ $user['login'] }}

                        <form action="{{ route('del-follow') }}" method="POST" class="pull-right">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="login" value="{{ $user['login'] }}">
                            <input type="submit" value="Delete" class="buttonDanger" style="margin-top: -12px">
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="col-xs-12 col-sm-6 col-md-4">
            <h2>Add user:</h2>
            <form action="{{ route('add-follow') }}" method="POST" role="form">
                {{ csrf_field() }}
                {{--LOGIN1--}}

                <span class="help-block" id="help-login"></span>

                <div class="input-group">
                    <input id="login" type="text" class="form-control" name="login" placeholder="Login:" required autofocus>
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </span>
                </div>

    </article>
@endsection