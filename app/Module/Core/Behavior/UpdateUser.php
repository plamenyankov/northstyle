<?php

namespace Northstyle\Module\Core\Behavior;

use Northstyle\Module\Core\Model\User as UserModel;

use Northstyle\Module\Core\Backend\Http\Request\UpdateUserRequest;

use Northstyle\Common\Behavior as CommonBehavior;

class UpdateUser extends CommonBehavior {
	protected $repository = null;
	protected $model = null;

	public function __construct(UserModel $pageModel) {
		$this->model = $pageModel;
	}

	public function handle(UpdateUserRequest $request) {
		$entity = $this->model->find($request->user_id);

		if (!$entity) {
			throw new EntityNotFoundException('Entity not found.');
		}

        $entity->fill($request->only('name','email','password'))->save();
	}
}