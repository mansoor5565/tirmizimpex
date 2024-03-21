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
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create</h5>
                        <form action="/purchase_leather" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                
                                <label for="leatherSelect" class="form-label">Choose Leather</label>
                                <select class="form-select mb-2" id="leatherSelect" name="leather[]" multiple>
                                    @foreach ($leathers_color as $leather_color)
                                        <option value="{{ $leather_color->id }}" data-quantity="{{ $leather_color->quantity }}">{{ $leather_color->leathers->type.' '.$leather_color->color }}</option>
                                    @endforeach
                                </select>
                                <span class='text-danger'>
                                    @error('leather')
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
                                    @foreach($leathervendor as $vendor)
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    
@endsection
