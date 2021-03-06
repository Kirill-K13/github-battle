@extends("layouts.master")

@section('content')
    <article class="search elementFirst">

        @if( !$is_subscribed )

            <h3 class="text-danger">The features of this web application are not available! <br>
                <small>You need to <a href="{{ route('cabinet') }}">subscription</a> to keep your application running!</small>
            </h3>

        @else

        @if(isset($error_search))
                <div class="container">
                    <h3 class="help-block">{{ $error_search }}</h3>
                </div>
        </article>

        @elseif(isset($search))
                <div class="container">
                    <div class="count-search">
                        <strong> {{ $search['total_count'] }} repository results:</strong>
                    </div>
                    <table id="result" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Language:</th>
                            <th>Fork:</th>
                            <th>Watch:</th>
                            <th>Star:</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($search['items'] as $item)
                            <tr>
                                <td>
                                    <h2><a href="{{ $item['html_url'] }}" target="_blank">{{ $item['full_name'] }}</a></h2>
                                    <p>{{ $item['description'] }}</p>
                                    <p><a href="{{ $links[$item['id']] }}">Download zip</a></p>
                                </td>
                                <td>
                                    <p>{{ $item['language'] }}</p>
                                </td>

                                <td>
                                    <p>
                                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 10 16" width="10">
                                            <path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path>
                                        </svg>
                                        {{ $item['forks_count'] }}
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                                            <path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                                        </svg>
                                        {{ $item['watchers_count'] }}
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <svg aria-label="star" height="16" role="img" version="1.1" viewBox="0 0 14 16" width="14">
                                            <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"></path>
                                        </svg>
                                        {{ $item['stargazers_count'] }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </article>
        @endif
    @endif
@endsection