@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($user))
                Edit user
            @else
                New user
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='name'>Name</label>
                    <input type='text' name='name' id='name' value='{{ isset($user) ? $user->name : old('name') }}' class='form-control @error('name') is-invalid @enderror' />@error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='email'>Email</label>
                    <input type='text' name='email' id='email' value='{{ isset($user) ? $user->email : old('email') }}' class='form-control @error('email') is-invalid @enderror' />@error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 @empty($user)
                 <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='text' name='password' id='password' value='{{ isset($user) ? $user->password : old('password') }}' class='form-control @error('password') is-invalid @enderror' />@error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                @endempty
                <div class='form-group'>
                    <label for='sale_point_id'>Point of sale</label>
                    <select id='sale_point_id' name='sale_point_id' class='form-select @error('sale_point_id') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $pvs as $pv )
                            <option value='{{ $pv->id }}' @isset($user) @if($pv->id == $user->sale_point_id) selected @endif @endisset >{{ $pv->location }} @isset($pv->user) (Managed) @endisset</option>
                        @endforeach
                    </select>@error('sale_point_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($user) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
