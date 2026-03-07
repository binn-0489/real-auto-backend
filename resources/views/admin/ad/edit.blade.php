@extends('layouts.admin')
@section('content')
    <div>
        <form action="{{ route('admin.ad.update', $ad->id) }}" method="post">
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
            <button type="submit" class = "btn btn-primary">Update</button>
        </form>
    </div>
@endsection
