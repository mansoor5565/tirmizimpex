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
                            <label for="selectSizes" class="form-label">Select Leather Size Options:</label><br>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllLeatherSize">
                                        <label class="form-check-label" for="selectAllLeatheSize">Select All leather
                                            Size</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option1" name="option[]"
                                            value="XS" {{ $productsize->contains('size', 'XS') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option1">XS</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option2" name="option[]"
                                            value="S" {{ $productsize->contains('size', 'S') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option2">S</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option3" name="option[]"
                                            value="M" {{ $productsize->contains('size', 'M') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option3">M</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option4" name="option[]"
                                            value="L" {{ $productsize->contains('size', 'L') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option4">L</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option5" name="option[]"
                                            value="XL" {{ $productsize->contains('size', 'XL') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option5">XL</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option5" name="option[]"
                                            value="2XL" {{ $productsize->contains('size', '2XL') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option6">2XL</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option6"
                                            name="option[]" value="3XL" {{ $productsize->contains('size', '3XL') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option6">3XL</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="selectAllJeanSize" class="form-label">Select Jeans Size Options:</label><br>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllJeanSize">
                                    <label class="form-check-label" for="selectAllSizes">Select All Jean Size</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option7"
                                            name="option[]" value="28" {{ $productsize->contains('size', '28') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option7">28</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option8"
                                            name="option[]" value="30" {{ $productsize->contains('size', '30') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option8">30</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option9"
                                            name="option[]" value="32" {{ $productsize->contains('size', '32') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option9">32</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option10"
                                            name="option[]" value="34" {{ $productsize->contains('size', '34') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option10">34</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option11"
                                            name="option[]" value="36" {{ $productsize->contains('size', '36') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option11">36</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option12"
                                            name="option[]" value="38" {{ $productsize->contains('size', '38') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option12">38</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option13"
                                            name="option[]" value="40" {{ $productsize->contains('size', '40') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option13">40</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option14"
                                            name="option[]" value="42" {{ $productsize->contains('size', '42') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option14">42</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option15"
                                            name="option[]" value="44" {{ $productsize->contains('size', '44') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option15">44</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="selectSizes" class="form-label">Custom Option:</label><br>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option5"
                                            name="option[]" value="Custom" {{ $productsize->contains('size', 'Custom') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option16">Custom</label>
                                    </div>
                                </div>
                                <span class='text-danger'>
                                    @error('option')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    @push('script')
                        <script>
                            $(document).ready(function() {
                                var leathercheckbox = $('input[name="option[]"]').slice(0, 7);
                                var jeanscheckbox = $('input[name="option[]"]').slice(7, 7 + 9);
                                $('#selectAllJeanSize').change(function() {
                                    if ($(this).is(':checked')) {
                                        $('input[name="option[]"]:last').prop('checked', false);
                                        jeanscheckbox.prop('checked', true);
                                    } else {
                                        jeanscheckbox.prop('checked', false);
                                    }
                                });
                                $('#selectAllLeatherSize').change(function() {
                                    if ($(this).is(':checked')) {
                                        $('input[name="option[]"]:last').prop('checked', false);
                                        leathercheckbox.prop('checked', true);
                                    } else {
                                        leathercheckbox.prop('checked', false);
                                    }
                                });
                                $('input[name="option[]"]:last').change(function() {
                                    $('#selectAllJeanSize').prop('checked', false);
                                    $('#selectAllLeatherSizee').prop('checked', false);
                                    jeanscheckbox.prop('checked', false);
                                    leathercheckbox.prop('checked', false);
                                })
                            });
                        </script>
                    @endpush
                                               
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
                                @error('images')
                                @enderror
                                @include('components.multiple-image-picker-create')
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
