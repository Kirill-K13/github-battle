@extends("layouts.master")

@section('content')
    <article>
        <div class="container">
            <table class="table table-bordered results">
                <caption>Top three repository</caption>
                <thead>
                <tr>
                    <th> № </th>
                    <th> Avatar: </th>
                    <th> Login: </th>
                    <th> Repository: </th>
                    <th> Rating: </th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
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

@endsection