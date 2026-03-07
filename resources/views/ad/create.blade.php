@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('ad.store') }}" method="post">
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
            </div>
            <button type="submit" class = "btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
