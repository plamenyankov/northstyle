<?php

namespace Northstyle\Module\Shop\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\Repository\AttributeRepresentation as AttributeRepresentationRepository;

use Illuminate\Contracts\View\View;

class AttributeRepresentationsDropdown {

	protected $dashboard;

	protected $attributeRepresentationRepository;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(AttributeRepresentationRepository $attributeRepresentationRepository)
    {
		$this->attributeRepresentationRepository = $attributeRepresentationRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$attributeRepresentations = $this->attributeRepresentationRepository->findAll();

		$options = array();

		foreach ($attributeRepresentations as $representationDO) {
			$options[$representationDO->id->value()] = $representationDO->name;
		}

		$view->with('attributeRepresentationsDropdownOptions', $options);
    }
}