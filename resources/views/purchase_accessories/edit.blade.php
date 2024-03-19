@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Purchase Accessories</h1>
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
                        <h5 class="card-title">Edit</h5>
                        <form action="{{$url}}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <div class="search-container">
                                    <span class="search-icon">&#128269;</span>
                                    <input type="text" id="searchInput" placeholder="Search...">
                                </div>

                                <label for="selectAccessories" class="form-label">Choose Accessories</label>
<select class="form-select mb-2" id="selectAccessories" name="accessories[]" multiple>
    @foreach ($accessories as $accessory)
        @php
            $selected = $purchase_accessories->where('accessories_id', $accessory->id)->get()->isNotEmpty();
        @endphp
        <option value="{{ $accessory->id }}" {{ !empty($selected) ? 'selected' : '' }}>
            {{ $accessory->name }}
        </option>
    @endforeach
</select>
<span class='text-danger'>
    @error('accessories')
        {{ $message }}
    @enderror
</span>

                                <div class="selected-accessories-container">

                                </div>
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
            const selectAccessories = document.getElementById('selectAccessories');
            const selectedAccessoriesContainer = document.querySelector('.selected-accessories-container');
            const accessoryCostInput = document.getElementById('accessoryCost');
            let selectedAccessories = []; // Array to store selected accessories
    
            // Add event listener to each option element
            selectAccessories.querySelectorAll('option').forEach(option => {
                option.addEventListener('click', function() {
                    const accessoryName = option.textContent;
                    const accessoryId = option.value;
                    const index = selectedAccessories.findIndex(accessory => accessory.id === accessoryId);
    
                    if (option.selected && index === -1) {
                        selectedAccessories.push({
                            id: accessoryId,
                            name: accessoryName,
                            quantity: 1
                        });
                    } else if (!option.selected && index !== -1) {
                        selectedAccessories.splice(index, 1);
                    }
    
                    updateSelectedAccessories();
                });
            });
    
            function updateSelectedAccessories() {
                selectedAccessoriesContainer.innerHTML = ''; // Clear the container
    
                selectedAccessories.forEach(accessory => {
                    const accessoryHTML = `
                    <div class="selected-accessory" data-id="${accessory.id}">
                        ${accessory.name}: <input type="number" name="accessory_quantities[]" class="form-control accessory-quantity" value="${accessory.quantity}">
                        Cost: <input type="number" name="accessory_costs[]" class="form-control accessory-cost" value="">
                        <button type="button" class="btn btn-danger cancel-btn" onclick="cancelAccessorySelection(this)"><i class="bi bi-trash"></i></button>
                    </div>
                `;
                    selectedAccessoriesContainer.innerHTML += accessoryHTML;
                });
            }
    
            accessoryCostInput.addEventListener('input', function() {
                const cost = accessoryCostInput.value;
                document.querySelectorAll('.accessory-cost').forEach(input => {
                    input.value = cost;
                });
            });
    
            window.cancelAccessorySelection = function(buttonElement) {
                const selectedAccessoryDiv = buttonElement.parentElement;
                const accessoryId = selectedAccessoryDiv.dataset.id;
                const index = selectedAccessories.findIndex(accessory => accessory.id === accessoryId);
                if (index !== -1) {
                    selectedAccessories.splice(index, 1);
                    selectedAccessoryDiv.remove(); // Remove the selected accessory from the container
                }
            };
        });
    </script>
    
@endsection
