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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leather_vendor_bills as $leather_vendor_bill)
                                <tr>
                                    <td>
                                        {{ $leather_vendor_bill->name }}
                                    </td>
                                    <td>
                                        {{ $leather_vendor_bill->purchase_leather->sum('total_cost') - $leather_vendor_bill->purchase_leather->flatMap->leathertransaction->where('transaction_type', 'payment')->sum('amount') -$leather_vendor_bill->purchase_leather->flatMap->leathertransaction->where('transaction_type', 'return')->sum('amount')}}
                                    </td>
                                    <td>
                                        <a href="/leather_vendor_bill/pay/{{ $leather_vendor_bill->id }}"
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
