@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Accesories Inventory</h1>
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
                        <h5 class="card-title">Leather Inventory Details</h5>
                        <div class="col-12">
                            <div class="details-container">
                              <div class="details-row">
                                <span class="details-label">Leather:</span>
                                <span class="details-value">{{$leather_inventory->leathercolors->color ." ".$leather_inventory->leathercolor_id }}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Lot No:</span>
                                <span class="details-value">{{$leather_inventory->lot_no}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Quantity on Hand:</span>
                                <span class="details-value">{{$leather_inventory->quantity_on_hand}}</span>
                            </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
