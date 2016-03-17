<?php 

namespace Northstyle\Common\Behavior\_Abstract;

use Northstyle\Common\Behavior;

use Illuminate\Validation\Factory as ValidatorBuilder;

use Northstyle\Core\Behavior\Exception\NotValid as NotValidException;

abstract class Validate extends Behavior {
	protected $name = 'validate';

	protected $rules = array();

	protected $messages = array();

	protected $validatorBuilder = null;

	/**
	 * @var Illuminate\Validation\Validator
	 */
	protected $lastUsedValidator = null;

	public function __construct(ValidatorBuilder $validatorBuilder) {
		$this->validatorBuilder = $validatorBuilder;
	}

	public function setValidatorBuilder($validatorBuilder) {
		$this->validatorBuilder = $validatorBuilder;
	}

	protected function getValidatorBuilder() {
		return $this->validatorBuilder;
	}

	public function setRules($rules = array()) {
		$this->rules = $rules;
	}

	public function getRules() {
		return $this->rules;
	}

	public function setMessages($messages = array()) {
		$this->messages = $messages;
	}

	public function getMessages() {
		return $this->messages;
	}

	public function setLastUsedValidator($validator) {
		$this->lastUsedValidator = $validator;
	}

	public function getLastUsedValidator() {
		return $this->lastUsedValidator;
	}

	public function makeValidator($input) {
		return $this->getValidatorBuilder()->make($input, $this->rules, $this->messages);
	}

	public function handleFailed($validator) {
		$ex = new NotValidException("Not Valid");

		$ex->setValidator($validator);

		throw $ex;
	}

	public function validate($input) {
		$validator = $this->makeValidator($input);

		$this->setLastUsedValidator($validator);

		if ($validator->fails()) {
			$this->handleFailed($validator);
		}
	}
}