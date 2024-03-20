@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Vendor Bill Table</h1>
        
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Purchase Leather ID</th>
                                    <th>Vendor </th>
                                    <th>Remaining Balance</th>
                                    <th data-type="date" data-format="YYYY/DD/MM"> Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendorbill as $vendorbills)
                                    <tr>

                                        <td>{{$vendorbills->leather_purchase_id}}</td>
                                        <td>{{$vendorbills->leatherpurchase->leathervendors->name." ".$vendorbills->leather_vendor_id }}</td>
                                        <td>{{ $vendorbills->remaining_balance }}</td>
                                        <td>{{ $vendorbills->created_at }}</td>
                                        <td>
                                            <a href="/leather_vendor_bill/show/{{$vendorbills->id}}" class="action-btn btn btn-success mr-2">
                                                <i class="bi bi-eye"></i> <span>View</span>
                                            </a>
                                            <a href="//{{$vendorbills->id}}" class="action-btn btn btn-primary mr-2">
                                                 <span>Pay Now</span>
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
