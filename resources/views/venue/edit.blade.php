@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Form Layouts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Layouts</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <form action="{{$url}}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Venue Form</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputName4" class="form-label">Venue Name</label>
                            <input type="text" class="form-control" id="inputName4" name="name" value="{{$venue->name}}">
                            <span class='text-danger'>
                                @error('name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="col-12">
                            <label for="inputName4" class="form-label">Buyer Name</label>
                            <input type="text" class="form-control" id="inputName4" name="buyer_name" value="{{$venue->buyer_name}}">
                            <span class='text-danger'>
                                @error('name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</section>
@endsection
