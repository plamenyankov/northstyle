<?php

namespace Northstyle\Module\Shop\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\Repository\AttributeSet as AttributeSetRepository;

use Illuminate\Contracts\View\View;

use Northstyle\Composer\Dashboard;

class AttributeSetsDropdown {

	protected $dashboard;

	protected $attributeSetRepository;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Dashboard $dashboard, AttributeSetRepository $attributeSetRepository)
    {
		$this->dashboard = $dashboard;
		$this->attributeSetRepository = $attributeSetRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$storeId = $this->dashboard->getCurrentStoreId();

		if (!$storeId) {
			return;
		}

		$attributeSets = $this->attributeSetRepository->findByStoreId($storeId);

		$options = array();

		foreach ($attributeSets as $attributeSetDO) {
			$options[$attributeSetDO->id->value()] = $attributeSetDO->label;
		}

		$view->with('attributeSetDropdownOptions', $options);
    }
}