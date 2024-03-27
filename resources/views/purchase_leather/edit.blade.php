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
    </div>
    <style>
        .leather-tag {
            text-decoration: none;
            color: #4154f1;
            cursor: pointer;
        }

        .leather-tag.disabled {
            color: gray;
            cursor: text;
        }
    </style>
    <!-- End Page Title -->
    <section class="section">
        <form action="{{ $url }}" method="POST" class="row g-3">
            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update</h5>
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($leathers_color as $leather_color)
                                        <a value="{{ $leather_color->id }}" class="leather-tag"
                                            data-leather_color_id="{{ $leather_color->id }}"
                                            onclick="show(this,{{ $leather_color->id }},'{{ $leather_color->leathers->type . ' ' . $leather_color->color }}')">
                                            {{ $leather_color->leathers->type . ' ' . $leather_color->color }}</a> <br>
                                    @endforeach
                                    <span class='text-danger'>
                                        @error('purchase')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                    <div class="selected-leather-container mt-3">
                                        <!-- Selected leather colors will be displayed here -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <select name="leather_vendors" class="form-control leather-vendor">
                                        <option value="">Select Vendor</option>
                                        @foreach ($leathervendor as $vendor)
                                            <option value="{{ $vendor->id }}"
                                                {{ $purchase_leather->where('leather_vendor_id', $vendor->id) ? 'selected' : '' }}>
                                                {{ $vendor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class='text-danger'>
                                        @error('leather_vendors')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3" id="purchase-cost-quantity-option-div">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="d-none">
        @foreach ($totalPurchaseData as $singlePurchase)
            <a value="{{ $singlePurchase->id }}" class=""
                data-leather_color_id="{{ $singlePurchase->leather_color_id }}"
                onclick="showAlready(this,{{ $singlePurchase->leather_color_id }},'{{ $singlePurchase->leatherColors->leathers->type . ' ' . $singlePurchase->leatherColors->color }}',{{ $singlePurchase->cost_per_unit }},{{ $singlePurchase->quantity }})">
                {{ $singlePurchase->leatherColors->leathers->type . ' ' . $singlePurchase->leatherColors->color }}</a>
        @endforeach
    </div>
    <script>
        let selected_leather_color_id = [];
        modelDiv = $('#purchase-cost-quantity-option-div');

        function show(element, leather_color_id, leather_name) {
            if (selected_leather_color_id.includes(leather_color_id)) {
                swal("Already Selected!", "Already Selected", "warning");
                return;
            }

            selected_leather_color_id.push(leather_color_id);
            var index = selected_leather_color_id.indexOf(leather_color_id);
            const optionsDiv = $('<div>').addClass('options').addClass('col-12');

            const leatherHTML = `
                        <div class="selected-leather col-12" data-id="${leather_color_id}">
                            ${leather_name}: 
                            <input type="number" name="purchase[${leather_color_id}][leather_color_id]" class="form-control d-none leather-quantity mb-2 mt-2" value='${leather_color_id}'>
                            <input type="number" name="purchase[${leather_color_id}][quantity]" class="form-control leather-quantity mb-2 mt-2" placeholder="Quantity">
                            <input type="number" name="purchase[${leather_color_id}][cost]" class="form-control leather-cost mb-2 mt-2" placeholder="Cost">
                            <button type="button" class="btn btn-danger cancel-btn" onclick="cancelLeatherSelection(this, '${leather_color_id}')"><i class="bi bi-trash"></i></button>
                        </div>
                `;
            modelDiv.append(leatherHTML);
            $(element).addClass('disabled');
        }

        function cancelLeatherSelection(button, leather_color_id) {
            var selectedLeatherDiv = $(button).closest('.selected-leather');
            var leatherId = selectedLeatherDiv.data('id');

            selectedLeatherDiv.remove();

            var index = selected_leather_color_id.indexOf(leatherId);
            selected_leather_color_id.splice(index, 1);
            $(`a[data-leather_color_id="${leather_color_id}"]`).removeClass('disabled');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.d-none a').each(function() {
                var leatherColorId = $(this).data('leather_color_id');
                $(this).click();
            });
        });
        function showAlready(element, leather_color_id, leather_name, quantity, cost) {
            if (selected_leather_color_id.includes(leather_color_id)) {
                swal("Already Selected!", "Already Selected", "warning");
                return;
            }

            selected_leather_color_id.push(leather_color_id);
            var index = selected_leather_color_id.indexOf(leather_color_id);
            const optionsDiv = $('<div>').addClass('options').addClass('col-12');

            const leatherHTML = `
                        <div class="selected-leather col-12" data-id="${leather_color_id}">
                            ${leather_name}: 
                            <input type="number" name="purchase[${leather_color_id}][leather_color_id]" class="form-control d-none leather-quantity mb-2 mt-2" value='${leather_color_id}'>
                            <input type="number" name="purchase[${leather_color_id}][quantity]" class="form-control leather-quantity mb-2 mt-2" placeholder="Quantity" value='${quantity}'>
                            <input type="number" name="purchase[${leather_color_id}][cost]" class="form-control leather-cost mb-2 mt-2" placeholder="Cost" value='${cost}'>
                            <button type="button" class="btn btn-danger cancel-btn" onclick="cancelLeatherSelection(this, '${leather_color_id}')"><i class="bi bi-trash"></i></button>
                        </div>
                `;
            modelDiv.append(leatherHTML);
            $(element).addClass('disabled');
        }
    </script>
@endsection
