@extends('layout.admin')
@section('title', 'Content')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center my-4">

            <h4 class="fw-bold d-flex align-items-center mb-0">
                <i class="bx bx-category me-3 text-primary" style="font-size: 1.5rem;"></i>
                <span>Master Home</span>
            </h4>
        </div>

        <div class="col-xl-12">

            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">

                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                            <i class="menu-icon tf-icons bx bx-home"></i>
                            Home
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                            <i class="menu-icon tf-icons bx bx-comment-detail"></i>
                            Testimonial
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="mb-0">
                            <p class="text-muted mb-0 small">First Section</p>
                            <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                                About Us First Content *
                            </span>

                            <div class="col-md-12">
                                <label class="form-label">About Title</label>
                                <textarea name="title" class="form-control" rows="2" placeholder="Masukkan judul konten">{{ old('title', $content->title ?? '') }}</textarea>
                                @error('title')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label mt-2">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('description', $content->description ?? '') }}</textarea>

                                @error('description')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <p class="text-muted mb-0 small ">Second Section</p>
                            <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1">
                                Why Choose Us content *
                            </span>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> First Title Why Choose Us</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('title', $content->title ?? '') }}">
                                        @error('title')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('description', $content->description ?? '') }}</textarea>
                                        @error('description')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> Second Title Why Choose Us</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('title', $content->title ?? '') }}">
                                        @error('title')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('description', $content->description ?? '') }}</textarea>

                                        @error('description')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> Third Title Why Choose Us</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('title', $content->title ?? '') }}">
                                        @error('title')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <textarea name="description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('description', $content->description ?? '') }}</textarea>

                                        @error('description')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <p class="text-muted mb-0 small ">Third Section</p>
                            <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1">
                                Collaboration content *
                            </span>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label">Customer</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('title', $content->title ?? '') }}">
                                        @error('title')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> Customer Happy</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('title', $content->title ?? '') }}">
                                        @error('title')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mb-3 mt-4">
                            <button type="reset" class="btn btn-outline-secondary d-flex align-items-center">
                                <i class="bx bx-reset me-2"></i>
                                <span>Reset</span>
                            </button>

                            <button type="button" class="btn btn-outline-success d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#addCarModal">
                                <i class="bx bx-save "></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                        <div class="mb-0">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Judul -->
                                <span class="text-dark fw-semibold fs-6">
                                    Master Testimoni *
                                </span>

                                <!-- Tombol -->
                                <button type="button" class="btn btn-outline-success d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#addCarModal">
                                    <i class="bx bx-plus me-2"></i>
                                    <span>Tambah</span>
                                </button>
                            </div>

                            <!-- modal placeholder removed from inside tab to avoid nested tab issues -->

                            <div class="table-responsive text-nowrap">
                                <!-- Table Data -->
                                <table id="newsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5px;">No</th>
                                            <th>Name</th>
                                            <th>Message</th>
                                            <th>Profil Picture</th>
                                            <th>Status</th>
                                            <th style="width: 100px; text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($contacts as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->subject }}</td>
                                                        <td>{{ $item->created_at->format('d F Y, H:i') }} WIB</td>
                                                        <td class="text-center">

                                                            <a href="{{ url('Contact-show/' . $item->id) }}"
                                                                class="btn btn-icon btn-outline-info" title="Detail">
                                                                <i class="bx bx-show"></i>
                                                            </a>

                                                            <a href="javascript:void(0)"
                                                                onclick="confirmDeletecontact('{{ $item->id }}', '{{ $item->name }}')">
                                                                <button class="btn btn-icon btn-outline-danger"
                                                                    title="Hapus">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach --}}
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- Global Add Modal (outside tab content) -->
    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarModalLabel">Tambah Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="3">{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control">
                            @error('profile_picture')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">-- Select Status --</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
