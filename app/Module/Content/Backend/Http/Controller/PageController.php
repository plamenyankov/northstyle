<?php

namespace Northstyle\Module\Content\Backend\Http\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Northstyle\Http\Requests;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Content\Backend\Http\Request\StorePageRequest;
use Northstyle\Module\Content\Backend\Http\Request\EditPageRequest;
use Northstyle\Module\Content\Backend\Http\Request\UpdatePageRequest;
use Northstyle\Module\Content\Backend\Http\Request\RemovePageRequest;
use Northstyle\Module\Content\Backend\Http\Request\ConfirmDeletePageRequest;

use Northstyle\Module\Content\Model\Page as PageModel;
use Northstyle\Module\Content\Repository\Page as PageRepository;

class PageController extends Controller
{
	protected $base = 'backend.content.page.';

	protected $pageRepository;

	protected $createPageBehavior;

	protected $editPageBehavior;

	protected $removePageBehavior;

	public function getPageTemplates() {
		$templates = config('cms.templates');
		return ['' => ''] + array_combine(array_keys($templates), array_keys($templates));
	}

    /**
     *
     * BlogController constructor.
     */
    public function __construct(PageRepository $pageRepository)
    {
		$this->pageRepository = $pageRepository;
		$this->createPageBehavior = \App::make('content.behavior.createPage');
		$this->updatePageBehavior = \App::make('content.behavior.updatePage');
		$this->removePageBehavior = \App::make('content.behavior.removePage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pageRepository->listAll();

        return view($this->base . 'index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = $this->getPageTemplates();

		$page = $this->pageRepository->getBuilder()->build();

        return view($this->base . 'form', compact('page', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
		$request->author_id = auth()->user()->id;

		$this->createPageBehavior->handle($request);

        return redirect(route($this->base . 'index'))->with('status', 'Страницата е създадена успешно.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $templates = $this->getPageTemplates();

		$page = $this->pageRepository->findOneById($id);

        return view($this->base . 'form',compact('page', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request)
    {
		$this->updatePageBehavior->handle($request);

        return redirect(route($this->base . 'edit', $request->id->value()))->with('status', 'Страницата е променена успешно!');
    }

    public function confirm_delete(ConfirmDeletePageRequest $request) {
		$page = $this->pageRepository->findOneById($request->id);

        return view($this->base . 'confirm',compact('page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RemovePageRequest $request)
    {
		$this->removePageBehavior->handle($request);

        return redirect(route($this->base . 'index'))->with('status','Страницата е изтрита успешно!');
    }
}
