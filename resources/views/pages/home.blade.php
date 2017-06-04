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

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('get-data') }}">
                                {{ csrf_field() }}
                                <div class="col-xs-12 col-sm-12 col-md-5">

                                    {{--LOGIN1--}}
                                    <div class="form-group">
                                        <label for="login1" class="col-xs-12 col-md-6 control-label pull-left">User-1
                                            Login:</label>
                                        <div class="col-md-6">

                                            <div class="input-group">
                                                <input id="login1" type="text" class="form-control" name="login1"
                                                       required autofocus>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"
                                                            onclick="getListRepos('login1')">
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
                                        <label for="repository1" class="col-md-6 control-label">Choose
                                            repository:</label>

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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <img src="{{asset('images/vs2.png')}}" alt="vs" width="100"
                                         style="margin-left: 25px">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-5">
                                    {{--LOGIN2--}}
                                    <div class="form-group">
                                        <label for="login2" class="col-md-6 control-label">User-2 Login:</label>

                                        <div class="col-md-6">

                                            <div class="input-group">
                                                <input id="login2" type="text" class="form-control" name="login2"
                                                       required>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"
                                                            onclick="getListRepos('login2')">
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


                                <div class="col-xs-12" style="text-align: center">
                                    {{--SUBMIT--}}
                                    <input type="submit" class="buttonDanger" value="Battle!">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>


    @if(isset($login1) && isset($login2))
        <article>
            {{--RESULT--}}
            <div class="container flex-container">

                <div class="user1">

                    {{--Avatar--}}
                    <img alt="{{  $login1 }}" class="avatar" src="{{ $avatar_url1 }}">

                    {{--Name and Login--}}
                    <div>
                        <h2 class="vcard-names">
                            <span class="vcard-fullname">{{  $name1 }}</span>
                            <span class="vcard-username">{{  $login1 }}</span>
                        </h2>
                    </div>

                    {{--Bio--}}
                    <div class="user-profile-bio">
                        <div>
                            {{  $bio1 }}
                        </div>
                    </div>

                    {{--Location, Email, blog--}}
                    <ul class="vcard-details">

                        {{--Location--}}
                        <li aria-label="Home location" class="vcard-detail">
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 12 16" width="12">
                                <path fill-rule="evenodd" d="M6 0C2.69 0 0 2.5 0 5.5 0 10.02 6 16 6 16s6-5.98 6-10.5C12 2.5 9.31 0 6 0zm0 14.55C4.14 12.52 1 8.44 1 5.5 1 3.02 3.25 1 6 1c1.34 0 2.61.48 3.56 1.36.92.86 1.44 1.97 1.44 3.14 0 2.94-3.14 7.02-5 9.05zM8 5.5c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                            </svg>
                            {{ $location1 }}
                        </li>

                        {{--Email--}}
                        <li aria-label="Email" class="vcard-detail">
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                                <path fill-rule="evenodd" d="M0 4v8c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H1c-.55 0-1 .45-1 1zm13 0L7 9 1 4h12zM1 5.5l4 3-4 3v-6zM2 12l3.5-3L7 10.5 8.5 9l3.5 3H2zm11-.5l-4-3 4-3v6z"></path>
                            </svg>

                            <a href="mailto:{{ $email1 }}">{{ $email1 }}</a>
                        </li>

                        {{--Blog--}}
                        <li aria-label="Blog or website" class="vcard-detail">
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                                <path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path>
                            </svg>

                            <a href="http://k13.zzz.com.ua" rel="nofollow me">{{ $blog1 }}</a>
                        </li>
                    </ul>


                    {{--Repository name--}}
                    <div>
                        <h1 class="vcard-names">
                            <span class="vcard-fullname">{{ $repositories1_name }}</span>
                        </h1>
                    </div>

                    {{--Watch--}}
                    <span>
                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                            <path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                        </svg>
                        Watch: {{  $watchers_count1 }} |
                    </span>

                    {{--Star--}}
                    <span>
                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                            <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"></path>
                        </svg>
                        Star: {{  $stargazers_count1 }} |
                    </span>

                    {{--Fork--}}
                    <span>
                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 10 16" width="10">
                            <path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path>
                        </svg>
                        Fork: {{  $forks1 }}
                    </span>

                </div>


                {{--RESULT--}}
                <div class="result">

                    <div class="calculated">
                        <h3>How the rating is calculated:</h3>
                        {{--Fork--}}
                        <span> One Fork
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 10 16" width="10">
                                <path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path>
                            </svg>
                            <strong>: this 3 mark</strong>
                        </span>
                        {{--Watch--}}
                        <span> | One Watch
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                                <path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                            </svg>
                            <strong>: this 2 mark</strong>
                        </span>
                        {{--Star--}}
                        <span> | One Star
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                                <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"></path>
                            </svg>
                            <strong>: this 1 mark</strong>
                        </span>
                    </div>


                    <div class="co-xs-12 col-md-5">
                        <h2 class="vcard-names">
                            <span class="vcard-username">{{ $login1 }}</span>
                            <span class="vcard-username"><strong>Rating: {{ $rating1 }}</strong></span>
                        </h2>
                    </div>


                    <div class="co-xs-12 col-md-2">
                        <img src="{{asset('images/vs.png')}}" alt="vs" width="60" class="vs">
                    </div>


                    <div class="co-xs-12 col-md-5">
                        <h2 class="vcard-names">
                            <span class="vcard-username">{{ $login2 }}</span>
                            <span class="vcard-username"><strong>Rating: {{ $rating2 }}</strong></span>
                        </h2>
                    </div>


                    <div class="win col-xs-12">
                        @if($rating1 > $rating2)
                            <h3>
                                <span class="vcard-fullname">
                                    <strong>Win: {{ $login1 }} !</strong>
                                </span>
                            </h3>
                        @else
                            <h3>
                                <span class="vcard-fullname">
                                    <strong>Win: {{ $login2 }} !</strong>
                                </span>
                            </h3>
                        @endif
                    </div>

                </div>


                <div class="user2">

                    {{--Avatar--}}
                    <img alt="{{ $login2 }}" class="avatar" src="{{ $avatar_url2 }}">

                    {{--Name and Login--}}
                    <div>
                        <h2 class="vcard-names">

                            <span class="vcard-fullname">{{ $name2 }}</span>
                            <span class="vcard-username">{{ $login2 }}</span>

                        </h2>
                    </div>

                    {{--Bio--}}
                    <div class="user-profile-bio">
                        <div>
                            {{  $bio2 }}
                        </div>
                    </div>

                    {{--Location, Email, blog--}}
                    <ul class="vcard-details">

                        {{--Location--}}
                        <li aria-label="Home location" class="vcard-detail">
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 12 16" width="12">
                                <path fill-rule="evenodd" d="M6 0C2.69 0 0 2.5 0 5.5 0 10.02 6 16 6 16s6-5.98 6-10.5C12 2.5 9.31 0 6 0zm0 14.55C4.14 12.52 1 8.44 1 5.5 1 3.02 3.25 1 6 1c1.34 0 2.61.48 3.56 1.36.92.86 1.44 1.97 1.44 3.14 0 2.94-3.14 7.02-5 9.05zM8 5.5c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                            </svg>
                            {{ $location2 }}
                        </li>

                        {{--Email--}}
                        <li aria-label="Email" class="vcard-detail">
                            <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                                <path fill-rule="evenodd" d="M0 4v8c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H1c-.55 0-1 .45-1 1zm13 0L7 9 1 4h12zM1 5.5l4 3-4 3v-6zM2 12l3.5-3L7 10.5 8.5 9l3.5 3H2zm11-.5l-4-3 4-3v6z"></path>
                            </svg>
                            <a href="mailto:{{ $email2 }}">{{ $email2 }}</a>
                        </li>

                        {{--Blog--}}
                        <li aria-label="Blog or website" class="vcard-detail">
                            <svg aria-hidden="true"  height="16" version="1.1" viewBox="0 0 16 16" width="16">
                                <path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path>
                            </svg>

                            <a href="http://k13.zzz.com.ua" class="url" rel="nofollow me">{{ $blog2 }}</a>
                        </li>
                    </ul>

                    {{--Repository name--}}
                    <div>
                        <h1 class="vcard-names">
                            <span class="vcard-fullname">{{  $repositories2_name }}</span>
                        </h1>
                    </div>

                    {{--Watch--}}
                    <span>
                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                            <path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                        </svg>
                                Watch: {{  $watchers_count2 }} |
                    </span>

                    {{--Star--}}
                    <span>
                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                            <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"></path>
                        </svg>
                               Star: {{  $stargazers_count2 }} |
                    </span>

                    {{--Fork--}}
                    <span>
                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 10 16" width="10">
                            <path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path>
                        </svg>
                        Fork: {{  $forks2 }}
                    </span>
                </div>
            </div>
        </article>
    @endif

    <article>
        <div class="container">
            <table class="table table-bordered results">
                <caption>Top three repository</caption>
                <thead>
                    <tr>
                        <th>
                            Avatar:
                        </th>
                        <th>
                            Login:
                        </th>
                        <th>
                            Repository:
                        </th>
                        <th>
                            Rating:
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($results as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->avatar_url }}" alt="{{ $item->login }}" height="50">
                        </td>

                        <td>{{ $item->login }}</td>

                        <td class="description">
                            {{ $item->repository }}
                        </td>

                        <td>{{ $item->rating }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </article>


@stop