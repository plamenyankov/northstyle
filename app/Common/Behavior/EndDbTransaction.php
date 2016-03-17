<?php 

namespace Northstyle\Common\Behavior;

use Northstyle\Common\Behavior;

use \Illuminate\Database\DatabaseManager;

class EndDbTransaction extends Behavior
{
	protected $name = 'endDbTransaction';

	protected $dbAdapter = null;

	public function __construct(DatabaseManager $dbAdapter) {
		$this->dbAdapter = $dbAdapter;
	}

	public function handle()
	{
		$this->dbAdapter->commit();
	}
}