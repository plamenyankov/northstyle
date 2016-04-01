<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model {
	const OBJECT_TYPE = 'attribute_option';

    protected $table = 'attribute_options';

	public function attribute() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Attribute');
	}

	public function values() {
		return $this->HasMany("Northstyle\Module\Core\Model\ObjectValue", 'object_id')->where('object_type', '=', self::OBJECT_TYPE);
	}
}
