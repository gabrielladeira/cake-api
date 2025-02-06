<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Mail\OrderAvailable;
use App\Mail\EmailService;

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

        $cake = $order->getCake();

        if($cake->quantity > 0) {
            $mail = new OrderAvailable($order);
            EmailService::send($mail);
        }

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
