<?php

namespace Northstyle\Module\Shop\DataObject\Enum;

use Common\DataEnum;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeRepresentationTypes extends DataEnum {
	const TYPE_TEXTBOX = 'textbox';

	public function all() {
		return array(
			self::TYPE_TEXTBOX
		);
	}
}