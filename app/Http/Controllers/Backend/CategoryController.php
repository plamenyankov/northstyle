<?php

namespace Northstyle\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Northstyle\Category;
use Northstyle\Http\Requests;
use Northstyle\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryController constructor.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $category = $this->category->all();
//        dd($category->find(4)->children()->get());
        return view('backend.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $orderCategory = $this->category->all();
        return view('backend.category.form', compact('category', 'orderCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $this->category->create($request->only('title', 'content'));
        $this->updateCategoryOrder($category,$request);

        return redirect(route('backend.category.index'))->with('status', 'Категорията беше създадена!!');
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
        $category = $this->category->findOrfail($id);
        return view('backend.category.confirm', compact('category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = $this->category->findOrfail($id);
        $orderCategory = $this->category->all();
        return view('backend.category.form', compact('category', 'orderCategory'));
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
        $category = $this->category->findOrfail($id);
        if($resp = $this->updateCategoryOrder($category,$request)){
            return $resp;
        }
        $category->fill($request->only('title', 'content'))->save();
        return redirect(route('backend.category.edit', $category->id))->with('status', 'Категорията беше обновена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrfail($id);
        foreach($category->children  as $child){
            $child->makeRoot();
        }
        $category->delete();
        return redirect(route('backend.category.index'))->with('status', 'Категорията беше изтрита!');
    }
    public function updateCategoryOrder(Category $category, Request $request)
    {
        if ($request->has('order', 'orderCategory')) {
            try {
                $category->updateOrder($request->input('order'), $request->input('orderCategory'));
            } catch (MoveNotPossibleException $e) {
                return redirect(route('backend.category.edit', $category->id))->withInput()->withErrors([
                    'error' => 'Неможе категорията да стане дете на себе си!'
                ]);
            }
        }
    }
}
