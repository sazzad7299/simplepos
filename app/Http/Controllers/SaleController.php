<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Inertia\Inertia;
use App\Models\SaleDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return Inertia::render('Sale/Index', [
            'sales' => $sales,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Sale/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request,Sale $sale)
    {
            DB::beginTransaction();
            try {
                $requestedData = $request->all();
                $sale->customer = $requestedData['customer'];
                $sale->subtotal = $requestedData['subtotal'];
                $sale->invoiceDiscount = $requestedData['invoiceDiscount'];
                $sale->payable = $requestedData['payable'];
                 $sale->save();
                 $saleDetails=[];
                 foreach($requestedData['items'] as $item){
                     $item['sale_id'] = $sale['id'];
                     $saleDetails[] = $item;
                 }
                 SaleDetails::insert($saleDetails);
                 DB::commit();
                 return Inertia::visit(route('sales.index'));
            } catch (\Throwable $th) {
                DB::rollback();
                return Inertia::render('Sale/Create', [
                    'errors' => ['message' => 'An error occurred while saving the sale. Please try again.'],
                    // You can pass any other necessary data back to the Create view
                ]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
