<?php

namespace Northstyle\Module\Shop\APIv1\Http\Controller;

use Illuminate\Http\Request;

use Northstyle\Http\Requests;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Shop\Repository\Attribute as AttributeRepository;

class AttributeController extends Controller
{
	protected $attributeRepository = null;

	public function __construct(AttributeRepository $attributeRepository) {
		$this->attributeRepository = $attributeRepository;
	}

	public function show($attributeID) {
		$attributeDO = $this->attributeRepository->findOneById($attributeID);

		return $this->response(array($attributeDO));
	}

	public function response($items) {
		return \Response::json(array(
			'items' => $items
        ));
	}
}