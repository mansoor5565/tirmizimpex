@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Form Layouts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Layouts</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<style>
    .container {
        display: flex;
        flex-wrap: wrap;
    }
    .image {
        position: relative;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .image img {
        max-width: 100px;
        max-height: 100px;
        display: block;
    }
    .image span {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: #fff;
        border-radius: 50%;
        padding: 2px 5px;
        cursor: pointer;
    }
</style>
<section class="section">
    <form action="{{$url}}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Form</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputName4" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="inputName4" name="name" value="{{$product->name}}">
                            <span class='text-danger'>
                                @error('name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        
                        <div class="col-12">
                            <label for="inputModel4" class="form-label">Model No</label>
                            <input type="text" class="form-control" id="inputModel4" name="model_no" value="{{$product->model_no}}">
                            <span class='text-danger'>
                                @error('model_no')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="col-12">
                            <label for="selectSizes" class="form-label">Select Size Options:</label><br>
<div class="row">
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="option1" name="option[]" value="S" {{ $productsize->contains('size', 'S') ? 'checked' : '' }}>
            <label class="form-check-label" for="option1">S</label>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="option2" name="option[]" value="M" {{ $productsize->contains('size', 'M') ? 'checked' : '' }}>
            <label class="form-check-label" for="option2">M</label>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="option3" name="option[]" value="L" {{ $productsize->contains('size', 'L') ? 'checked' : '' }}>
            <label class="form-check-label" for="option3">L</label>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="option4" name="option[]" value="XL" {{ $productsize->contains('size', 'XL') ? 'checked' : '' }}>
            <label class="form-check-label" for="option4">XL</label>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="option4" name="option[]" value="XXL" {{ $productsize->contains('size', 'XXL') ? 'checked' : '' }}>
            <label class="form-check-label" for="option4">XXL</label>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="option4" name="option[]" value="XXXL" {{ $productsize->contains('size', 'XXXL') ? 'checked' : '' }}>
            <label class="form-check-label" for="option4">XXXL</label>
        </div>
    </div>
</div>

                        </div>                        
                        <div class="col-12">
                            <label for="inputNotes4" class="form-label">Notes</label>
                            <input type="text" name="notes" class="form-control" id="inputNotes4" value="{{$product->notes}}">
                            <span class='text-danger'>
                                @error('notes')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        {{-- <div class="col-12">
                            <label for="name" class="form-label">Venue</label>
                            <input type="text" class="form-control" id="" name="venue">
                            <span class='text-danger'>
                                @error('venue')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> --}}
                        
                        <div class="col-12">
                            <label for="inputCuttingCost4" class="form-label">Cutting Cost</label>
                            <input type="number" name="cutting_cost" class="form-control" id="inputCuttingCost4" value="{{$product->cutting_cost}}">
                            <span class='text-danger'>
                                @error('cutting_cost')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="col-12">
                            <label for="inputStitchingCost4" class="form-label">Stitching Cost</label>
                            <input type="number" name="stitching_cost" class="form-control" id="inputStitchingCost4" value="{{$product->stitching_cost}}">
                            <span class='text-danger'>
                                @error('stitching_cost')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="col-12">
                            <label for="leatherSelect" class="form-label">Choose Leather</label>
                            <select class="form-select mb-2" id="leatherSelect" name="leather">
                                
                                @foreach ($leathers_color as $leather_color)
                                    <option value="{{ $leather_color->id }}" {{ $product_leather->contains('productcolor_id', $leather_color->id) ? 'selected' : '' }}>
                                        {{ $leather_color->leathers->type.' '.$leather_color->color }}
                                    </option>
                                @endforeach
                            </select>
                            <span class='text-danger'>
                                @error('leather')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div id="selectedLeathers" class="selected-items-container"></div>
                                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Image Form</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputImage2" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="inputImage2" onchange="previewImage(this)">
    <span class='text-danger'>
        @error('image')
        {{$message}}
        @enderror
    </span>
    <div class="container" id="imagePreview">
        
    </div>

    <div class="col-12">
        <label for="inputMultipleImages2" class="form-label">Multiple Images</label>
        <input type="file" name="file[]" multiple="multiple" class="form-control" id="inputMultipleImages2" onchange="previewMultipleImages(this)">
        <span class='text-danger'>
            @error('notes')
            {{$message}}
            @enderror
        </span>
        <div class="container" id="multipleImagesPreview">
            
        </div>
    </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Accessories Form</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="selectAccessories" class="form-label">Choose Accessories</label>
                            <select class="form-select" id="selectAccessories" name="accessories[]" multiple>
                                @foreach($accessories as $accessory)
                                    <option value="{{ $accessory->id }}" {{ $productaccessories->contains('accessories_id', $accessory->id) ? 'selected' : '' }}>
                                        {{ $accessory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class='text-danger'>
                                @error('accessories')
                                {{$message}}
                                @enderror
                            </span>
                            
                            <div class="selected-accessories-container">
                                <!-- Selected accessories will be displayed here -->
                            </div>
                            
                            <input type="hidden" id="productId" value="{{ $id }}">
                            
                        </div>                                                
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</section>
<script>
    function previewImage(input) {
        var container = document.getElementById('imagePreview');
        container.innerHTML = ''; // Clear previous preview

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                container.innerHTML = `<div class="image">
                                        <img src="${e.target.result}" alt="preview">
                                        <span onclick="cancelImageSelection(this)">x</span>
                                    </div>`;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewMultipleImages(input) {
        var container = document.getElementById('multipleImagesPreview');
        container.innerHTML = ''; // Clear previous preview

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    container.innerHTML += `<div class="image">
                                                <img src="${e.target.result}" alt="preview">
                                                <span onclick="cancelImageSelection(this)">x</span>
                                            </div>`;
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    function cancelImageSelection(spanElement) {
        var container = spanElement.parentElement;
        container.remove(); // Remove the image preview
        var inputElement = container.parentElement.previousElementSibling;
        inputElement.value = ''; // Reset the input file
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAccessories = document.getElementById('selectAccessories');
        const selectedAccessoriesContainer = document.querySelector('.selected-accessories-container');
        const searchInput = document.getElementById('searchInput');
        let selectedAccessories = []; // Array to store selected accessories

        // Add event listener to each option element
        selectAccessories.querySelectorAll('option').forEach(option => {
            option.addEventListener('click', function() {
                const accessoryName = option.textContent;
                const accessoryId = option.value;
                const index = selectedAccessories.findIndex(accessory => accessory.id ===
                    accessoryId);

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
                    <button type="button" class="btn btn-danger cancel-btn" onclick="cancelAccessorySelection(this)"><i class="bi bi-trash"></i></button>
                </div>
            `;
                selectedAccessoriesContainer.innerHTML += accessoryHTML;
            });
        }

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            const options = selectAccessories.getElementsByTagName('option');
            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const text = option.textContent.toLowerCase();
                const display = text.indexOf(filter) > -1 ? 'block' : 'none';
                option.style.display = display;
            }
        });

        window.cancelAccessorySelection = function(buttonElement) {
            const selectedAccessoryDiv = buttonElement.parentElement;
            const accessoryId = selectedAccessoryDiv.dataset.id;
            const index = selectedAccessories.findIndex(accessory => accessory.id === accessoryId);
            if (index !== -1) {
                selectedAccessories.splice(index, 1);
                selectedAccessoryDiv.remove(); 
            }
        };
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const leatherSelect = document.getElementById('leatherSelect');
        const selectedLeathersContainer = document.getElementById('selectedLeathers');
        let selectedLeather = null;

        leatherSelect.addEventListener('change', function() {
            const selectedOption = leatherSelect.options[leatherSelect.selectedIndex];
            const leatherId = selectedOption.value;
            const leatherName = selectedOption.textContent;
            selectedLeather = { id: leatherId, name: leatherName };

            updateSelectedLeathers();
        });

        function updateSelectedLeathers() {
            selectedLeathersContainer.innerHTML = ''; // Clear the container

            if (selectedLeather !== null) {
                const leatherItem = document.createElement('div');
                leatherItem.classList.add('selected-item');
                leatherItem.textContent = selectedLeather.name;
                const cancelButton = document.createElement('button');
                cancelButton.type = 'button';
                cancelButton.classList.add('btn', 'btn-danger', 'cancel-btn');
                cancelButton.textContent = 'Cancel';
                cancelButton.addEventListener('click', cancelLeatherSelection);
                leatherItem.appendChild(cancelButton);
                selectedLeathersContainer.appendChild(leatherItem);
            }
        }

        function cancelLeatherSelection() {
            selectedLeather = null;
            updateSelectedLeathers();
        }
    });
</script>
@endsection
