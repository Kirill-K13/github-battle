@extends("layouts.master")

@section('content')
    <article class="search">
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
                        <th>Star:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($search['items'] as $item)

                        <tr>
                            <td>
                                <h2><a href="{{ $item['html_url'] }}" target="_blank">{{ $item['full_name'] }}</a></h2>
                                <p>{{ $item['description'] }}</p>
                            </td>
                            <td>
                                <p>{{ $item['language'] }}</p>
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
@endsection