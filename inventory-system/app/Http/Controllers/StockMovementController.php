<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StockMovement::with('product')->latest();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('product', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->has('type') && in_array($request->type, ['in', 'out'])) {
            $query->where('type', $request->type);
        }

        $stockMovements = $query->paginate(15);
        return view('stock-movements.index', compact('stockMovements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock-movements.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($validated['product_id']);
            
            if ($validated['type'] === 'out' && $product->quantity < $validated['quantity']) {
                return back()->withInput()->with('error', 'Insufficient stock for this product.');
            }

            StockMovement::create($validated);

            if ($validated['type'] === 'in') {
                $product->quantity += $validated['quantity'];
            } else {
                $product->quantity -= $validated['quantity'];
            }
            $product->save();

            DB::commit();

            return redirect()->route('stock-movements.index')->with('success', 'Stock movement recorded successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to record stock movement. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockMovement $stockMovement)
    {
        $products = Product::orderBy('name')->get();
        return view('stock-movements.edit', compact('stockMovement', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockMovement $stockMovement)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($validated['product_id']);
            
            // Revert original movement impact on stock
            if ($stockMovement->type === 'in') {
                $product->quantity -= $stockMovement->quantity;
            } else {
                $product->quantity += $stockMovement->quantity;
            }
            
            // Check new movement impact logic
            if ($validated['type'] === 'out' && $product->quantity < $validated['quantity']) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Update would result in negative stock. Insufficient stock.');
            }

            // Apply new movement impact on stock
            if ($validated['type'] === 'in') {
                $product->quantity += $validated['quantity'];
            } else {
                $product->quantity -= $validated['quantity'];
            }

            $product->save();
            $stockMovement->update($validated);

            DB::commit();

            return redirect()->route('stock-movements.index')->with('success', 'Stock movement updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update stock movement.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockMovement $stockMovement)
    {
        DB::beginTransaction();

        try {
            $product = $stockMovement->product;
            
            if ($product) {
                // Revert movement impact on stock
                if ($stockMovement->type === 'in') {
                    $product->quantity -= $stockMovement->quantity;
                } else {
                    $product->quantity += $stockMovement->quantity;
                }
                
                if ($product->quantity < 0) {
                    $product->quantity = 0; // Prevent negative stock from deletions
                }
                $product->save();
            }

            $stockMovement->delete();
            
            DB::commit();

            return redirect()->route('stock-movements.index')->with('success', 'Stock movement deleted and stock levels adjusted.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('stock-movements.index')->with('error', 'Failed to delete stock movement.');
        }
    }
}
