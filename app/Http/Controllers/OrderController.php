<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\OrderCreated;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;


class OrderController extends BaseController
{
    /**
     * List all orders
     */
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        
        $orders = Order::paginate(perPage:$perPage, page:$page);

        return $this->ok($orders);
    }

    /**
     * Create a new order
     */
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        $order = Order::create($validated);

        OrderCreated::dispatch($order);

        return $this->created($order);
    }

    /**
     * Retrive an order by id.
     */
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return $this->notFound('Order not found');
        }

        return $this->ok($order);
    }
}
