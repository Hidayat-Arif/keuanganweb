@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <!-- Header -->
                <div class="card-header text-white text-center" style="background-color:#007bff; font-weight:bold; font-size:20px;">
                    Home
                </div>

                <div class="card-body" style="background-color:#f8f9fa;">
                    
                    <!-- Pesan status -->
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Sambutan -->
                    <h4 class="mb-3 text-center">Selamat datang di Aplikasi Catatan Keuangan 🎉</h4>
                    <p class="text-center text-muted">
                        Kamu sudah berhasil login!<br>
                        Gunakan aplikasi ini untuk mencatat <strong>pemasukan</strong> dan <strong>pengeluaran</strong> sehari-hari.
                    </p>

                    <!-- Tombol navigasi -->
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4">
                            📊 Dashboard
                        </a>
                        <a href="{{ url('/transactions') }}" class="btn btn-success px-4">
                            💰 Transaksi
                        </a>
                    </div>

                    <!-- Petunjuk penggunaan -->
                    <div class="card p-3 shadow-sm">
                        <h5 class="text-primary">📌 Cara Menggunakan:</h5>
                        <ul>
                            <li>Buka menu <strong>Transaksi</strong> untuk menambahkan pemasukan atau pengeluaran.</li>
                            <li>Isi jumlah, deskripsi, lalu simpan.</li>
                            <li>Gunakan tombol <span class="text-danger">Hapus</span> untuk menghapus transaksi tertentu.</li>
                            <li>Pakai fitur <strong>Reset Semua</strong> jika ingin menghapus semua transaksi sekaligus.</li>
                            <li>Kembali ke <strong>Dashboard</strong> untuk melihat ringkasan saldo kamu.</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
