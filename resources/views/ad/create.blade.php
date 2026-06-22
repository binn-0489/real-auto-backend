@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('ad.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="brand_id" class="form-label">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->title }}
                        </option>
                    @endforeach
                </select>

                <label for="model" class="form-label">Model</label>
                <input type="text" name="model" class="form-control" id="model" value="{{ old('model') }}">
                @error('model')
                <p class="text-danger"> {{ $message }}</p>
                @enderror
                <label for="generation" class="form-label">Generation</label>
                <input type="text" name="generation" class="form-control" id="generation" value="{{ old('generation') }}">
                @error('generation')
                <p class="text-danger"> {{ $message }}</p>
                @enderror
                <label for="year" class="form-label">Year</label>
                <input type="number" name="year" class="form-control" id="year" value="{{ old('year') }}">
                @error('year')
                <p class="text-danger"> {{ $message }}</p>
                @enderror
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
                @error('price')
                <p class="text-danger"> {{ $message }}</p>
                @enderror





















                <label for="images" class="form-label">Photos</label>
                <input type="file" id='images' class="form-control" name="images[]" accept=".jpg,.jpeg,.png" multiple>
                
                <input type="radio" name="main_image" value="0">
                <input type="radio" name="main_image" value="1">
                <!--<label class="input-group-text" for="inputGroupFile02">Upload</label>-->

                <!--<input type="file" name='images[]' accept=".jpg,.jpeg,.png" multiple>-->

            </div>
            <button type="submit" class = "btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
