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

                            <!-- Table Data -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
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

                                            <td class="text-center">
                                                <a href="{{ url('test-drive-show/' . $item->id) }}"
                                                    class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <button class="btn btn-icon btn-outline-danger" onclick=""
                                                    title="Hapus">
                                                    <i class="bx bx-trash"></i>
                                                </button>
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
