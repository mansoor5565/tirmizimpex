@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Accesories Table</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Accessories</h5>
                            <a href="/accessories/create" class="btn btn-primary btn-custom">Create Accesories</a>
                            <style>
                                .btn-custom {
                                     height: 40px; /* Set the desired height */
                                     min-width: 120px; /* Set the desired minimum width */
                                    /* Adjust padding to fit the text properly */
                                    }
                            </style>
                        </div><!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Cost/Unit</th>
                                    <th>Unit</th>
                                    <th>Type</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accessories as $accessorie)
                                    <tr>
                                        <td>{{ $accessorie->name }}</td>
                                        <td>{{ $accessorie->cost_per_unit }}</td>
                                        <td>{{ $accessorie->unit }}</td>
                                        <td>{{ $accessorie->type }}</td>
                                        <td>{{ $accessorie->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="/accessories/show/{{$accessorie->id}}" class="action-btn btn btn-success mr-2">
                                                <i class="bi bi-eye"></i> <span>View</span>
                                            </a>
                                            <a href="/accessories/edit/{{ $accessorie->id }}"
                                                class="action-btn btn btn-warning mr-2 text-white">
                                                <i class="bi bi-pencil-square"></i> <span>Edit</span>
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteAccessory({{ $accessorie->id }})"
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
        @if(session()->has('submitSuccess'))
            <script>
                swal("Saved Successfully!", "", "success");
            </script>
        @endif
        @if(session()->has('updateSuccess'))
            <script>
                swal("Updated Successfully!", "", "success");
            </script>
        @endif
        @if(session()->has('DeleteSuccess'))
            <script>
                swal("Deleted!", "Accessory has been deleted successfully.", "success");
            </script>
        @endif
        
        <script>
            function deleteAccessory(id) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this accessory!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = '/accessories/delete/' + id;
                    }
                });
            }
        </script>
    @endpush
@endsection
