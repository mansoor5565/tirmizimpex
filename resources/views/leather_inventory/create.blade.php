@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Leather Inventory</h1>
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
                        <form action="/leather_inventory" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <div class="search-container">
                                    <span class="search-icon">&#128269;</span>
                                    <input type="text" id="searchInput" placeholder="Search...">
                                </div>
                                
                                <label for="selectLeathers" class="form-label">Choose Leathers</label>
                                <select class="form-select mb-2" id="selectLeathers" name="leathers[]" multiple>
                                    @foreach ($leathercolor as $leathercolors)
                                        <option value="{{ $leathercolors->id }}">{{ $leathercolors->leathers->type ." ". $leathercolors->color }}</option>
                                    @endforeach
                                </select>
                                <span class='text-danger'>
                                    @error('leathers')
                                        {{ $message }}
                                    @enderror
                                </span>
                                
                                <div class="selected-leathers-container">
                                
                                </div>                                
                            </div>
                            {{-- <div class="col-12">
                                <label for="cost_per_unit" class="form-label">Quantity On Hand</label>
                                <input type="number" name="quantity_on_hand" class="form-control" id="cost_per_unit">
                                <span class='text-danger'>
                                    @error('quantity_on_hand')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}
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
            const selectLeathers = document.getElementById('selectLeathers');
            const selectedLeathersContainer = document.querySelector('.selected-leathers-container');
            const searchInput = document.getElementById('searchInput');
            let selectedLeathers = []; // Array to store selected leathers
    
            // Add event listener to each option element
            selectLeathers.querySelectorAll('option').forEach(option => {
                option.addEventListener('click', function() {
                    const leatherName = option.textContent;
                    const leatherId = option.value;
                    const index = selectedLeathers.findIndex(leather => leather.id === leatherId);
    
                    if (option.selected && index === -1) {
                        selectedLeathers.push({
                            id: leatherId,
                            name: leatherName,
                            quantity: 1
                        });
                    } else if (!option.selected && index !== -1) {
                        selectedLeathers.splice(index, 1);
                    }
    
                    updateSelectedLeathers();
                });
            });
    
            function updateSelectedLeathers() {
                selectedLeathersContainer.innerHTML = ''; // Clear the container
    
                selectedLeathers.forEach(leather => {
                    const leatherHTML = `
                        <div class="selected-leather" data-id="${leather.id}">
                            ${leather.name}: <input type="number" name="leather_quantities[]" class="form-control leather-quantity" value="${leather.quantity}">
                            <button type="button" class="btn btn-danger cancel-btn" onclick="cancelLeatherSelection(this)"><i class="bi bi-trash"></i></button>
                        </div>
                    `;
                    selectedLeathersContainer.innerHTML += leatherHTML;
                });
            }
    
            searchInput.addEventListener('input', function() {
                const filter = searchInput.value.toLowerCase();
                const options = selectLeathers.getElementsByTagName('option');
                for (let i = 0; i < options.length; i++) {
                    const option = options[i];
                    const text = option.textContent.toLowerCase();
                    const display = text.indexOf(filter) > -1 ? 'block' : 'none';
                    option.style.display = display;
                }
            });
    
            window.cancelLeatherSelection = function(buttonElement) {
                const selectedLeatherDiv = buttonElement.parentElement;
                const leatherId = selectedLeatherDiv.dataset.id;
                const index = selectedLeathers.findIndex(leather => leather.id === leatherId);
                if (index !== -1) {
                    selectedLeathers.splice(index, 1);
                    selectedLeatherDiv.remove(); // Remove the selected leather from the container
                }
            };
        });
    </script>
@endsection
