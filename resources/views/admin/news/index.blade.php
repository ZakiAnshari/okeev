@extends('layout.admin')
@section('title', 'Product')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-news me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="fw-light me-1 text-muted">News</span>
            </h4>

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
                            <div class="d-flex justify-content-end">
                                <div class="d-flex gap-2">
                                    <!-- Tombol Tambah -->
                                    <button type="button" class="btn btn-outline-success d-flex align-items-center mb-3"
                                        data-bs-toggle="modal" data-bs-target="#addNewsModal">
                                        <i class="bx bx-plus me-2"></i>
                                        <span>Tambah</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Tambah Berita -->
                            <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <!-- Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr>
                                        <form action="{{ route('news.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Title -->
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="form-label">Judul Berita</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ old('title') }}" placeholder="Masukkan judul berita">
                                                        @error('title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- Content -->
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="form-label">Isi Berita</label>
                                                        <textarea name="content" id="editor" class="form-control" rows="5" placeholder="Tulis isi berita...">
                                                            {{ old('content') }}
                                                        </textarea>
                                                        @error('content')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- Author -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Penulis</label>
                                                        <input type="text" name="author" class="form-control"
                                                            value="{{ old('author') }}" placeholder="Nama penulis">
                                                        @error('author')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- Status -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="draft"
                                                                {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                                            </option>
                                                            <option value="published"
                                                                {{ old('status') == 'published' ? 'selected' : '' }}>
                                                                Published
                                                            </option>
                                                        </select>
                                                        @error('status')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Publish Date -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Tanggal Publish</label>
                                                        <input type="datetime-local" name="published_at"
                                                            class="form-control" value="{{ old('published_at') }}">
                                                        @error('published_at')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- Thumbnail -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Thumbnail</label>
                                                        <input type="file" name="thumbnail" class="form-control"
                                                            id="thumbnailInput">

                                                        <!-- Keterangan -->
                                                        <small class="text-muted d-block mt-1">
                                                            *Format yang diperbolehkan: JPG, JPEG, PNG. <br>
                                                            *Maksimal ukuran 2MB.
                                                        </small>

                                                        @error('thumbnail')
                                                            <small class="text-danger d-block">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- Preview Thumbnail -->
                                                    <div class="col-lg-12 mb-3">
                                                        <div class="text-center">
                                                            <img id="thumbnailPreview" src="#" alt="Preview"
                                                                style="width:150px;height:150px;object-fit:cover;border:1px solid #ccc;
                                                                border-radius:6px;display:none;">
                                                        </div>
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
                            <!-- Table Data -->
                            <table id="newsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Dipublikasikan</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td>
                                                @if ($item->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Draft</span>
                                                @endif
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d F Y | H:i') }}
                                                WIB
                                            </td>

                                            <td class="text-center">

                                                <a href="{{ url('news/' . $item->slug . '/edit') }}"
                                                    class="btn btn-icon btn-outline-primary" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    onclick="confirmDeletenews('{{ $item->slug }}', '{{ $item->title }}')">
                                                    <button class="btn btn-icon btn-outline-danger" title="Hapus">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeletenews(slug, model_name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${model_name}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Arahkan ke route GET untuk destroy
                    window.location.href = `/news-destroy/${slug}`;
                }
            });
        }
    </script>

    <script>
        document.getElementById('thumbnailInput').addEventListener('change', function(e) {
            const preview = document.getElementById('thumbnailPreview');
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>

    {{-- DATATABLES NEWS --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Responsive -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#newsTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Data kosong.",
                }
            });
        });
    </script>
    {{-- END  DATATABLES NEWS --}}

    @include('sweetalert::alert')
@endsection
