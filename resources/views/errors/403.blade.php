@extends("layouts.master")

@section('content')

    <div class="exceptions">
        <h2>{{ $exception->getMessage() }}</h2>
    </div>

@endsection