@extends('layouts.app')
@section('title', 'Contact - Wisata Alam')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card soft-card">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-5">
                        <div class="col-lg-5">
                            <h1 class="fw-bold mb-3">Contact</h1>
                            <p class="text-muted mb-4">
                                Halaman kontak sederhana untuk melengkapi navigasi aplikasi UTS dan memberi informasi pengembang.
                            </p>

                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 py-3">
                                    <h6 class="mb-1 text-muted text-uppercase small fw-bold">Pengembang</h6>
                                    <p class="mb-0 fw-semibold">Rizal Suryawan</p>
                                    <p class="mb-0 text-muted">NIM 241011750067</p>
                                </div>
                                <div class="list-group-item px-0 py-3">
                                    <h6 class="mb-1 text-muted text-uppercase small fw-bold">Mata Kuliah</h6>
                                    <p class="mb-0 fw-semibold">Rekayasa Web</p>
                                </div>
                                <div class="list-group-item px-0 py-3 border-bottom-0">
                                    <h6 class="mb-1 text-muted text-uppercase small fw-bold">Tema</h6>
                                    <p class="mb-0 fw-semibold">Daftar Wisata Alam</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" placeholder="Masukkan nama">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="nama@email.com">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold" for="message">Pesan</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan"></textarea>
                                </div>
                                <button type="button" class="btn btn-primary px-4">Kirim Pesan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
