<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Expense;
use App\Models\Supplier;
use App\Models\StockItem;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $dateFilter = $request->get('date_filter');

        $expenses = Expense::when($dateFilter, function ($query) use ($dateFilter) {
            return $query->whereDate('date', $dateFilter);
        })
        ->oldest()
        ->get();

        if ($request->ajax()) {
            return response()->json(['expenses' => $expenses]);
        }

        $suppliers = Supplier::orderBy('name')->get();
        return view('admin.expenses', compact('expenses', 'suppliers'));
    }

    private function validateExpense(Request $request)
    {
        return $request->validate([
            'supplier_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'item_total' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
        ]);
    }

    public function store(Request $request)
{
    $this->validateExpense($request);

    try {
        // Simpan ke expenses
        $expense = Expense::create([
            'supplier_name' => $request->supplier_name,
            'description' => $request->description,
            'date' => $request->date,
            'item_total' => $request->item_total,
            'amount' => $request->amount,
        ]);

        // Hitung harga per item
        $pricePerItem = $request->item_total > 0 ? $request->amount / $request->item_total : 0;

        // Tentukan status stok otomatis
        $status = 'Available';
        if ($request->item_total <= 5 && $request->item_total > 0) {
            $status = 'Low';
        } elseif ($request->item_total == 0) {
            $status = 'Out of Stock';
        }

        // Cek apakah produk udah ada di stock_items
        $existingStock = StockItem::where('product_name', $request->description)->first();

        if ($existingStock) {
            // Kalau udah ada, update quantity + status aja (JANGAN update price)
            $existingStock->quantity += $request->item_total;
            $existingStock->status = $status;
            $existingStock->save();
        } else {
            // Kalau belum ada, bikin baru sekalian masukin harga per pcs
            StockItem::create([
                'product_name' => $request->description,
                'quantity' => $request->item_total,
                'price' => $pricePerItem,
                'status' => $status,
            ]);
        }

        return response()->json(['success' => true, 'expense' => $expense], 201);

    } catch (\Exception $e) {
        Log::error('Gagal menyimpan expense: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Gagal menyimpan data expense.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function update(Request $request, $id)
    {
        $this->validateExpense($request);

        $expense = Expense::find($id);

        if (!$expense) {
            return response()->json(['success' => false, 'message' => 'Expense tidak ditemukan.'], 404);
        }

        try {
            $expense->update([
                'supplier_name' => $request->supplier_name,
                'description' => $request->description,
                'date' => $request->date,
                'item_total' => $request->item_total,
                'amount' => $request->amount,
            ]);

            // Update stock item, TAPI gak ubah harga
            $stockItem = StockItem::where('product_name', $expense->description)->first();
            if ($stockItem) {
                $stockItem->update([
                    'quantity' => $request->item_total,
                    'status' => $request->item_total >= 5 ? 'Available' : ($request->item_total <= 0 ? 'Out of Stock' : 'Low')
                ]);
            }

            return response()->json(['success' => true, 'expense' => $expense], 200);
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate expense: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data expense.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return response()->json(['success' => false, 'message' => 'Expense tidak ditemukan.'], 404);
        }

        try {
            $stockItem = StockItem::where('product_name', $expense->description)->first();

            if ($stockItem) {
                $stockItem->delete();
            }

            $expense->delete();

            return response()->json(['success' => true, 'message' => 'Expense dan stock item berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error("Gagal menghapus expense: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data expense.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
