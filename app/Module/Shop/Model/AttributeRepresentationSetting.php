<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

use Northstyle\Module\Shop\DataObject\AttributeRepresentationSetting as AttributeRepresentationSettingDO;

class AttributeRepresentationSetting extends Model {
    protected $table = 'attribute_representation_settings';

	public function attribute() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Attribute');
	}

	public function representation() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeRepresentation');
	}

	public function setSettingsDataAttribute(AttributeRepresentationSettingDO $value) {
		$this->attributes['settings_data'] = json_encode($value);
	}

	public function getSettingsDataAttribute($value) {
		if ($value) {
			return json_decode($value, true);
		} else {
			return null;
		}
	}
}
