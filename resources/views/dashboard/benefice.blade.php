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
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Benefices of {{ $year }}
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
            <th>Vente</th>
            <th>Achat</th>
            <th>Commission</th>
            <th>Perte</th>
            <th>Benefice</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($benefices as $key => $benefice)
                            <tr>

            <td class="fw-bold">{{ $benefice['name'].' '.($year == 'global' ? $benefice['year'] : '') }}</td>
            <td>{{ number_format($benefice['total_vente'], 2, '.', ' ') }}</td>
            <td>{{ number_format($benefice['total_purchasing'], 2, '.', ' ') }}</td>
            <td>{{ number_format($benefice['commission'], 2, '.', ' ') }}</td>
            <td>{{ number_format($benefice['total_lost'], 2, '.', ' ') }}</td>
            <td>{{ number_format($benefice['benefice'], 2, '.', ' ') }}</td>

                            </tr>
                    @endforeach
                <tr class="table-light">
                    <td>Total</td>
                    <td>{{ number_format($benefices->sum('total_vente'), 2, '.', ' ') }}</td>
                    <td>{{ number_format($benefices->sum('total_purchasing'), 2, '.', ' ') }}</td>
                    <td>{{ number_format($benefices->sum('commission'), 2, '.', ' ') }}</td>
                    <td>{{ number_format($benefices->sum('total_lost'), 2, '.', ' ') }}</td>
                    <td>{{ number_format($benefices->sum('benefice'), 2, '.', ' ') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                Evolution diagram
            </div>
            <canvas id="benefice"></canvas>
        </div>
    </div>
</div>
@endsection

        @section('js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: ['pdf'],
                paging: false,
                ordering: false,
                searching: false
            });

            const ctx = document.getElementById('benefice');

            $.getJSON(
                'http://127.0.0.1:8000/api/benefice/{{ $year }}', function (data) {

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            datasets: [{
                                label: 'Benefice',
                                data: data[0],
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

        })
        </script>
        @endsection

