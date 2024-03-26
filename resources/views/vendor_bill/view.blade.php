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
                                <th>Vendor Name</th>
                                <th>Remaining Balance</th>
                                <th>Transaction Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
    // Group the leather_vendor_bill collection by leather_vendor_id
    $groupedLeatherVendorBills = $leather_vendor_bill->groupBy('purchaseLeatherInfo.leather_vendor_id');
@endphp
@foreach ($groupedLeatherVendorBills as $leather_vendor_id => $group)
    <tr>
        <td>
            @foreach($leather_vendor_bill->unique('purchaseLeatherInfo.leathervendors.name') as $leather_vendor_bills)
                {{ $leather_vendor_bills->purchaseLeatherInfo->leathervendors->name }}
            @endforeach
            {{ $leather_vendor_id }}
        </td>        
        <td>
            {{-- Calculate the total cost for the current leather vendor ID group --}}
            {{ $group->sum('purchaseLeatherInfo.total_cost') }}
        </td>
        <td>{{ $group->first()->transaction_type }}</td>
        <td>{{ $group->first()->created_at->diffForHumans() }}</td>
        <td>
            <a href="/leather_vendor_bill/pay/{{ $leather_vendor_id }}"
                class="action-btn btn btn-primary mr-2">
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
@endsection
