@extends('layout.admin')
@section('title', 'Content')
@section('content')

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

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
                                <textarea name="about_title" class="form-control" rows="2" placeholder="Masukkan judul konten">{{ old('about_title', $content->about_title ?? '') }}</textarea>
                                @error('about_title')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label mt-2">Description</label>
                                <textarea name="about_description" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('about_description', $content->about_description ?? '') }}</textarea>

                                @error('about_description')
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
                                        <input type="text" name="why_title_1" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('why_title_1', $content->why_title_1 ?? '') }}">
                                        @error('why_title_1')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="why_description_1" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('why_description_1', $content->why_description_1 ?? '') }}</textarea>
                                        @error('why_description_1')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> Second Title Why Choose Us</label>
                                        <input type="text" name="why_title_2" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('why_title_2', $content->why_title_2 ?? '') }}">
                                        @error('why_title_2')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <textarea name="why_description_2" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('why_description_2', $content->why_description_2 ?? '') }}</textarea>

                                        @error('why_description_2')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> Third Title Why Choose Us</label>
                                        <input type="text" name="why_title_3" class="form-control"
                                            placeholder="Masukkan judul konten"
                                            value="{{ old('why_title_3', $content->why_title_3 ?? '') }}">
                                        @error('why_title_3')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <textarea name="why_description_3" class="form-control" rows="4" placeholder="Masukkan deskripsi konten">{{ old('why_description_3', $content->why_description_3 ?? '') }}</textarea>

                                        @error('why_description_3')
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
                                        <input type="number" name="collaboration_customer" class="form-control"
                                            placeholder="Masukkan jumlah customer"
                                            value="{{ old('collaboration_customer', $content->collaboration_customer ?? '') }}">
                                        @error('collaboration_customer')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label"> Customer Happy</label>
                                        <input type="number" name="collaboration_customer_happy" class="form-control"
                                            placeholder="Masukkan jumlah customer happy"
                                            value="{{ old('collaboration_customer_happy', $content->collaboration_customer_happy ?? '') }}">
                                        @error('collaboration_customer_happy')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mb-3 mt-4">
                          

                            <button type="button" id="saveHomeBtn" class="btn btn-outline-success d-flex align-items-center">
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
                                <table id="testimonialsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Message</th>
                                            <th style="text-align: center;">Profil</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($testimonials as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ Str::limit($item->message, 50) }}</td>
                                                <td style="text-align: center">
                                                    @if ($item->profile_picture)
                                                        <img src="{{ asset($item->profile_picture) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $item->status ? 'Aktif' : 'Non-Aktif' }}
                                                    </span>
                                                </td>
                                                <td style="text-align: center">
                                                    <button type="button" class="btn btn-icon btn-outline-warning" 
                                                        title="Edit" 
                                                        onclick="editTestimonial({{ $item->id }}, '{{ $item->name }}', '{{ addslashes($item->message) }}', '{{ $item->profile_picture }}', {{ $item->status ? 'true' : 'false' }})">
                                                        <i class="bx bx-edit"></i>
                                                    </button>

                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDelete('{{ $item->id }}', '{{ $item->name }}')">
                                                        <button class="btn btn-icon btn-outline-danger"
                                                            title="Hapus">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    Belum ada data testimonial
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarModalLabel">Tambah Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cms.home.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Masukkan pesan">{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control" accept="image/*">
                            @error('profile_picture')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1" id="statusCheckbox" {{ old('status', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusCheckbox">
                                    Aktif
                                </label>
                            </div>
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

    <!-- Modal Edit Testimonial -->
    <div class="modal fade" id="editCarModal" tabindex="-1" aria-labelledby="editCarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCarModalLabel">Edit Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" id="editName" name="name" class="form-control" placeholder="Masukkan nama">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea id="editMessage" name="message" class="form-control" rows="3" placeholder="Masukkan pesan"></textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Current Profile Picture -->
                        <div class="mb-3" id="currentPictureDiv" style="display:none;">
                            <label class="form-label">Current Profile Picture</label>
                            <div class="mb-2">
                                <img id="currentPicture" src="" alt="Current" style="max-width: 100px; max-height: 100px; border-radius: 50%; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label class="form-label">Profile Picture (Optional)</label>
                            <input type="file" id="editProfilePicture" name="profile_picture" class="form-control" accept="image/*">
                            <small class="text-muted">Biarkan kosong untuk mempertahankan gambar saat ini</small>
                            @error('profile_picture')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="editStatus" name="status" value="1">
                                <label class="form-check-label" for="editStatus">
                                    Aktif
                                </label>
                            </div>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tampilkan SweetAlert jika ada session success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    willClose: function() {
                        // Jika ada session open_testimonial_tab, buka tab
                        @if (session('open_testimonial_tab'))
                            const testimonialTab = document.querySelector('[data-bs-target="#navs-top-profile"]');
                            if (testimonialTab) {
                                const tab = new bootstrap.Tab(testimonialTab);
                                tab.show();
                            }
                        @endif
                    }
                });
            @endif

            // Buka tab Testimonial jika ada session open_testimonial_tab (tanpa success message)
            @if (session('open_testimonial_tab') && !session('success'))
                const testimonialTab = document.querySelector('[data-bs-target="#navs-top-profile"]');
                if (testimonialTab) {
                    const tab = new bootstrap.Tab(testimonialTab);
                    tab.show();
                }
            @endif

            const btn = document.getElementById('saveHomeBtn');
            if (!btn) return;

            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const container = document.getElementById('navs-top-home');
                if (!container) return Swal.fire('Error', 'Form container tidak ditemukan', 'error');

                const inputs = container.querySelectorAll('input[name], textarea[name], select[name]');
                const params = new URLSearchParams();

                params.append('_token', '{{ csrf_token() }}');

                inputs.forEach((el) => {
                    const name = el.name;
                    if (!name) return;

                    if (el.type === 'checkbox') {
                        if (el.checked) params.append(name, el.value);
                    } else if (el.type === 'file') {
                        // skip file inputs (old form had none to upload)
                    } else {
                        params.append(name, el.value || '');
                    }
                });

                // visual feedback
                const original = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="bx bx-save"></i> Saving...';

                fetch('{{ route('cms.home.content.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: params.toString(),
                    credentials: 'same-origin'
                }).then(resp => {
                    btn.disabled = false;
                    btn.innerHTML = original;

                    if (resp.ok) {
                        Swal.fire({ icon: 'success', title: 'Saved', text: 'Perubahan berhasil disimpan' }).then(() => window.location.reload());
                    } else {
                        resp.text().then(t => Swal.fire('Error', t || 'Terjadi kesalahan', 'error'));
                    }
                }).catch(() => {
                    btn.disabled = false;
                    btn.innerHTML = original;
                    Swal.fire('Error', 'Gagal mengirim permintaan', 'error');
                });
            });
        });

        // Confirm delete function for testimonial
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Testimonial?',
                text: `Yakin ingin menghapus "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('cms.home.testimonial.destroy', ':id') }}'.replace(':id', id);
                }
            });
        }

        // Edit function for testimonial
        function editTestimonial(id, name, message, picture, status) {
            // Populate form fields
            document.getElementById('editName').value = name;
            document.getElementById('editMessage').value = message;
            document.getElementById('editStatus').checked = status;
            
            // Show/hide current picture
            if (picture) {
                document.getElementById('currentPictureDiv').style.display = 'block';
                document.getElementById('currentPicture').src = '{{ asset('') }}' + picture;
            } else {
                document.getElementById('currentPictureDiv').style.display = 'none';
            }
            
            // Set form action
            const form = document.getElementById('editForm');
            form.action = '{{ route('cms.home.testimonial.update', ':id') }}'.replace(':id', id);
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editCarModal'));
            modal.show();
        }
    </script>

    @include('sweetalert::alert')
@endsection
