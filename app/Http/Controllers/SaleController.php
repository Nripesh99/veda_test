<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $sales = Sale::selectRaw('SUM(sales.amount) as total, sales.user_id')
    //     ->with('users')->toArray();
    //     // if(date range){
    //     //     $sales = $sales->whereBetween();
    //     // }
    //     // $sales = $sales->groupBy('sales.user_id')
    //     // ->get()->toArray();

    //     dd($sales);
    //     $sales = Sale::whereHas('user', function ($query) {
    //         $query->where('parent_id', auth()->id());
    //     })->get();

    //     $totalCommission = 0;

    //     foreach ($sales as $sale) {
    //         $amount = $sale->amount;
    //         $commissionRate = 0;

    //         if ($amount < 1000) {
    //             $commissionRate = 0.05; // 5%
    //         } elseif ($amount >= 1000 && $amount <= 5000) {
    //             $commissionRate = 0.075; // 7.5%
    //         } else {
    //             $commissionRate = 0.10; // 10%
    //         }

    //         $commission = $amount * $commissionRate;
    //         $totalCommission += $commission;

    //         // Add commission to the sale object
    //         $sale->commission = $commission;
    //     }

    //     return view('sales.index', ['sales' => $sales, 'totalCommission' => $totalCommission]);
    // }
    // public function index()
    // {
    //     $sales = Sale::whereHas('user', function ($query) {
    //         $query->where('parent_id', auth()->id());
    //     })
    //     ->groupBy('user_id')
    //     ->get();

    //     return response()->json($sales);
    // }
    public function indexApi()
    {
        $sales = Sale::selectRaw('SUM(sales.amount) as total, sales.user_id')
        // ->with('users')
         -> groupBy('sales.user_id')
       ->get()->toArray();
       $totalCommission = 0;

           foreach ($sales as &$sale) {

               $amount = $sale["total"];
               $commissionRate = 0;
               if ($amount < 1000) {
                   $commissionRate = 0.05; // 5%
               } elseif ($amount >= 1000 && $amount <= 5000) {
                   $commissionRate = 0.075;
                // 7.5%
               } else {
                   $commissionRate = 0.10;
                // 10%
               }
               $commission = $amount * $commissionRate;
            //    dd($commission);

               $totalCommission += $commission;

               // Add commission to the sale object
               $sale["commission"] = $commission;

           }

           //    dd($sales);
           $data=[
            'sales'=>$sales,
             'totalCommission'=>$totalCommission
           ];
           return response()->json($sales);
    }
    public function index()
    {
        //     $sales = Sale::selectRaw('SUM(sales.amount) as total, sales.user_id')
        //     ->with('user')
        //      -> groupBy('sales.user_id')
        //    ->get()->toArray();

        $sales = Sale::selectRaw('SUM(sales.amount) as total, users.id as user_id, users.name as user_name')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->where('users.parent_id', '=', auth()->id())
            ->groupBy('users.id', 'users.name')
            ->get()
            ->toArray();

        $totalCommission = 0;

        foreach ($sales as &$sale) {

            $amount = $sale["total"];
            $commissionRate = 0;
            if ($amount < 1000) {
                $commissionRate = 0.05; // 5%
            } elseif ($amount >= 1000 && $amount <= 5000) {
                $commissionRate = 0.075;
                // 7.5%
            } else {
                $commissionRate = 0.10;
                // 10%
            }
            (float) $commission = (float) $amount * (float) $commissionRate;
            //    dd($commission);

            $totalCommission += $commission;

            // Add commission to the sale object
            $sale["commission"] = $commission;

        }

        return view('sales.index', compact('sales'));
    }
    public function indexIndividual(){
        $sales =Sale::selectRaw('sales.amount, users.id, users.name')
                ->join('users', 'users.id', '=', 'sales.user_id')
                ->where('users.parent_id', '=', auth()->id())->get();
        
        return view('sales.individual',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('parent_id', auth()->id())->get();
        return view('sales.create', compact('user'));
    }
    public function viewDate()
    {
        return view('sales.dateRange');
    }
    public function dateFilter(Request $request)
    {
        
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if($startDate === $endDate)
        {
            $endDate = null;

        }
    
        // Fetch sales data with total amount and user information
        $sales = Sale::selectRaw('SUM(amount) as total, user_id, users.name as user_name')
        ->join('users', 'users.id', '=', 'sales.user_id')
            ->whereHas('user', function ($query) {
                $query->where('parent_id', auth()->id());
            })
            ->when($endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('sales.created_at', [$startDate, $endDate]);
            }, function ($query) use ($startDate) {
                $query->whereDate('sales.created_at', $startDate);
            })
            ->groupBy('user_id')
            ->with('user:id,name')
            ->get()
            ->toArray();

    
        $totalCommission = 0;
    
        foreach ($sales as &$sale) {

            $amount = $sale["total"];
            $commissionRate = 0;
            if ($amount < 1000) {
                $commissionRate = 0.05; // 5%
            } elseif ($amount >= 1000 && $amount <= 5000) {
                $commissionRate = 0.075;
                // 7.5%
            } else {
                $commissionRate = 0.10;
                // 10%
            }
            (float) $commission = (float) $amount * (float) $commissionRate;
            //    dd($commission);

            $totalCommission += $commission;

            // Add commission to the sale object
            $sale["commission"] = $commission;

        }

        return view('sales.index', compact('sales'));
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'amount' => 'required|numeric',
                'user' => 'required|integer',
            ]

        );
        $sale = new Sale;
        $sale->amount = $request->input('amount');
        $sale->user_id = $request->input('user');
        $sale->save();
        $notification = array(
            'message' => 'added Sales amount succesfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
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
        $sale = Sale::findOrFail($sale->id);
        dd($sale);
        return view('sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate(
            [
                'amount' => 'required|numeric',
            ]
        );
        $existingSale = Sale::find($sale->id);
        if (!$existingSale) {
            $notification = array(
                'message' => 'Sales item not found',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }else{
            $existingSale->amount = $request->amount;
        $existingSale->save();
        $notification = array(
            'message' => 'Amount  updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('sales.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        $notification = array(
            'message' => 'Deleted  sale succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('sales.index')->with($notification);
    }
}
