<?php

namespace Northstyle\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;

use Northstyle\Module\Shop\DataObject\Store as StoreDO;

use Illuminate\Contracts\View\View;

class Dashboard {

	protected $storeRepository;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(StoreRepository $storeRepository)
    {
		$this->storeRepository = $storeRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		if (\Session::has('currentStoreID')) {
			$currentStore = $this->storeRepository->findOneById(Id::create(\Session::get('currentStoreID')));
		} else {
			$currentStore = null;
		}

		$view->with('currentStore', $currentStore);
    }
}