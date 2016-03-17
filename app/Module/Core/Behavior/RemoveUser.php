<?php

namespace Northstyle\Module\Core\Behavior;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Core\Model\User as UserModel;

use Northstyle\Module\Core\Backend\Http\Request\DeleteUserRequest;

use Northstyle\Common\Behavior as CommonBehavior;

class RemoveUser extends CommonBehavior {
	protected $model = null;

	public function __construct(UserModel $userModel) {
		$this->model = $userModel;
	}

	public function handle(DeleteUserRequest $request) {
		$entity = $this->model->find($request->user_id);

		if (!$entity) {
			throw new EntityNotFoundException('Entity not found.');
		}

		$entity->delete();
	}
}