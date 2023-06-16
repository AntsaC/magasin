@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                Multiple transfer
            </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('transfers.index') }}">Transfers</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <form method="post" action="{{ route('transfers.multiple-save') }}">
                @csrf
                <div id="transfer">
                    @if(old('quantity_sent',[]))
                        @foreach(old('quantity_sent',[]) as $index => $quantity)
                            <div class="row">
                                <div class='form-group col'>
                                    <label for='laptop_id[{{ $index }}]'>Laptop in stock</label>
                                    <select id='laptop_id[{{ $index }}]' name='laptop_id[{{ $index }}]' class='form-select ' aria-label='Default select example'>
                                        @foreach( $laptops as $laptop )
                                            <option value='{{ $laptop->laptop_id }}'  @if($laptop->laptop_id == old('laptop_id',[])[$index]) selected @endif  >{{ $laptop->laptop->reference }} ( {{ $laptop->quantity }} )</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class='form-group col'>
                                    <label for='sale_point_id[{{ $index }}]'>Point of sale</label>
                                    <select id='sale_point_id[{{ $index }}]' name='sale_point_id[{{ $index }}]' class='form-select ' aria-label='Default select example'>
                                        @foreach( $sale_points as $sale_point )
                                            <option value='{{ $sale_point->id }}' @if($sale_point->id == old('sale_point_id',[])[$index]) selected @endif >{{ $sale_point->location }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class='form-group col'>
                                    <label for='quantity_sent[{{ $index }}]'>Quantity</label>
                                    <input type='text' name='quantity_sent[{{ $index }}]' id='quantity_sent[{{ $index }}]' value='{{ $quantity }}' class='form-control @error('quantity_sent.'.$index) is-invalid @enderror' />@error('quantity_sent.'.$index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class='form-group col'>
                                    <label for='transfer_at[{{ $index }}]'>Date</label>
                                    <input type='datetime-local' name='transfer_at[{{ $index }}]' id='transfer_at[{{ $index }}]' value='{{ old('transfer_at')[$index] }}' class='form-control @error('transfer_at.'.$index) is-invalid @enderror' />@error('transfer_at.'.$index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                            <div class='form-group col'>
                                <label for='laptop_id[0]'>Laptop in stock</label>
                                <select id='laptop_id[0]' name='laptop_id[0]' class='form-select ' aria-label='Default select example'>
                                    @foreach( $laptops as $laptop )
                                        <option value='{{ $laptop->laptop_id }}' @isset($transfer) @if($laptop->laptop_id == $transfer->laptop_id) selected @endif @endisset >{{ $laptop->laptop->reference }} ( {{ $laptop->quantity }} )</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='form-group col'>
                                <label for='sale_point_id[0]'>Point of sale</label>
                                <select id='sale_point_id[0]' name='sale_point_id[0]' class='form-select ' aria-label='Default select example'>
                                    @foreach( $sale_points as $sale_point )
                                        <option value='{{ $sale_point->id }}' @isset($transfer) @if($sale_point->id == $transfer->sale_point_id) selected @endif @endisset >{{ $sale_point->location }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='form-group col'>
                                <label for='quantity_sent[0]'>Quantity</label>
                                <input type='text' name='quantity_sent[0]' id='quantity_sent[0]' value='{{ isset($transfer) ? $transfer->quantity_sent : old('quantity_sent[0]') }}' class='form-control @error('quantity_sent.0') is-invalid @enderror' />@error('quantity_sent.0')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='form-group col'>
                                <label for='transfer_at[0]'>Date</label>
                                <input type='datetime-local' name='transfer_at[0]' id='transfer_at[0]' value='{{ \Carbon\Carbon::now() }}' class='form-control @error('transfer_at.0') is-invalid @enderror' />@error('transfer_at.0')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
</div>
                <input type="hidden" name="stock">
                @error('stock')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }} !
                </div>
                @enderror
 <button type="button" id="add-transfer" class="btn btn-light">Add +</button>

                <input type="submit" class="btn btn-primary" value="{{ isset($transfer) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function () {

            let template = $('#transfer');
            let html =
                `
        <div class="row">
            <div class='form-group col'>
                                <label for='laptop_id[0]'>Laptop in stock</label>
                                <select id='laptop_id[0]' name='laptop_id[0]' class='form-select ' aria-label='Default select example'>
                                    @foreach( $laptops as $laptop )
                <option value='{{ $laptop->laptop_id }}' >{{ $laptop->laptop->reference }} ( {{ $laptop->quantity }} )</option>
                                    @endforeach
                </select>
            </div>

            <div class='form-group col'>
                <label for='sale_point_id[0]'>Point of sale</label>
                <select id='sale_point_id[0]' name='sale_point_id[0]' class='form-select ' aria-label='Default select example'>
@foreach( $sale_points as $sale_point )
                <option value='{{ $sale_point->id }}' >{{ $sale_point->location }}</option>
                                    @endforeach
                </select>
            </div>

            <div class='form-group col'>
                <label for='quantity_sent[0]'>Quantity</label>
                <input type='text' name='quantity_sent[0]' id='quantity_sent[0]' class='form-control' />
            </div>

            <div class='form-group col'>
                                <label for='transfer_at[0]'>Date</label>
                                <input type='datetime-local' name='transfer_at[0]' id='transfer_at[0]' value='{{ \Carbon\Carbon::now() }}' class='form-control' />
            </div>

</div>
`;

            let index = @if(old('quantity_sent',[])) {{ count(old('quantity_sent',[])) }} @else 1 @endif;


            $("#add-transfer").click(function () {

                template.append(html.replaceAll('[0]','['+index+']'));
                index++;

            })

        })
    </script>

@endsection
