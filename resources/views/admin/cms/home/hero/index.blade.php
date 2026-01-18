@extends('layout.admin')
@section('title', 'Hero')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center my-4">

                <h4 class="fw-bold d-flex align-items-center mb-0">
                    <i class="bx bx-category me-2 text-primary" style="font-size: 1.5rem;"></i>
                    <span>Master Hero</span>
                </h4>

                <button type="button" class="btn btn-outline-success d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#addCarModal">
                    <i class="bx bx-plus me-2"></i>
                    <span>Tambah</span>
                </button>

            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h5>Hero Table</h5>


                            <!-- Modal tambah Data -->
                            <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">

                                        <!-- Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCarModalLabel">Add Hero</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ route('cms.home.hero.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="row">

                                                    <!-- Image -->
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="image" class="form-control" required>

                                                        <small class="text-muted d-block mt-1">
                                                            Format yang diperbolehkan: <strong>JPG, JPEG ,PNG ,WEBP</strong>. <br>
                                                            Ukuran maksimal <strong>5 MB</strong>. <br>
                                                            Disarankan rasio <strong>16:9</strong>. <br>
                                                        </small>

                                                        @error('image')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>


                                                    <!-- Position -->
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Position</label>
                                                        @php $count = $sliders->count(); @endphp
                                                        <select name="position" class="form-select" required>
                                                            @for ($i = 1; $i <= $count + 1; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ old('position') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                        @error('position')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="is_active" class="form-select" required>
                                                            <option value="">Pilih Status</option>
                                                            <option value="1"
                                                                {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif
                                                            </option>
                                                            <option value="0"
                                                                {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif
                                                            </option>
                                                        </select>
                                                        @error('is_active')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table id="heroTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th>Image</th>
                                        <th width="10%">Position</th>
                                        <th width="15%">Status</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="table-border-bottom-0">
                                    @forelse ($sliders as $index => $slider)
                                        <tr class="text-center align-middle">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $slider->image) }}"
                                                    class="img-fluid rounded" style="height: 80px; width: auto;">
                                            </td>
                                            <td>{{ $slider->position }}</td>
                                            <td>
                                                @if ($slider->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <!-- Toggle Active -->
                                                <form action="{{ route('cms.home.hero.update', $slider->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_active"
                                                        value="{{ $slider->is_active ? 0 : 1 }}">

                                                    <button type="submit"
                                                        class="btn btn-icon {{ $slider->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                        title="{{ $slider->is_active ? 'Deactivate' : 'Activate' }}">
                                                        <i
                                                            class="bx {{ $slider->is_active ? 'bx-power-off' : 'bx-check-circle' }}"></i>
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <button class="btn btn-icon btn-outline-danger"
                                                    onclick="confirmSlider('{{ $slider->id }}', 'Posisi: {{ $slider->position }}')"
                                                    title="Hapus">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="no-data">
                                            <td colspan="5" class="text-center text-muted">
                                                Belum ada hero image
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
    {{-- DATA TABLES --}}
    <script>
        $(document).ready(function() {
            // Only initialize DataTable when there are actual data rows.
            if ($('#heroTable tbody tr.no-data').length === 0) {
                $('#heroTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    ordering: true,
                    columnDefs: [{
                            orderable: false,
                            targets: [1, 4]
                        } // image & actions
                    ],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: "‹",
                            next: "›"
                        },
                        emptyTable: "Belum ada hero image"
                    }
                });
            }
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSlider(sliderId, name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `${name} akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // build delete URL and submit a form with DELETE method + CSRF
                    const deleteUrl = "{{ url('/home/destroy') }}" + '/' + sliderId;
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
                    const tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = '_token';
                    tokenInput.value = '{{ csrf_token() }}';
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(tokenInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
    @include('sweetalert::alert')
@endsection
