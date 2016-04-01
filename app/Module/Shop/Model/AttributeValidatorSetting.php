<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

use Northstyle\Module\Shop\DataObject\AttributeValidatorSetting as AttributeValidatorSettingDO;

class AttributeValidatorSetting extends Model {
    protected $table = 'attribute_validator_settings';

	public function validator() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeValidator');
	}

	public function attribute() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Attribute');
	}

	public function setSettingsDataAttribute(AttributeValidatorSettingDO $value) {
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
