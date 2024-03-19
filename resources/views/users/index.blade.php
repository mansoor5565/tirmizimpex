@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Users</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Users</h5>
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-custom">Add Users</a>
                            <style>
                                .btn-custom {
                                    height: 40px;
                                    /* Set the desired height */
                                    min-width: 120px;
                                    /* Set the desired minimum width */
                                    /* Adjust padding to fit the text properly */
                                }
                            </style>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Email</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                                    <th>Profile Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        @isset($user->profile_image)
                                            <td>
                                                <img src="{{ url('/storage/user/profile/'.$user->profile_image) }}" alt="Profile" class="rounded-circle" height="120" width="120">
                                            </td>
                                        @else
                                            <td>
                                                <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                            </td>
                                        @endisset
                                        <td>
                                            <a href="/users/show/{{ $user->id }}"
                                                class="action-btn btn btn-success mr-2">
                                                <i class="bi bi-eye"></i><span>View</span>
                                            </a>
                                            <a href="{{ route('users.edit',['user'=>$user->id]) }}"
                                                class="action-btn btn btn-warning mr-2 text-white">
                                                <i class="bi bi-pencil-square"></i> <span>Edit</span>
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteVenue({{ $user->id }})"
                                                class="action-btn btn btn-danger">
                                                <i class="bi bi-trash"></i><span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('script')
        @if (session()->has('submitSuccess'))
            <script>
                swal("Saved Successfully!", "", "success");
            </script>
        @endif
        @if (session()->has('updateSuccess'))
            <script>
                swal("Updated Successfully!", "", "success");
            </script>
        @endif
        @if (session()->has('DeleteSuccess'))
            <script>
                swal("Deleted!", "User has been deleted successfully.", "success");
            </script>
        @endif

        <script>
            function deleteVenue(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this User!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = '/users/delete/' + id;
                        }
                    });
            }
        </script>
    @endpush
@endsection
