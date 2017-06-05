@extends("layouts.master")

@section('content')
    @if(session('error_search'))
        <article>
            <div class="container">
                <h3 class="help-block">{{ session('error_search') }}</h3>
            </div>
        </article>
    @elseif(isset($search))
        <article>
            <style>
                .search {
                    margin-bottom: 15px;
                }
                .count-search {
                    margin-bottom: 15px;
                    padding: 5px;
                    font-size: 20px;
                    font-weight: 600;
                    color: black;
                }
                .search-result {
                    border-top: 1px solid #cacaca;
                    padding: 5px;
                }
                .search-result p {
                    padding-top: 20px;
                }
            </style>
            <div class="container search">
                <div class="count-search col-xs-12">
                    <strong> {{ $search['total_count'] }} repository results:</strong>
                </div>

                @foreach($search['items'] as $item)

                    <div class="search-result col-xs-12">
                        <div class="col-xs-12 col-sm-8">
                            <h2>
                                <a href="{{ $item['html_url'] }}" target="_blank">{{ $item['full_name'] }}</a>
                            </h2>
                            <p>
                                {{ $item['description'] }}
                            </p>
                        </div>

                        <div class="col-xs-6 col-sm-2">
                            <p>
                                {{ $item['language'] }}
                            </p>
                        </div>

                        <div class="col-xs-6 col-sm-2">
                            <p>
                                <svg aria-label="star" height="16" role="img" version="1.1" viewBox="0 0 14 16" width="14">
                                    <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"></path>
                                </svg>
                                {{ $item['stargazers_count'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>
    @endif
@endsection