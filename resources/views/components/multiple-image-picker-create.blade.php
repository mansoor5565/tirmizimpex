<style>
    .img-card {
        width: auto !important;

        .top {
            display: flex;
            justify-content: space-between;
        }
    }
    .img-card .top {
            display: flex;
            justify-content: space-between;
        }
    .img-container {
        width: 400px;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        position: relative;
        height: auto;
        max-height: 300px;
        overflow-y: auto;
    }

    .img-container .image {
        height: 85px;
        position: relative;
        width: 85px;
        border-radius: 5px;
    }

    .img-container .image img {
        height: 100%;
        width: 100%;
    }

    .img-container .image span {
        position: absolute;
        top: -4px;
        right: 5px;
        cursor: pointer;
        font-size: 22px;
        color: #fff;
        font-weight: 700;
        background-color: transparent;
    }
</style>
<div class="img-card">
    <div class="top">
        <p class="my-auto">Upload Image</p>
        <button type="button" class="btn-primary btn">Upload</button>
    </div>
</div>
<input type="file" name="images[]" class="images d-none" multiple style="display: none">
<input type="file" name="file[]" class="file d-none" multiple>
<div class="img-container">
    <div class="image">
        
    </div>
</div>
<script>
    let files = [];
    button = document.querySelector('.top button');
    container = document.querySelector('.img-container');
    input = document.querySelector('.file');
    images = document.querySelector('.images');
    button.addEventListener('click', () => input.click());
    input.addEventListener('change', () => {
        let file = input.files;
        for (let i = 0; i < file.length; i++) {
            if (files.every(e => e.name != file[i].name)) {
                files.push(file[i]);
            }
        }
        // form.reset();
        input.value = "";
        showImages();
        addFilesToImagesInput();
    })
    const showImages = () => {
        let images = '';
        files.forEach((e, i) => {
            images += `<div class="image">
                    <img src="${URL.createObjectURL(e)}" alt="afd">
                    <span onclick="delImage(${i})"><i class="bi bi-x-circle-fill text-danger"></i></span>
                </div>`;
        })
        container.innerHTML = images;
    }
    const delImage = index => {
        files.splice(index, 1);
        showImages();
        addFilesToImagesInput();
    }
    const addFilesToImagesInput = () => {
        const dt = new DataTransfer();
        files.forEach(file => {
            dt.items.add(file);
        });
        images.files = dt.files;
    }
</script>