<?php

namespace Northstyle\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Northstyle\Product;
use Northstyle\Http\Requests;
use Northstyle\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    /**
     * productController constructor.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->product->all();

        return view('backend.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(product $product)
    {
        $orderproduct = $this->product->all();
        return view('backend.product.form', compact('product', 'orderproduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->product->create($request->only('title', 'content'));
        $this->updateproductOrder($product,$request);

        return redirect(route('backend.product.index'))->with('status', 'Категорията беше създадена!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    public function confirm($id)
    {
        $product = $this->product->findOrfail($id);
        return view('backend.product.confirm', compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = $this->product->findOrfail($id);
        $orderproduct = $this->product->all();
        return view('backend.product.form', compact('product', 'orderproduct'));
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
        $product = $this->product->findOrfail($id);
        if($resp = $this->updateproductOrder($product,$request)){
            return $resp;
        }
        $product->fill($request->only('title', 'content'))->save();
        return redirect(route('backend.product.edit', $product->id))->with('status', 'Категорията беше обновена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrfail($id);
        foreach($product->children  as $child){
            $child->makeRoot();
        }
        $product->delete();
        return redirect(route('backend.product.index'))->with('status', 'Категорията беше изтрита!');
    }
    public function updateproductOrder(product $product, Request $request)
    {
        if ($request->has('order', 'orderproduct')) {
            try {
                $product->updateOrder($request->input('order'), $request->input('orderproduct'));
            } catch (MoveNotPossibleException $e) {
                return redirect(route('backend.product.edit', $product->id))->withInput()->withErrors([
                    'error' => 'Неможе категорията да стане дете на себе си!'
                ]);
            }
        }
    }
}
