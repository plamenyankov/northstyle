<?php

namespace Northstyle\Module\Shop\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\Repository\Store as StoreRepository;

use Northstyle\Module\Shop\DataObject\Store as StoreDO;

use Illuminate\Contracts\View\View;

use Illuminate\Contracts\Auth\Guard;

class AccessibleStoresDropdownOptions {

	protected $storeRepository;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, StoreRepository $storeRepository)
    {
        $this->auth = $auth;
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
		$list = array();

		$user = $this->auth->user();

		if ($user) {
			$stores = $this->storeRepository->findByUserId(Id::create($user->id));

			foreach ($stores as $store) {
				$list[$store->id->value()] = $store->label;
			}
		}

		$view->with('accessibleStoresDropdownOptions', $list);	
    }
}