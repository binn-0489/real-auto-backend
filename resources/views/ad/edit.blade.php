@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('ad.update', $ad->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="brand_id" class="form-label">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ $ad->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->title }}
                        </option>
                    @endforeach
                </select>
                <label for="model" class="form-label">Model</label>
                <input type="text" name="model" class="form-control" id="model" value="{{ $ad->model }}">
                @error('model')
                <p class="text-danger"> {{ $message }}</p>
                @enderror
                <label for="generation" class="form-label">Generation</label>
                <input type="text" name="generation" class="form-control" id="generation" value="{{ $ad->generation }}">
                @error('generation')
                <p class="text-danger"> {{ $message }}</p>
                @enderror
                <label for="year" class="form-label">Year</label>
                <input type="number" name="year" class="form-control" id="year" value="{{ $ad->year }}">
                @error('year')
                <p class="text-danger"> {{ $message }}</p>
                @enderror
            </div>
            <div>
                <h3>Images</h3>

                @foreach($ad->images as $image)
                    <div class="image-block" style="display:inline-block; margin:10px;">
                        <img src="{{ asset('storage/' . $image->path) }}" width="150">

                        <button type="button" class="btn btn-danger delete-image" data-id="{{$image->id}}">Delete</button>
                    </div>
                @endforeach
                <div>
                    <label>Добавить новые изображения</label>
                    <input type="file" id='images' class="form-control" name="images[]" accept=".jpg,.jpeg,.png" multiple>
                    </div>  
            </div>

            <button type="submit" class = "btn btn-primary">Update</button>
        </form>
    </div>


<script>
console.log('script loaded');
document.querySelectorAll('.delete-image').forEach(button => {
    button.addEventListener('click', function () {

        const imageId = this.dataset.id;
        const block = this.closest('.image-block');

        if (!confirm('Удалить изображение?')) return;

        fetch(`/ad_images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'ok') {
                block.remove(); // удаляем картинку со страницы
            }
        })
        .catch(error => console.error(error));
    });
});
</script>



@endsection