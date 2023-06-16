@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Stock grouped
                </h1>
            </div>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Laptop</th>

            <th>Brand</th>

            <th>Quantity</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($stock_groups as $stock_group)
                            <tr>

            <td><a href="{{ route('stocks.show', $stock_group->laptop->id) }}">{{ $stock_group->laptop->reference }}</a></td>

            <td>{{ $stock_group->laptop->brand->name }}</td>

            <td>{{ $stock_group->quantity }}</td>

                            </tr>
                    @endforeach
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td>{{ $stock_groups->sum('quantity') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

        @section('js')

        @endsection

