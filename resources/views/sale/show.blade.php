@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Sales
                </h1>
            </div>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <div class="search-bar">
                <form action="">
                    <div class="float-end form-inline w-75">

                        <div class='form-group '>
                            <label for='reference'>Reference</label>
                            <input type='text' name='reference' id='reference' value='{{  $_GET['reference'] ?? '' }}' class='form-control form-control-sm' />
                        </div>
                        <div class='form-group ms-3'>
                            <label for='min'>Min</label>
                            <input type='text' name='min' id='min' value='{{   $_GET['min'] ?? '' }}' class='form-control form-control-sm' />
                        </div>
                        <div class='form-group ms-3'>
                            <label for='max'>Max</label>
                            <input type='text' name='max' id='max' value='{{   $_GET['max'] ?? '' }}' class='form-control form-control-sm' />
                        </div>
                        <div class='form-group ms-3'>
                            <label for='min'>Min total</label>
                            <input type='text' name='min_total' id='min' value='{{   $_GET['min_total'] ?? '' }}' class='form-control form-control-sm' />
                        </div>
                        <div class='form-group ms-3'>
                            <label for='max'>Max total</label>
                            <input type='text' name='max_total' id='max' value='{{   $_GET['max_total'] ?? '' }}' class='form-control form-control-sm' />
                        </div>
                        <button class="btn d-block" type="submit" title="Search"><i class="fas fa-search"></i> Search</button>
                    </div>
                </form>
            </div>
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Laptop</th>

            <th class="text-end">Quantity</th>

            <th class="text-end">Point of sale</th>

            <th class="text-end">Price</th>

            <th class="text-end">Total price</th>

                        <th>Date</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                            <tr>

            <td>
                <a href="{{ route('laptops.pv', $sale->laptop_id) }}" class="btn btn-link">
                    {{ $sale->reference }}
                </a>
            </td>

            <td class="text-end">{{ $sale->quantity }}</td>

            <td class="text-end">{{ $sale->location }}</td>

                                <td class="text-end">{{ number_format( $sale->price, 2, '.', ' ') }}</td>

                                <td class="text-end">{{ number_format($sale->total_price, 2, '.', ' ') }}</td>


                                <td>{{ $sale->created_at }}</td>


                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



