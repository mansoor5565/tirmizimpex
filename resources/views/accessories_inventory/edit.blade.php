@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Purchase Accessories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create</h5>
                        <form action="{{$url}}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <div class="search-container">
                                    <span class="search-icon">&#128269;</span>
                                    <input type="text" id="searchInput" placeholder="Search...">
                                </div>

                                <label for="selectAccessories" class="form-label">Choose Accessories</label>
                                <select class="form-select mb-2" id="selectAccessories" name="accessories" >
                                    @foreach ($accessories as $accessory)
                                        <option value="{{ $accessory->id }}"{{ $accessories_inventory->where('accessories_id', $accessory->id) ? 'selected' : '' }}>{{ $accessory->name }}</option>
                                    @endforeach
                                </select>
                                <span class='text-danger'>
                                    @error('accessories')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="cost_per_unit" class="form-label">Quantity On Hand</label>
                                <input type="number" name="quantity_on_hand" class="form-control" id="cost_per_unit" value="{{$accessories_inventory->quantity_on_hand}}">
                                <span class='text-danger'>
                                    @error('quantity_on_hand')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
