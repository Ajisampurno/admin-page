<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $categorieCount = Categorie::count();
        $orderCount = Order::count();

        $categoriesPercentage = Product::selectRaw('categorie_id, COUNT(*) as count')
            ->groupBy('categorie_id')
            ->with('categorie') // Assuming a Product belongs to a Categorie
            ->get()
            ->map(function ($item) use ($productCount) {
                $item->percentage = ($item->count / $productCount) * 100;
                $item->category_name = $item->categorie->name; // Assuming the categorie has a 'name' attribute
                return $item;
            });

        $usersByYear = User::selectRaw('YEAR(created_at) as year, COUNT(*) as total_users')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
        $dataUserByYear = [];
        foreach ($usersByYear as $item) {
            $dataUserByYear[] = [
                'year' => $item->year,
                'total_users' => $item->total_users,
            ];
        }

        $ordersByYear = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as total_orders')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
        $dataOrderByYear = [];
        foreach ($ordersByYear as $item) {
            $dataOrderByYear[] = [
                'year' => $item->year,
                'total_orders' => $item->total_orders,
            ];
        }

        return response()->json([
            'user_count' => $userCount,
            'product_count' => $productCount,
            'categorie_count' => $categorieCount,
            'order_count' => $orderCount,
            'users_by_year' => $dataUserByYear,
            'categories_percentage' => $categoriesPercentage,
            'orders_by_year' => $dataOrderByYear,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
