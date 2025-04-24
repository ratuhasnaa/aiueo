<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Models\StockItem;

class StockItemController extends Controller
    {
    /**
     * Tampilkan semua stok
     */
    public function index(Request $request)
    {
    $search = $request->get('searchName'); // ambil keyword dari input

    $stockItems = \App\Models\StockItem::when($search, function ($query) use ($search) {
        $query->where('product_name', 'like', "%$search%");
    })->get();

    return view('admin.stocks', compact('stockItems'));
    }


    /**
     * Hapus banyak stok sekaligus
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            StockItem::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Selected stock items deleted successfully.');
        }

        return redirect()->back()->with('error', 'No items selected.');
    }

    /**
     * Update banyak stok sekaligus (hanya quantity yang bisa diubah)
     */
    public function bulkUpdate(Request $request)
    {
        // Ambil data ID yang dipilih untuk diedit
        $editIds = explode(',', $request->edit_ids); // Memecah string ID menjadi array
        $items = $request->input('items'); // Ambil data items yang berisi quantity baru

        // Periksa jika ada data untuk diproses
        if ($items && is_array($items)) {
            // Loop untuk setiap ID yang dipilih
            foreach ($editIds as $id) {
                // Cek apakah ID ini ada dalam array items
                if (isset($items[$id])) {
                    $data = $items[$id]; // Ambil quantity baru untuk item ini
                    $stockItem = StockItem::find($id); // Cari stok item berdasarkan ID

                    if ($stockItem) {
                        // Update quantity
                        $stockItem->quantity = $data['quantity'];

                        // Update status berdasarkan quantity baru
                        if ($stockItem->quantity <= 5 && $stockItem->quantity > 0) {
                            $stockItem->status = 'low'; // Jika quantity <= 5 dan > 0, status = low
                        } elseif ($stockItem->quantity == 0) {
                            $stockItem->status = 'outofstock'; // Jika quantity = 0, status = outofstock
                        } else {
                            $stockItem->status = 'available'; // Jika quantity > 5, status = available
                        }

                        $stockItem->save(); // Simpan perubahan
                    }
                }
            }

            return redirect()->back()->with('success', 'Selected stock items updated successfully.');
        }

        // Jika tidak ada data yang dikirimkan
        return redirect()->back()->with('error', 'No data provided for update.');
    }

    /**
     * Update satu stok (hanya quantity yang bisa diubah)
     */
    public function update(Request $request, $id)
    {
        $stockItem = StockItem::find($id);

        if (!$stockItem) {
            return redirect()->back()->with('error', 'Stock item not found.');
        }

        // Hanya quantity yang diubah
        $stockItem->quantity = $request->input('quantity');

        // Update status otomatis berdasarkan quantity
        if ($stockItem->quantity <= 5 && $stockItem->quantity > 0) {
            $stockItem->status = 'low';
        } elseif ($stockItem->quantity == 0) {
            $stockItem->status = 'outofstock';
        } else {
            $stockItem->status = 'available';
        }

        $stockItem->save();

        return redirect()->route('stocks.index')->with('success', 'Stock item updated successfully.');
    }
}
