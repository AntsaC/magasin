@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Dashboard
                </h1>
            </div>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Global sales of {{ $year }}
                </h5>
                <div>
                    <form action="">
                        <div class="d-flex">
                            <div>
                                <input type="number" class="form-control" value="{{ $year }}" name="date" />
                            </div>
                            <div>
                                <input class="btn btn-primary" type="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id='data' class="table table-hover">
                <thead>
                <tr>

                    <th>Month</th>

                    <th>Total</th>

                </tr>
                </thead>
                <tbody>
                @foreach($GlobalSales as $GlobalSale)
                    <tr>

                        <td>{{ $GlobalSale['name'] }}</td>

                        <td style="background-color: {{ $GlobalSale['color'] }}">
                            @if($GlobalSale['total'] != 0)
                            <a href="{{ route('sale-detail', [$GlobalSale['month'], $year]) }}">{{ number_format($GlobalSale['total'], 2, '.', ' ') }}</a>
                            @else
                                {{ number_format($GlobalSale['total'], 2, '.', ' ') }}
                            @endif
                        </td>

                    </tr>
                @endforeach
                    <tr class="table-light">
                        <td>Total</td>
                        <td>{{  number_format($GlobalSales->sum('total'), 2, '.', ' ') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <h5 class="card-title">
                Chart of {{ $year }}
            </h5>
            <canvas id="global"></canvas>
        </div>
    </div>

</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('global');

        $('#data').DataTable({
            dom: 'Bfrtip',
            buttons: ['pdf'],
            searching: false,
            ordering: false,
            paging:false
        });

        $.getJSON(
            'http://127.0.0.1:8000/api/global/{{ $year }}', function (data) {

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        datasets: [{
                            label: 'Line Chart',
                            data: data,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            }
        )


    </script>
@endsection

