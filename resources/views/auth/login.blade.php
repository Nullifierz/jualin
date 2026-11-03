@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-header bg-warning border-0 py-4" style="border-radius: 20px 20px 0 0;">
                    <div class="text-center">
                        <img src="{{ asset('frontend/logo.png') }}" alt="Jualin Logo" class="w-50">
                    </div>
                </div>
                
                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control"
                                    name="email" value="{{ old('email') }}">
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control"
                                    name="password">
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-75 fw-bold py-2 my-3">
                                MASUK <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }
    
    .card:hover {
        transform: scale(1.0);
    }
    
    .form-control:focus {
        border-color: #ffcc00 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 204, 0, 0.25) !important;
    }
    
    .btn-warning:hover {
        background: #e6b800 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 204, 0, 0.3) !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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