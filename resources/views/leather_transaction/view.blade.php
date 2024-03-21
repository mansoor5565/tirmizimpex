@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Leather Table</h1>
        
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Leather</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Transaction Type</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Transaction Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leathertransaction as $leathertransactions)
                                    <tr>
                                        <td>{{$leathertransactions->purchase_leather_id }}</td>
                                        <td>{{$leathertransactions->amount }}</td>
                                        <td>{{$leathertransactions->description}}</td>
                                        <td>{{$leathertransactions->transaction_type}}</td>
                                        <td>
                                            @foreach ($vendorBillSummaries as $vendorbill)
                                                Leather Vendor ID: {{ $vendorbill->leather_vendor_id }}, Total Remaining Balance: {{ $vendorbill->total_remaining_balance }}<br>
                                            @endforeach
                                        </td>                                        
                                        <td>{{$leathertransactions->transaction_date }}</td>
                                        <td>
                                            <a href="/leather_transaction/show/{{$leathertransactions->id}}" class="action-btn btn btn-success mr-2">
                                                <i class="bi bi-eye"></i> <span>View</span>
                                            </a>
                                            <a href="//show/{{$leathertransactions->id}}" class="action-btn btn btn-primary mr-2">
                                                <i class="bi bi-eye"></i> <span>Pay Now</span>
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
