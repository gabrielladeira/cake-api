<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cake;
use App\Http\Requests\StoreCakeRequest;
use App\Http\Requests\UpdateCakeRequest;


class CakeController extends BaseController
{
    /**
     * List all available cakes.
     */
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        
        $cakes = Cake::paginate(perPage:$perPage, page:$page);

        return $this->ok($cakes);
    }

    /**
     * Create a new cake.
     */
    public function store(StoreCakeRequest $request)
    {
        $validated = $request->validated();

        $cake = Cake::create($validated);

        return $this->created($cake);
    }

    /**
     * Retrive a cake by id.
     */
    public function show($id)
    {
        $cake = Cake::find($id);

        if (!$cake) {
            return $this->notFound('Cake not found');
        }

        return $this->ok($cake);
    }

    /**
     * Update a cake
     */
    public function update(UpdateCakeRequest $request, $id)
    {
        $validated = $request->validated();

        $cake = Cake::find($id);

        if (!$cake) {
            return $this->notFound('Cake not found');
        }

        $cake->update($validated);

        return $this->ok($cake);
    }

    /**
     * Remove a cake
     */
    public function destroy($id)
    {
        $cake = Cake::find($id);

        if (!$cake) {
            return $this->notFound('Cake not found');
        }

        $cake->delete();

        return $this->ok(['message'=> 'Cake deleted successfully']);
    }
    
    /**
     * List cake orders
     */    
    public function orders($id)
    {
        $cake = Cake::find($id);

        if (!$cake) {
            return $this->notFound('Cake not found');
        }

        return $this->ok($cake->orders()->get());
    }
}
