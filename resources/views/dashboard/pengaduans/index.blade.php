@extends('layouts.app')
@section('title', 'Pengaduan')

@section('title-header', 'Pengaduan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pengaduan</li>
@endsection

@if (Auth::user()->role == 'masyarakat')
    @section('action_btn')
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mb-0">Buat Pengaduan</a>
    @endsection
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pelapor</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                    <th>Foto Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengaduans as $pengaduan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengaduan->masyarakat->nik ?? 'Tidak ada data.' }}</td>
                                        <td>{{ $pengaduan->masyarakat->name }}</td>
                                        <td>{{ str()->words($pengaduan->isi_laporan, 5) }}</td>
                                        <td>{{ ucfirst($pengaduan->status) }}</td>
                                        <td>
                                            <img src="{{ asset('/uploads/images/' . $pengaduan->foto_bukti) }}"
                                                alt="{{ $pengaduan->foto_bukti }}" width="100">
                                        </td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{ route('pengaduan.show', ['pengaduan' => $pengaduan->id]) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

                                            @if (Auth::user()?->role == 'admin')
                                                <form id="delete-form-{{ $pengaduan->id }}"
                                                    action="{{ route('pengaduan.destroy', $pengaduan->id) }}"
                                                    class="d-none" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="deleteForm('{{ $pengaduan->id }}')"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        {{ $pengaduans->links() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteForm(id) {
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }
    </script>
@endsection
