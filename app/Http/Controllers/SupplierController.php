<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Menampilkan halaman suppliers
    public function create()
    {
        return view('admin.suppliers');
    }

    // Menyimpan data supplier
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Menyimpan data supplier
        $supplier = Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
        ]);

        // Menghitung nomor urut berdasarkan ID
        $supplierNo = $supplier->id;

        // Kembalikan response berupa data baru yang ditambahkan
        return response()->json([
            'status' => 'success',
            'data' => [
                'no' => $supplierNo,  // Menggunakan ID sebagai nomor urut
                'name' => $supplier->name,
                'phone' => $supplier->phone,
                'date' => $supplier->date
            ]
        ]);
    }

    public function showSuppliers()
    {
        $suppliers = Supplier::all(); // Mengambil semua data supplier
        return view('admin.suppliers', compact('suppliers')); // Kirim data ke view
    }

    public function storeSupplier(Request $request)
    {
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->date = $request->date;
        $supplier->save();

        return response()->json([
            'status' => 'success',
            'data' => $supplier // Kirim kembali data yang baru ditambahkan
        ]);
    }

    public function edit($id)
{
    $supplier = Supplier::findOrFail($id);
    return response()->json([
        'status' => 'success',
        'data' => $supplier
    ]);
}
// Update supplier
public function update(Request $request, $id)
{
    $supplier = Supplier::findOrFail($id);
    $supplier->name = $request->name;
    $supplier->phone = $request->phone;
    $supplier->date = $request->date;
    $supplier->save();

    return response()->json([
        'status' => 'success',
        'data' => $supplier
    ]);
}

// Hapus supplier
public function destroy($id)
{
    $supplier = Supplier::findOrFail($id);
    $supplier->delete();

    return response()->json([
        'status' => 'success'
    ]);
}

}
