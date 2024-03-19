@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Accesories</h1>
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
                        <form action="/accessories" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" name="name">
                                <span class='text-danger'>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Cost/Unit</label>
                                <input type="number" name="cost_per_unit" class="form-control" id="">
                                <span class='text-danger'>
                                    @error('cost_per_unit')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="unitSelect" class="form-label">Unit</label>
                                <select name="unit" class="form-select" id="unitSelect">
                                    <option value="Meter">Meter</option>
                                    <option value="Yard">Yard</option>
                                    <option value="KG">KG</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Packet">Packet</option>
                                    <option value="sqft">Sqft</option>
                                </select>
                                <span class='text-danger'>
                                    @error('unit')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="typeSelect" class="form-label">Type</label>
                                <select name="type" class="form-select" id="typeSelect">
                                    <option value="">Select Type</option>
                                    @foreach($accessories as $accessorie)
                                        <option value="{{ $accessorie->type }}">{{ $accessorie->type }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="other_type" class="form-control mt-2" placeholder="Enter Other Type(Optional)">
                            </div>                                                  
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                        <!-- Form fields for left form -->

                    </div>
                </div>
            </div>
    </section>
@endsection
