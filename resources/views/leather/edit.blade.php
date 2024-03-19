@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Leather</h1>
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
                        <h5 class="card-title">Edit Leather </h5>
                        <form action="{{ $url }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Type</label>
                                <input type="text" name="type" class="form-control" id=""
                                    value="{{ $leathers->type }}">
                                <span class='text-danger'>
                                    @error('type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            @include('components.color-multiple-picker-edit')
                            <span class='text-danger'>
                                @error('color')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <script>
        updateColorArrayInput();
    </script>
@endsection
