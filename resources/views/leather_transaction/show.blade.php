@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Purchase Leather</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <style>
            .details-container {
              max-width: 600px;
              margin: 0 auto;
              padding: 20px;
              border: 1px solid #ccc;
              border-radius: 5px;
            }
        
            .details-row {
              margin-bottom: 10px;
            }
        
            .details-label {
              font-weight: bold;
            }
          </style>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leather Transaction Details</h5>
                        <div class="col-12">
                            <div class="details-container">
                              <div class="details-row">
                                <span class="details-label">Purchase ID:</span>
                                <span class="details-value">{{$leathertransaction->purchase_leather_id}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Amount:</span>
                                <span class="details-value">{{$leathertransaction->amount}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Description:</span>
                                <span class="details-value">{{$leathertransaction->description}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Transaction Type:</span>
                                <span class="details-value">{{$leathertransaction->transaction_type}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Remaining Balance:</span>
                                @foreach ($vendorBillSummaries as $vendorbill)
                                    <span class="details-value"> Leather Vendor ID:{{  $vendorbill->leather_vendor_id }} Total Remaining Balance:{{ $vendorbill->total_remaining_balance }}</span>
                                @endforeach
                            </div>
                            
                            <div class="details-row">
                                <span class="details-label">Transaction Date:</span>
                                <span class="details-value">{{$leathertransaction->transaction_date}}</span>
                            </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
