@extends('layouts.app')

@section('content')
    <style>
        .btn-custom {
            height: 40px;
            min-width: 120px;
        }
    </style>
    <!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Permissions</h5>
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-custom">Add New Permission</a>
                        </div><!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        Permission Name
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                                                class="action-btn btn btn-warning mr-2 text-white">
                                                <i class="bi bi-pencil-square"></i> <span>Edit</span>
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteMenuItem({{ $permission->id }})"
                                                class="action-btn btn btn-danger">
                                                <i class="bi bi-trash"></i><span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                swal("Deleted!", "Permission has been deleted successfully.", "success");
            </script>
        @endif

        <script>
            function deleteMenuItem(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this Permission!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = '/permissions/delete/' + id;
                        }
                    });
            }
        </script>
    @endpush
@endsection
