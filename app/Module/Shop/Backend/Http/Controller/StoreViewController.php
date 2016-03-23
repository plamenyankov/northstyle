<?php

namespace Northstyle\Module\Shop\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Shop\Backend\Http\Request\CreateStoreViewRequest as CreateRequest;
use Northstyle\Module\Shop\Backend\Http\Request\UpdateStoreViewRequest as UpdateRequest;
use Northstyle\Module\Shop\Backend\Http\Request\RemoveStoreViewRequest as RemoveRequest;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;

use Northstyle\Module\Shop\Repository\StoreView as Repository;

use Northstyle\Module\Shop\DataObject\Builder\StoreView as DOBuilder;

use Northstyle\Module\Shop\Behavior\DataObject\CreateStoreView as CreateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\UpdateStoreView as UpdateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\RemoveStoreView as RemoveBehaviorDO;

class StoreViewController extends Controller
{
	protected $baseView = 'backend.shop.store_view.';

	protected $baseRoute = 'backend.shop.store.store_view.';

	protected $store = null;

	protected $repository;

	protected $storeRepository;

	protected $builder;

	protected $createBehavior;

	protected $updateBehavior;

	protected $removeBehavior;

	public function __construct(Repository $repository, StoreRepository $storeRepository, DOBuilder $builder) {
		$this->repository = $repository;
		$this->storeRepository = $storeRepository;
		$this->builder = $builder;
		$this->createBehavior = \App::make('shop.behavior.createStoreView');
		$this->updateBehavior = \App::make('shop.behavior.updateStoreView');
		$this->removeBehavior = \App::make('shop.behavior.removeStoreView');

		$this->loadStore();

		\View::share('base', $this->baseRoute);
	}

	public function loadStore() {
		$current_params = \Route::current()->parameters();

		$storeID = $current_params['store_id'];

		if (!$storeID) {
			\App::abort(404);
		}

		$storeDO = $this->storeRepository->findOneById($storeID);

		if (!$storeDO) {
			\App::abort(404);
		}

		$this->store = $storeDO;

		\View::share('store', $storeDO);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->repository->findAll();

		$paginate = new \Illuminate\Pagination\LengthAwarePaginator($items, $this->repository->countAll(), 10);
		$paginate->setPath(route($this->baseRoute . 'index'));

        return view($this->baseView . 'index', compact('items', 'paginate'));
    }

	public function create() {
		$item = $this->builder->build();

		\View::share('formMethod', 'post');
		\View::share('formUrl', route($this->baseRoute . 'store', array('store_id' => $this->store->id->value()))); 
		\View::share('submitLabel', 'Създай изглед');

		return view($this->baseView . 'form',compact('item'));
	}

	public function store(Request $request) {
		$behaviorDO = new CreateBehaviorDO($request->all());
		$behaviorDO->update(array(
			'store_id' => $this->store->id
		));

		$this->createBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', $this->store->id->value()))->with('status','Изгледът е създаден!');
	}

	public function edit($storeID, $entityID) {
		$item = $this->repository->findOneById($entityID);

		\View::share('formMethod', 'put'); 
		\View::share('formUrl', route($this->baseRoute . 'update', array(
			'store_id' => $this->store->id->value(), 
			'store_view_id' => $item->id->value()
		)));
		\View::share('submitLabel', 'Запази изглед');

        return view($this->baseView . 'form',compact('item'));
	}

	public function update($storeID, $entityID, Request $request) {
		$behaviorDO = new UpdateBehaviorDO(array(
			'id' => $entityID,
			'label' => $request->get('label')
		));
		$this->updateBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array('store_id' => $this->store->id->value())))->with('status','Изгледът е редактиран!');
	}

	public function confirm_delete($storeID, $entityID) {

		$item = $this->repository->findOneById($entityID);

		\View::share('formUrl', route($this->baseRoute . 'destroy', array(
			'store_id' => $this->store->id->value(),
			'store_view_id' => $item->id->value()
		)));

        return view($this->baseView . 'confirm', compact('item'));
	}

	public function destroy($storeID, $entityID) {
		$behaviorDO = new RemoveBehaviorDO(array(
			'id' => $entityID
		));
		$this->removeBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array('store_id' => $this->store->id->value() )))->with('status','Изгледът е изтрит!');
	}
}
