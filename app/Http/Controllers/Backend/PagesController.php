<?php

namespace Northstyle\Http\Controllers\Backend;

use Baum\MoveNotPossibleException;
use Illuminate\Http\Request;
use Northstyle\Http\Requests;
use Northstyle\Page;

class PagesController extends Controller
{
    protected $pages;

    /**
     * PagesController constructor.
     */
    public function __construct(Page $page)
    {
        $this->pages = $page;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pages->all();
//        dd($pages);
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        $templates = $this->getPageTemplates();
        $orderPages = $this->pages->all();
        return view('backend.pages.form', compact('page', 'templates', 'orderPages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePageRequest $request)
    {
        $page = $this->pages->create($request->only('title', 'uri', 'name', 'content', 'template'));
        $this->updatePageOrder($page,$request);

            return redirect(route('backend.pages.index'))->with('status', 'Page has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pages->findOrfail($id);
        $templates = $this->getPageTemplates();
        $orderPages = $this->pages->all();
        return view('backend.pages.form', compact('page', 'templates', 'orderPages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePageRequest $request, $id)
    {
        $page = $this->pages->findOrfail($id);
        if($resp = $this->updatePageOrder($page,$request)){
            return $resp;
        }
        $page->fill($request->only('title', 'uri', 'name', 'content', 'template'))->save();
        return redirect(route('backend.pages.edit', $page->id))->with('status', 'Page has been updated');
    }

    public function confirm($id)
    {
        $page = $this->pages->findOrfail($id);
        return view('backend.pages.confirm', compact('page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = $this->pages->findOrfail($id);
        foreach($page->children  as $child){
        $child->makeRoot();
        }
        $page->delete();
        return redirect(route('backend.pages.index'))->with('status', 'Page has been deleted!');
    }

    public function getPageTemplates()
    {
        $templates = config('cms.templates');
        return ['' => ''] + array_combine(array_keys($templates), array_keys($templates));
    }

    public function updatePageOrder(Page $page, Request $request)
    {
        if ($request->has('order', 'orderPage')) {
            try {
                $page->updateOrder($request->input('order'), $request->input('orderPage'));
            } catch (MoveNotPossibleException $e) {
                return redirect(route('backend.pages.edit', $page->id))->withInput()->withErrors([
                    'error' => 'Cannot make the page the child of itself.'
                ]);
            }
        }
    }
}
