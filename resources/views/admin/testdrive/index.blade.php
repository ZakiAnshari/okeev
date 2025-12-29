@extends('layout.admin')
@section('title', 'Testdrive')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
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
                            <div class="d-flex align-items-center mb-3">
                                <!-- Tombol Kembali -->
                                <!-- Judul -->
                                <h5 class="mb-0">TestDrive List</h5>
                            </div>
                            <!-- Modal Ubah Status -->
                            {{-- <div class="modal fade" id="modalStatus{{ $item->id }}" tabindex="-1"
                                aria-labelledby="modalStatusLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalStatusLabel{{ $item->id }}">
                                                Ubah Status Test Drive
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <label for="status" class="form-label">Pilih Status Baru:</label>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="pending"
                                                        {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved"
                                                        {{ $item->status == 'approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $item->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                    <option value="completed"
                                                        {{ $item->status == 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>

                                                <button type="submit" class="btn btn-primary">
                                                    Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> --}}

                            <!-- Table Data -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Status</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($testdrives as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->created_at->format('F d, Y') }}</td>

                                            <th>
                                                <span
                                                    class="badge 
                                                        @if ($item->status == 'pending') bg-warning
                                                        @elseif($item->status == 'approved') bg-primary
                                                        @elseif($item->status == 'done') bg-success
                                                        @else bg-danger @endif
                                                    ">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </th>

                                            <td class="text-center">
                                                <!-- Tombol Ubah Status -->
                                                @if ($item->testdrive)
                                                    <a href="https://wa.me/{{ $item->testdrive->phone }}?text=Halo%20{{ urlencode($item->testdrive->name) }}%2C%20pesanan%20{{ $item->no_transaction }}%20anda%20sedang%20diproses."
                                                        target="_blank" class="btn btn-sm btn-success">
                                                        <i class="bx bxl-whatsapp"></i> WA
                                                    </a>
                                                @endif
                                                <a href="{{ url('test-drive-show/' . $item->id) }}"
                                                    class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                {{-- <button class="btn btn-icon btn-outline-danger" onclick=""
                                                    title="Hapus">
                                                    <i class="bx bx-trash"></i>
                                                </button> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Data TestDrive Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeleteTechnology(product, technologyId, name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${name}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/product/${product}/technologies/${technologyId}`;
                }
            });
        }
    </script>

    @include('sweetalert::alert')
@endsection
