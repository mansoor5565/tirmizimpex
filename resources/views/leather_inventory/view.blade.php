@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Leather Inventory Table</h1>
        
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Leather</h5>
                            <a href="/leather_inventory/create" class="btn btn-primary btn-custom">Create Leather Inventory</a>
                            <style>
                                .btn-custom {
                                     height: 40px; /* Set the desired height */
                                     min-width: 120px; /* Set the desired minimum width */
                                    /* Adjust padding to fit the text properly */
                                    }
                            </style>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Leather</th>
                                    <th>Lot No</th>
                                    <th>Quantity on Hand</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leather_inventory as $leathers_inventory )
                                    <tr>
                                        <td>{{$leathers_inventory->leathercolors->leathers->type ." ". $leathers_inventory->leathercolors->color ." ".$leathers_inventory->leathercolor_id }}</td>
                                        <td>{{ $leathers_inventory->lot_no}}</td>
                                        <td>{{ $leathers_inventory->quantity_on_hand }}</td>
                                        <td>{{  $leathers_inventory->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="/leather_inventory/show/{{ $leathers_inventory->id}}" class="action-btn btn btn-success mr-2">
                                                <i class="bi bi-eye"></i> <span>View</span>
                                            </a>
                                            <a href="/leather_inventory/edit/{{  $leathers_inventory->id }}"
                                                class="action-btn btn btn-warning mr-2 text-white">
                                                <i class="bi bi-pencil-square"></i> <span>Edit</span>
                                            </a>
                                            <a href="/leather_inventory/delete/{{  $leathers_inventory->id }}"
                                                class="action-btn btn btn-danger">
                                                <i class="bi bi-trash"></i> <span>Delete</span>
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
                swal("Deleted!", "Leather inventory has been deleted successfully.", "success");
            </script>
        @endif
        
        <script>
            function deleteAccessory(id) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this leather inventory!",
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
