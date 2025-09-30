@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Catatan Keuangan</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tambah transaksi --}}
    <form action="{{ route('transactions.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <select name="type" class="form-control" required>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" step="0.01" name="amount" class="form-control" placeholder="Jumlah" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="description" class="form-control" placeholder="Deskripsi">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" type="submit">Tambah</button>
            </div>
        </div>
    </form>

    {{-- Daftar transaksi --}}
    <h3 class="mb-3">Daftar Transaksi</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>
                        <!-- Hapus 1 data -->
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Reset semua data --}}
    @if($transactions->count() > 0)
        <form action="{{ route('transactions.destroyAll') }}" method="POST" onsubmit="return confirm('Yakin hapus SEMUA transaksi?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning mt-3">Reset Semua Transaksi</button>
        </form>
    @endif
</div>
@endsection
