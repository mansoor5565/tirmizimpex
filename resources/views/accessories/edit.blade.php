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
                        <h5 class="card-title">Edit Accesories </h5>
                        <form action="{{ $url }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" name="name"
                                    value="{{ $accessories->name }}">
                                <span class='text-danger'>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Cost/Unit</label>
                                <input type="number" name="cost_per_unit" class="form-control" id=""
                                    value="{{ $accessories->cost_per_unit }}">
                                <span class='text-danger'>
                                    @error('cost_per_unit')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="unitSelect" class="form-label">Unit</label>
                                    <select name="unit" class="form-select" id="unitSelect">
                                        <option value="Meter" {{ $accessories->where('unit', 'Meter')->count() > 0 ? 'selected' : ''}}>Meter</option>
                                        <option value="Yard" {{ $accessories->where('unit', 'Yard')->count() > 0 ? 'selected' : ''}}>Yard</option>
                                        <option value="KG" {{ $accessories->where('unit', 'KG')->count() > 0 ? 'selected' : ''}}>KG</option>
                                        <option value="Pcs" {{ $accessories->where('unit', 'Pcs')->count() > 0 ? 'selected' : ''}}>Pcs</option>
                                        <option value="Packet" {{ $accessories->where('unit', 'Packet')->count() > 0 ? 'selected' : ''}}>Packet</option>
                                        <option value="sqft" {{ $accessories->where('unit', 'sqft')->count() > 0 ? 'selected' : ''}}>Sqft</option>
                                    </select>
                                    <span class='text-danger'>
                                        @error('unit')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>                                
                            </div>
                            <div class="col-12">
                                <label for="typeSelect" class="form-label">Type</label>
                                <select name="type" class="form-select" id="typeSelect">
                                    <option value="">Select Type</option>
                                    @foreach($accessories_mod as $accessorie)
                                        <option value="{{ $accessorie->type }}"  {{ $accessorie->type == $accessorie->type ? 'selected' : '' }}>{{ $accessorie->type }}</option>
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
