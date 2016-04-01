<?php

namespace Northstyle\Module\Shop\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;
use Northstyle\Module\Shop\Repository\StoreView as StoreViewRepository;

use Northstyle\Module\Shop\Repository\AttributeSet as Repository;

use Northstyle\Module\Shop\DataObject\Builder\AttributeSet as DOBuilder;

use Northstyle\Module\Shop\Behavior\DataObject\CreateAttributeSet as CreateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\UpdateAttributeSet as UpdateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\RemoveAttributeSet as RemoveBehaviorDO;

class StoreAttributeSetController extends Controller
{
	protected $baseView = 'backend.shop.attribute_set.';

	protected $baseRoute = 'backend.shop.store.attribute_set.';

	protected $store = null;

	protected $repository;

	protected $storeRepository;

	protected $storeViewRepository;

	protected $builder;

	protected $createBehavior;

	protected $updateBehavior;

	protected $removeBehavior;

	public function __construct(Repository $repository, StoreRepository $storeRepository, StoreViewRepository $storeViewRepository, DOBuilder $builder) {
		$this->repository = $repository;
		$this->storeRepository = $storeRepository;
		$this->storeViewRepository = $storeViewRepository;
		$this->builder = $builder;
		$this->createBehavior = \App::make('shop.behavior.createAttributeSet');
		$this->updateBehavior = \App::make('shop.behavior.updateAttributeSet');
		$this->removeBehavior = \App::make('shop.behavior.removeAttributeSet');

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

		$this->loadStoreViews();
	}

	public function loadStoreViews() {
		$storeViews = $this->storeViewRepository->findByStoreId($this->store->id);

		\View::share('storeViews', $storeViews);
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
		\View::share('submitLabel', 'Създай');

		return view($this->baseView . 'form',compact('item'));
	}

	public function store(Request $request) {
		$behaviorDO = new CreateBehaviorDO($request->all());
		$behaviorDO->update(array(
			'store_id' => $this->store->id
		));

		$this->createBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', $this->store->id->value()))->with('status','Множеството е създадено!');
	}

	public function edit($storeID, $entityID) {
		$item = $this->repository->findOneById($entityID);

		\View::share('formMethod', 'put'); 
		\View::share('formUrl', route($this->baseRoute . 'update', array(
			'store_id' => $this->store->id->value(), 
			'attribute_set_id' => $item->id->value()
		)));
		\View::share('createAttributeUrl', route($this->baseRoute . 'attribute.create', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $item->id->value()
		)));
		\View::share('submitLabel', 'Запази');

        return view($this->baseView . 'form',compact('item'));
	}

	public function update($storeID, $entityID, Request $request) {
		$behaviorDO = new UpdateBehaviorDO(array(
			'id' => $entityID,
			'label' => $request->get('label')
		));
		$this->updateBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array('store_id' => $this->store->id->value())))->with('status','Множеството е редактирано!');
	}

	public function confirm_delete($storeID, $entityID) {

		$item = $this->repository->findOneById($entityID);

		\View::share('formUrl', route($this->baseRoute . 'destroy', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $item->id->value()
		)));

        return view($this->baseView . 'confirm', compact('item'));
	}

	public function destroy($storeID, $entityID) {
		$behaviorDO = new RemoveBehaviorDO(array(
			'id' => $entityID
		));
		$this->removeBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array('store_id' => $this->store->id->value() )))->with('status','Множеството е изтрито!');
	}
}
