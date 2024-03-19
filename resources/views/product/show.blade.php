@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
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
                        <h5 class="card-title">Product Details</h5>
                        <div class="col-12">
                            <div class="details-container">
                              <div class="details-row">
                                <span class="details-label">Name:</span>
                                <span class="details-value">{{$product->name }}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Model NO:</span>
                                <span class="details-value">{{$product->model_no }}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Notes:</span>
                                <span class="details-value">{{$product->notes }}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Image:</span>
                                <span class="details-value">
                                    <img src="{{ asset('product_pictures/' . $product->image) }}" width="90px" height="90px" alt="image">
                                </span>
                                
                            </div>
                            <div class="details-row">
                                <span class="details-label">Cutting Cost:</span>
                                <span class="details-value">{{$product->cutting_cost}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Stitching Cost:</span>
                                <span class="details-value">{{$product->stitching_cost}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Size:</span>
                                <span class="details-value">{{$productsize->size}}</span>
                            </div>
                            <div class="details-row">
                                <span class="details-label">Accessories Quantity:</span>
                                @if($productaccessories)
                                <span class="details-value">{{$productaccessories->Accessories->name .'  '.$productaccessories->quantity}}</span>
                            @endif
                            </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
