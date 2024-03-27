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
        <div class="row">
            <form action="/purchase_leather" method="POST" class="row g-3">
                @csrf
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create</h5>

                            <div class="row g-3">
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
                                            <option value="{{ $vendor->id }}">
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


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
<<<<<<< HEAD
=======

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3" id="purchase-cost-quantity-option-div">

>>>>>>> 68158388dd0e4a8947bdb9fcd479fbeeffe7eef0
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        let selected_leather_color_id = [];
        modelDiv = $('#purchase-cost-quantity-option-div');

<<<<<<< HEAD
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectLeather = document.getElementById('leatherSelect');
            const selectedLeatherContainer = document.querySelector('.selected-leather-container');
            let selectedLeather = []; // Array to store selected leather
    
            // Add event listener to each option element
            selectLeather.querySelectorAll('option').forEach(option => {
                option.addEventListener('click', function() {
                    const leatherName = option.textContent;
                    const leatherId = option.value;
                    const leatherQuantity = option.dataset.quantity;
                    const index = selectedLeather.findIndex(leather => leather.id === leatherId);
    
                    if (option.selected && index === -1) {
                        selectedLeather.push({
                            id: leatherId,
                            name: leatherName,
                            quantity: leatherQuantity,
                            cost: '', // Initialize cost as empty string
                            vendor: '' // Initialize vendor as empty string
                        });
                    } else if (!option.selected && index !== -1) {
                        selectedLeather.splice(index, 1);
                    }
    
                    updateSelectedLeather();
                });
            });
    
            function updateSelectedLeather() {
                selectedLeatherContainer.innerHTML = ''; // Clear the container
    
                selectedLeather.forEach(leather => {
                    const leatherHTML = `
                        <div class="selected-leather" data-id="${leather.id}">
                            ${leather.name}: 
                            <input type="number" name="leather_quantities[]" class="form-control leather-quantity" placeholder="Quantity" value="${leather.quantity}">
                            <input type="number" name="leather_costs[]" class="form-control leather-cost" placeholder="Cost" value="${leather.cost}">
                            <button type="button" class="btn btn-danger cancel-btn" onclick="cancelLeatherSelection(this)"><i class="bi bi-trash"></i></button>
                        </div>
                    `;
                    selectedLeatherContainer.innerHTML += leatherHTML;
                });
            }
    
            window.cancelLeatherSelection = function(buttonElement) {
                const selectedLeatherDiv = buttonElement.parentElement;
                const leatherId = selectedLeatherDiv.dataset.id;
                const index = selectedLeather.findIndex(leather => leather.id === leatherId);
                if (index !== -1) {
                    selectedLeather.splice(index, 1);
                    selectedLeatherDiv.remove(); // Remove the selected leather from the container
                }
            };
        });
    </script>
=======
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
    <script></script>
>>>>>>> 68158388dd0e4a8947bdb9fcd479fbeeffe7eef0
@endsection
