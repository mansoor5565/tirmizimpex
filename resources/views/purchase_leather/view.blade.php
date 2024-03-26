@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Purchase Leather Table</h1>

    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Leather</h5>
                            <a href="/purchase_leather/create" class="btn btn-primary btn-custom">Create Purchase Leather</a>
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
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Purchase Id</th>
                                    <th>Total Cost</th>
                                    <th>Vendor</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_leather_colors as $purchase_leather_color)
                                    <tr>
                                        <td>
                                            {{ $purchase_leather_color->id }}
                                        </td>
                                        <td>{{ $purchase_leather_color->total_cost }}</td>
                                        <td>{{ $purchase_leather_color->leathervendors->name }}</td>
                                        <td>{{ $purchase_leather_color->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="/purchase_leather/show/{{ $purchase_leather_color->id }}"
                                                class="action-btn btn btn-success mr-2">
                                                <i class="bi bi-eye"></i> <span>View</span>
                                            </a>
                                            <a href="/purchase_leather/edit/{{ $purchase_leather_color->id }}"
                                                class="action-btn btn btn-warning mr-2 text-white">
                                                <i class="bi bi-pencil-square"></i> <span>Edit</span>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="deletePurchaseLeather({{ $purchase_leather_color->id }})"
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
                swal("Deleted!", "Purchase leather has been deleted successfully.", "success");
            </script>
        @endif

        <script>
            function deletePurchaseLeather(id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this purchase leather!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = '/purchase_leather/delete/' + id;
                        }
                    });
            }
        </script>
    @endpush
@endsection
