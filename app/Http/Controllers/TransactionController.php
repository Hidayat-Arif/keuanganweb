<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan.');
    }

    public function dashboard()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // --- Data untuk grafik bulanan ---
        $months = [];
        $monthlyIncome = [];
        $monthlyExpense = [];

        // Ambil 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $monthName = Carbon::now()->subMonths($i)->format('M');
            $monthNumber = Carbon::now()->subMonths($i)->month;

            $income = Transaction::where('user_id', Auth::id())
                ->where('type', 'income')
                ->whereMonth('created_at', $monthNumber)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('amount');

            $expense = Transaction::where('user_id', Auth::id())
                ->where('type', 'expense')
                ->whereMonth('created_at', $monthNumber)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('amount');

            $months[] = $monthName;
            $monthlyIncome[] = $income;
            $monthlyExpense[] = $expense;
        }

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'transactions',
            'months',
            'monthlyIncome',
            'monthlyExpense'
        ));
    }

    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())->findOrFail($id);
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

    public function destroyAll()
    {
        Transaction::where('user_id', auth()->id())->delete();

        return redirect()->back()->with('success', 'Semua transaksi berhasil dihapus.');
    }
}
