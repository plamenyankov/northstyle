<?php

namespace Northstyle\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;

use Northstyle\Module\Shop\DataObject\Store as StoreDO;

use Illuminate\Contracts\View\View;

class Dashboard {

	protected $storeRepository;

	protected $currentStore = null;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(StoreRepository $storeRepository)
    {
		$this->storeRepository = $storeRepository;

		if (\Session::has('currentStoreID')) {
			$currentStoreID = Id::create(\Session::get('currentStoreID'));

			$this->currentStore = $this->storeRepository->findOneById($currentStoreID);
		} else {
			$this->currentStore = null;
		}
    }

	public function getCurrentStoreId() {
		return $this->currentStore->id;
	}

	public function getCurrentStore() {
		return $this->currentStore;
	}

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$view->with('currentStore', $this->currentStore);
    }
}