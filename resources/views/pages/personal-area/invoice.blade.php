@extends("layouts.master")

@section('content')

    <article class="invoice elementFirst">

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-1 ">

                    <div class="panel panel-default">
                        <div class="panel-body text-center">

                            <h3>Here are your invoices:</h3>

                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>Dated</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>

                                @if( count($invoices) )
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                            <td>{{ $invoice->total() }}</td>
                                            <td><a href="{{ route('downloadInvoice', $invoice->id) }}">Download</a></td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="3">No Invoice currently.</td>
                                    </tr>
                                @endif
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>

@endsection