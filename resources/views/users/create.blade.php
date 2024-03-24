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
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add User</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputName4" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputName4" name="name">
                                <span class='text-danger'>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <span class='text-danger'>
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class='text-danger'>
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3 mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                </div>
                            </div>
                            <div class="col-12">
                                <input class="form-control" type="file" name="profile_image" id="formFile">
                                <span class='text-danger'>
                                    @error('profile_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users Permission</h5>
                        <div class="row g-3 mt-3">
                            @foreach ($groupPermission as $prefix => $permissions)
                                <div class="col-lg-4">
                                    <div class="card px-3">
                                        <h5 class="card-title">{{ ucfirst($prefix) }}</h5>
                                        <ul class="list-unstyled">
                                            @foreach ($permissions as $permission)
                                                <li class="">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}">
                                                    {{ $permission->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
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
