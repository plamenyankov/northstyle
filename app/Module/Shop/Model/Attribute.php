<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {
	const OBJECT_TYPE = 'attribute';

    protected $table = 'attributes';

	public function attributeSet() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeSet');
	}

	public function representation() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeRepresentation', 'attribute_representation_id');
	}

	public function representationSettings() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeRepresentationSetting');
	}

	public function type() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeType');
	}

	public function parentAttribute() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Attribute');
	}

	public function validatorSettings() {
		return $this->HasMany('Northstyle\Module\Shop\Model\AttributeValidatorSetting');
	}

	public function options() {
		return $this->HasMany("Northstyle\Module\Shop\Model\AttributeOption");
	}

	public function values() {
		return $this->HasMany("Northstyle\Module\Core\Model\ObjectValue", 'object_id')->where('object_type', '=', self::OBJECT_TYPE);
	}
}
