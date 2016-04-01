<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	const OBJECT_TYPE = 'product';

    protected $table = 'products';

    protected $fillable = ['title','content'];

	public function store() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Store');
	}

	public function attributeSet() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeSet');
	}

	public function values() {
		return $this->HasMany("Northstyle\Module\Core\Model\ObjectValue", 'object_id')->where('object_type', '=', self::OBJECT_TYPE);
	}
}
