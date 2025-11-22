@extends('layout.admin')
@section('title', 'Specifications')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <!-- Tombol kembali -->
        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
            <a class="mx-4 my-4" href="{{ route('specifications.index', $electric_car->id) }}">
                <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                    data-bs-toggle="tooltip" title="Kembali">
                    <i class="bi bi-arrow-left fs-5 mx-1"></i>
                </button>
            </a>
            <h4 class="fw-bold d-flex align-items-center my-4">
                Edit Specification
                <i class="bx bx-cog mx-2 text-primary" style="font-size: 1.5rem;"></i>
            </h4>
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

                <form action="{{ route('specifications.update', [$electric_car->id, $specifications->id]) }}" 
                        method="POST">
                        @csrf
                        @method('PUT')

                        {{-- SECTION (Dropdown) --}}
                        <div class="mb-3">
                            <label class="form-label">Section</label>
                            <select name="section" class="form-control" required>
                                <option value="">-- Pilih Section --</option>

                                <option value="dimension"
                                    {{ old('section', $specifications->section) == 'dimension' ? 'selected' : '' }}>
                                    Dimension
                                </option>

                                <option value="main_battery_powertrain"
                                    {{ old('section', $specifications->section) == 'main_battery_powertrain' ? 'selected' : '' }}>
                                    Main Battery & Powertrain
                                </option>

                                <option value="exterior"
                                    {{ old('section', $specifications->section) == 'exterior' ? 'selected' : '' }}>
                                    Exterior
                                </option>

                                <option value="interior"
                                    {{ old('section', $specifications->section) == 'interior' ? 'selected' : '' }}>
                                    Interior
                                </option>

                                <option value="safety"
                                    {{ old('section', $specifications->section) == 'safety' ? 'selected' : '' }}>
                                    Safety
                                </option>

                                <option value="convenience_multimedia"
                                    {{ old('section', $specifications->section) == 'convenience_multimedia' ? 'selected' : '' }}>
                                    Convenience & Multimedia
                                </option>
                            </select>

                        @error('section')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $specifications->title) }}"
                            required>

                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- VALUE --}}
                    <div class="mb-3">
                        <label class="form-label">Value</label>
                        <textarea name="value"
                            class="form-control"
                            rows="3"
                            required>{{ old('value', $specifications->value) }}</textarea>

                        @error('value')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('specifications.index', $electric_car->id) }}" 
                           class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>



@include('sweetalert::alert')
@endsection
