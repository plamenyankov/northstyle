<?php
 
namespace Northstyle\Module\Shop\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Core\DataObject\Id as Id;

use Northstyle\Module\Shop\Repository\Product as Repository;
use Northstyle\Module\Shop\Repository\Store as StoreRepository;
use Northstyle\Module\Shop\Repository\AttributeSet as AttributeSetRepository;

use Northstyle\Module\Shop\DataObject\Builder\Product as DOBuilder;

use Northstyle\Module\Shop\Behavior\DataObject\CreateProduct as CreateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\UpdateProduct as UpdateBehaviorDO;
use Northstyle\Module\Shop\Behavior\DataObject\RemoveProduct as RemoveBehaviorDO;

class StoreProductController extends Controller
{
	protected $baseView = 'backend.shop.product.';

	protected $baseRoute = 'backend.shop.store.product.';

	protected $store = null;

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
		$this->createBehavior = \App::make('shop.behavior.createProduct');
		$this->updateBehavior = \App::make('shop.behavior.updateProduct');
		$this->removeBehavior = \App::make('shop.behavior.removeProduct');

		$this->store = $this->loadStore();

		\View::share('store', $this->store);
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

		return $storeDO;
	}

	public function loadAttributeSet($setID) {
		$attributeSetID = Id::create($setID);

		if (!$attributeSetID->value()) {
			\App::abort(404);
		}

		$attributeSetDO = $this->attributeSetRepository->findOneById($attributeSetID);

		if (!$attributeSetDO) {
			\App::abort(404);
		}

		return $attributeSetDO;
	}

	public function loadChooseAttributeSetDropdownOptions() {
		$options = array();

		foreach ($this->store->attribute_sets as $attribute_set) {
			$options[$attribute_set->id->value()] = $attribute_set->label;
		}

		return $options;
	}

	public function loadAttributesDropdownOptions($attributes) {
		$options = array();

		foreach ($attributes as $attributeDO) {
			$options[$attributeDO->id->value()] = $attributeDO->label;
		}

		return $options;
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

		\View::share('createProductUrl', route($this->baseRoute . 'create', array(
			'store_id' => $this->store->id->value()
		))); 

        return view($this->baseView . 'index', compact('items', 'paginate'));
    }

	public function create() {
		$item = $this->builder->build();

		$attributeSetID = \Input::get('attribute_set_id', 0);

		$attributeSet = $this->loadAttributeSet($attributeSetID);

		\View::share('attributesDropdownOptions', $this->loadAttributesDropdownOptions($attributeSet->attributes));
		\View::share('attributeSet', $this->loadAttributeSet($attributeSetID));
		\View::share('formMethod', 'post');
		\View::share('formUrl', route($this->baseRoute . 'store', array(
			'store_id' => $this->store->id->value(),
			'attribute_set_id' => $attributeSetID
		))); 
		\View::share('submitLabel', 'Създай');

		return view($this->baseView . 'form',compact('item'));
	}

	public function store(Request $request) {
		$attributeSetID = \Input::get('attribute_set_id', 0);

		$behaviorDO = new CreateBehaviorDO($request->all());
		$behaviorDO->update(array(
			'store_id' => $this->store->id,
			'attribute_set_id' => $attributeSetID
		));

		$this->createBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', $this->store->id->value()))->with('status','Продуктът е създаден!');
	}

	public function edit($storeID, $entityID) {
		$item = $this->repository->findOneById($entityID);

		\View::share('attributeSet', $item->attribute_set);
		\View::share('attributesDropdownOptions', $this->loadAttributesDropdownOptions($item->attribute_set->attributes));
		\View::share('formMethod', 'put'); 
		\View::share('formUrl', route($this->baseRoute . 'update', array(
			'store_id' => $this->store->id->value(),
			'product_id' => $item->id->value()
		)));
		\View::share('createAttributeUrl', route($this->baseRoute . 'create', array(
			'store_id' => $this->store->id->value(),
			'product_id' => $item->id->value()
		)));
		\View::share('submitLabel', 'Запази');

        return view($this->baseView . 'form',compact('item'));
	}

	public function update($storeID, $entityID, Request $request) {
		$behaviorDO = new UpdateBehaviorDO($request->all());
		$behaviorDO->update(array(
			'id' => $entityID
		));

		$this->updateBehavior->handle($behaviorDO);

		return redirect(route($this->baseRoute . 'index', array('store_id' => $this->store->id->value())))->with('status','Продуктът е редактиран!');
	}

	public function confirm_delete($storeID, $entityID) {

		$item = $this->repository->findOneById($entityID);

		\View::share('indexUrl', route($this->baseRoute . 'index', array(
			'store_id' => $this->store->id->value()
		)));

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

		return redirect(route($this->baseRoute . 'index', array('store_id' => $this->store->id->value() )))->with('status','Продуктът е изтрит!');
	}
}
