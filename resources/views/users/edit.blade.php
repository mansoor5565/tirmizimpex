@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>User Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputName4" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputName4" name="name"
                                    value="{{ $user->name }}">
                                <span class='text-danger'>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                                <span class='text-danger'>
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Add new Password or leave it blank">
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
                                    @isset($user->profile_image)
                                        <td>
                                            <img src="{{ url('/storage/user/profile/' . $user->profile_image) }}" alt="Profile"
                                                class="rounded-circle" height="120" width="120">
                                        </td>
                                    @else
                                        <td>
                                            <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                        </td>
                                    @endisset
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
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </section>
@endsection
