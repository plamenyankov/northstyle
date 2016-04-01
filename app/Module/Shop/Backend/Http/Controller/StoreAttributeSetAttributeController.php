<?php

namespace Northstyle\Module\Shop\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;
use Northstyle\Module\Shop\Repository\AttributeSet as AttributeSetRepository;

use Northstyle\Module\Shop\Repository\Attribute as Repository;

use Northstyle\Module\Shop\DataObject\Builder\Attribute as DOBuilder;

use Northstyle\Module\Shop\Behavior\DataObject\CreateAttribute as CreateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\UpdateAttribute as UpdateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\RemoveAttribute as RemoveBehaviorDO;

class StoreAttributeSetAttributeController extends Controller
{
	protected $baseView = 'backend.shop.attribute.';

	protected $baseRoute = 'backend.shop.store.attribute_set.attribute.';

	protected $baseRouteAttributeSet = 'backend.shop.store.attribute_set.';

	protected $store = null;

	protected $attributeSet = null;

	protected $repository;

	protected $storeRepository;

	protected $attributeSetRepository;

	protected $builder;

	protected $createBehavior;

	protected $updateBehavior;

	protected $removeBehavior;

	public function __construct(Repository $repository, StoreRepository $storeRepository, AttributeSetRepository $attributeSetRepository, DOBuilder $builder) {
		$this->repository = $repository;
		$this->storeRepository = $storeRepository;
		$this->attributeSetRepository = $attributeSetRepository;
		$this->builder = $builder;
		$this->createBehavior = \App::make('shop.behavior.createAttribute');
		$this->updateBehavior = \App::make('shop.behavior.updateAttribute');
		$this->removeBehavior = \App::make('shop.behavior.removeAttribute');

		$this->loadStore();
		$this->loadAttributeSet();

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

	public function loadAttributeSet() {
		$current_params = \Route::current()->parameters();

		$attributeSetID = $current_params['attribute_set_id'];

		if (!$attributeSetID) {
			\App::abort(404);
		}

		$attributeSetDO = $this->attributeSetRepository->findOneById($attributeSetID);

		if (!$attributeSetDO) {
			\App::abort(404);
		}

		$this->attributeSet = $attributeSetDO;

		\View::share('attributeSet', $attributeSetDO);
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
		\View::share('formUrl', route($this->baseRoute . 'store', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $this->attributeSet->id->value()
		)));
		\View::share('submitLabel', 'Създай');

		return view($this->baseView . 'form',compact('item'));
	}

	public function store(Request $request) {
		$data = $request->all();
		$data['attribute_set_id'] = $this->attributeSet->id->value();

		$behaviorDO = new CreateBehaviorDO($data);
		$behaviorDO->update(array(
			'store_id' => $this->store->id
		));

		$this->createBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $this->attributeSet->id->value()
		)))->with('status','Атрибутът е създаден!');
	}

	public function edit($storeID, $attributeSetID, $entityID) {
		$item = $this->repository->findOneById($entityID);

		\View::share('formMethod', 'put'); 
		\View::share('formUrl', route($this->baseRoute . 'update', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $this->attributeSet->id->value(),
			'attribute_id' => $item->id->value()
		)));
		\View::share('createAttributeUrl', route($this->baseRoute . 'create', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $this->attributeSet->id->value()
		)));
		\View::share('submitLabel', 'Запази');

        return view($this->baseView . 'form',compact('item'));
	}

	public function update($storeID, $attributeSetID, $entityID, Request $request) {
		$data = $request->all();
		$data['id'] = $entityID;
		$data['attribute_set_id'] = $this->attributeSet->id->value();

		$behaviorDO = new UpdateBehaviorDO($data);

		$this->updateBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $this->attributeSet->id->value()
		)))->with('status','Атрибутът е запазен!');
	}

	public function confirm_delete($storeID, $attributeSetID, $entityID) {

		$item = $this->repository->findOneById($entityID);

		\View::share('formUrl', route($this->baseRoute . 'destroy', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $this->attributeSet->id->value(),
			'attribute_id' => $item->id->value()
		)));

        return view($this->baseView . 'confirm', compact('item'));
	}

	public function destroy($storeID, $attributeSetID, $entityID) {
		$behaviorDO = new RemoveBehaviorDO(array(
			'id' => $entityID
		));
		$this->removeBehavior->handle($behaviorDO);

		return redirect(route($this->baseRouteAttributeSet . 'edit', array('store_id' => $this->store->id->value(), 'attribute_set' => $this->attributeSet->id->value() )))->with('status','Атрибутът е изтрит!');
	}
}
