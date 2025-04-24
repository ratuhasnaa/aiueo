<?php

namespace App\Http\Controllers;

use App\Models\VenueNew;
use App\Models\Expense;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total venue
        $totalVenues = VenueNew::count();

        // Venue terbaru (3 data)
        $latestVenues = VenueNew::latest()->take(3)->get();

        // Jumlah per kategori
        $categoryCount = VenueNew::select('category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category')
            ->get();

        // ✅ Total expenses keseluruhan
        $totalExpenses = Expense::sum('amount');

        // ✅ Grafik pengeluaran per bulan
        $monthlyExpenses = Expense::selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // ✅ Top Spending This Month
        $topSpending = Expense::whereMonth('date', now()->month)
            ->orderByDesc('amount')
            ->first();

        // ✅ Highest Expense Overall
        $highestExpense = Expense::orderByDesc('amount')->first();

        // ✅ Most used supplier
        $mostUsedSupplier = Expense::select('supplier_name', DB::raw('COUNT(*) as total'))
            ->groupBy('supplier_name')
            ->orderByDesc('total')
            ->first();

        // ✅ Total supplier count
        $supplierCount = Supplier::count();

        return view('admin.dashboard', compact(
            'totalVenues',
            'latestVenues',
            'categoryCount',
            'totalExpenses',
            'monthlyExpenses',
            'topSpending',
            'highestExpense',
            'mostUsedSupplier',
            'supplierCount'
        ));
    }
}
