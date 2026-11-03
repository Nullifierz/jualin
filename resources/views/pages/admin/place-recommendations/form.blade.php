@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4 w-75 mx-auto">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $page_meta['title'] }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ $page_meta['route'] }}" method="post" enctype="multipart/form-data">

                @csrf
                @method($page_meta['method'])
                
                <div class="form-group">
                    <label for="name">Nama Tempat</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $placeRecommendation->name) }}">
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $placeRecommendation->address) }}">
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $placeRecommendation->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <div class="row mx-3">
                        @foreach($categories as $category)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="form-check h-100">
                                    <input class="form-check-input" 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="{{ $category->id_category }}" 
                                        id="category-{{ $category->id_category }}"
                                        {{ in_array($category->id_category, old('categories', $placeRecommendation->categories->pluck('id_category')->toArray())) ? 'checked' : '' }}>
                                    <label class="form-check-label stretched-link" for="category-{{ $category->id_category }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $placeRecommendation->latitude) }}">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $placeRecommendation->longitude) }}">
                </div>
                <div class="form-group">
                    <div class="d-flex flex-column align-items-center">
                        <img class="w-50" src="{{ asset('storage/' . $placeRecommendation->image) }}" alt="Gambar Tempat Rekomendasi" class="img-fluid mt-2">
                    </div>
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control" id="image" name="image">

                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    }
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}');
    @endif  

    @if(session()->has('error'))
        toastr.error('{{ session('error') }}');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif


    console.log('{{ session('success') }}');
</script>
@endsection
