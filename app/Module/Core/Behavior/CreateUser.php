<?php

namespace Northstyle\Module\Core\Behavior;

use Northstyle\Module\Core\Model\User as UserModel;

use Northstyle\Module\Core\Backend\Http\Request\StoreUserRequest;

use Northstyle\Common\Behavior as CommonBehavior;

class CreateUser extends CommonBehavior {
	protected $model = null;

	public function __construct(UserModel $userModel) {
		$this->model = $userModel;
	}

	public function handle(StoreUserRequest $request) {
       $this->model->create($request->only('name','email','password'));
	}
}