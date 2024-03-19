@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Leather Vendor</h1>
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
                        <form action="/leather_vendor" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="cost_per_unit" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="">
                                <span class='text-danger'>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="cost_per_unit" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="">
                                <span class='text-danger'>
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="cost_per_unit" class="form-label">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" id="">
                                <span class='text-danger'>
                                    @error('contact_number')
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
