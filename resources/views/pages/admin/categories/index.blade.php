@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!--page heading-->
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 font-weight-bold mb-4 text-gray-800">Kategori</h1>
        <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>


    <!-- DataTables data kategori tempat-->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id_category) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('category.destroy', $category->id_category) }}" method="post" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn">

                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End DataTables -->
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
    console.log('{{ session('error') }}');
    console.log('{{ session('success') }}');
    console.log('Hello');
</script>


@endsection

