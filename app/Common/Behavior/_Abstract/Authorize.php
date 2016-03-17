<?php

namespace Northstyle\Common\Behavior\_Abstract;

use Illuminate\Auth\Guard as AuthDriver;

use Northstyle\Common\Behavior;

use Northstyle\Core\Behavior\Exception\NotAuthorized as NotAuthorizedException;

abstract class Authorize extends Behavior
{
	protected $name = 'authorize';

	protected $acl = null;

	/**
	 * Arguments that will be passed to the ACL authorizer
	 *
	 * You can call setArguments() from within a subclass 
	 * of this command handler.
	 */
	protected $args = array();

	protected $authUser = null;

	public function __construct($acl, AuthDriver $auth)
	{
		$this->acl = $acl;
		$this->auth = $auth;
	}

	public function setAcl($acl)
	{
		$this->acl = $acl;
	}

	public function getAcl() {
		return $this->acl;
	}

	public function getAuth() {
		return $this->auth;
	}

	public function setArguments($args = array()) {
		$this->args = $args;
	}

	public function getArguments() {
		return $this->args;
	}

	public function authorize() {
		$authUser = $this->getAuth()->user();

		$args = $this->getArguments();

		array_unshift($args, $authUser);

		$result = call_user_func_array(array($this->acl, 'can'), $args);

		if (!$result) {
			throw new NotAuthorizedException('');
		}
	}
}