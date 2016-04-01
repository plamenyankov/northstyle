<?php

namespace Northstyle\Module\Shop\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\DataObject\StoreView as StoreViewDO;

use Illuminate\Contracts\View\View;

use Northstyle\Composer\Dashboard;

class StoreViewList {

	protected $dashboard;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Dashboard $dashboard)
    {
		$this->dashboard = $dashboard;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$store = $this->dashboard->getCurrentStore();

		if (!$store) {
			return;
		}

		$options = array();

		$options['all'] = new StoreViewDO(array(
			'name' => 'all',
			'label' => 'Всички',
			'language' => array(
				'label' => 'Всички езици',
				'code' => 'all'
			)
		));

		foreach ($store->views as $viewDO) {
			$options[$viewDO->name] = $viewDO;
		}

		$view->with('storeViewList', $options);
    }
}