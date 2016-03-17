<?php

namespace Northstyle\Module\Shop\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Shop\Backend\Http\Request\CreateStoreRequest;
use Northstyle\Module\Shop\Backend\Http\Request\UpdateStoreRequest;
use Northstyle\Module\Shop\Backend\Http\Request\RemoveStoreRequest;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;

use Northstyle\Module\Shop\DataObject\Builder\Store as StoreDOBuilder;

use Northstyle\Module\Shop\Behavior\DataObject\CreateStore as CreateStoreDO;
use Northstyle\Module\Shop\Behavior\DataObject\UpdateStore as UpdateStoreDO;
use Northstyle\Module\Shop\Behavior\DataObject\RemoveStore as RemoveStoreDO;

class StoreController extends Controller
{
	protected $base = 'backend.shop.store.';

	protected $repository;

	protected $builder;

	protected $createStoreBehavior;
	
	protected $updateStoreBehavior;

	protected $removeStoreBehavior;

	public function __construct(StoreRepository $repository, StoreDOBuilder $builder) {
		$this->repository = $repository;
		$this->builder = $builder;
		$this->createStoreBehavior = \App::make('shop.behavior.createStore');
		$this->updateStoreBehavior = \App::make('shop.behavior.updateStore');
		$this->removeStoreBehavior = \App::make('shop.behavior.removeStore');

		\View::share('base', $this->base);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = $this->repository->findAll();

		$items = array();

		foreach ($collection as $item) {
			$items[] = $this->builder->build($item);
		}

		$paginate = new \Illuminate\Pagination\LengthAwarePaginator($items, $this->repository->countAll(), 10);
		$paginate->setPath(route($this->base . 'index'));

        return view($this->base . 'index', compact('items', 'paginate'));
    }

	public function create() {
		$item = $this->builder->build();

        return view($this->base . 'form',compact('item'));
	}

	public function store(CreateStoreRequest $request) {
		$createStoreDO = new CreateStoreDO($request->all());

		$this->createStoreBehavior->handle($createStoreDO);

		return redirect(route($this->base . 'index'))->with('status','Магазинът е създаден!');
	}

	public function edit($storeID) {
		$entity = $this->repository->findOneById($storeID);
		$item = $this->builder->build($entity);

        return view($this->base . 'form',compact('item'));
	}

	public function update($storeID, UpdateStoreRequest $request) {		
		$updateStoreDO = new UpdateStoreDO(array(
			'store_id' => $storeID,
			'label' => $request->get('label')
		));
		$this->updateStoreBehavior->handle($updateStoreDO);

		return redirect(route($this->base . 'index'))->with('status','Магазинът е редактиран!');
	}

	public function confirm_delete($storeID, Request $request) {
		$entity = $this->repository->findOneById($storeID);
		$item = $this->builder->build($entity);

        return view($this->base . 'confirm', compact('item'));
	}

	public function destroy($storeID, Request $request) {
		$behaviorDO = new RemoveStoreDO(array(
			'store_id' => $storeID
		));
		$this->removeStoreBehavior->handle($behaviorDO);

		return redirect(route($this->base . 'index'))->with('status','Магазинът е изтрит!');
	}
}
