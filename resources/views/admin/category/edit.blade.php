@extends('layout.admin')
@section('title', 'Edit')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <!-- Tombol Kembali -->
                <a class="mx-4 my-4" href="{{ route('category.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>
            </div>

            <div class="card-body">
                <div class="text-nowrap">

                    {{-- Tampilkan error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('category.update', $categorys->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row justify-content-center">

                            <!-- Kolom kiri (Nama Category) -->
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama Category</label>
                                    <input type="text" name="name_category" class="form-control"
                                        value="{{ old('name_category', $categorys->name_category) }}">
                                    @error('name_category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom kanan (Posisi Category) -->
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Posisi Kategori</label>
                                    <select name="category_position" class="form-select">
                                        <option value="">-- Pilih Posisi --</option>
                                        <option value="vehicle"
                                            {{ old('category_position', $categorys->category_position) == 'vehicle' ? 'selected' : '' }}>
                                            Vehicle
                                        </option>
                                        <option value="electric"
                                            {{ old('category_position', $categorys->category_position) == 'electric' ? 'selected' : '' }}>
                                            Electric
                                        </option>
                                        <option value="smart_home"
                                            {{ old('category_position', $categorys->category_position) == 'smart home' ? 'selected' : '' }}>
                                            Smart Home
                                        </option>
                                        <option value="aksesoris_cadang_ev"
                                            {{ old('category_position', $categorys->category_position) == 'aksesoris cadang_ev' ? 'selected' : '' }}>
                                            Aksesoris & Suku Cadang EV
                                        </option>
                                    </select>

                                    @error('category_position')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <!-- BUTTON -->
                            <div class="text-end mt-4">
                                <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
