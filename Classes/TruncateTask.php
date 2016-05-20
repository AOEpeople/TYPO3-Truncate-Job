<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2009 AOE GmbH <dev@aoe.com>
 * All rights reserved
 *
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Export Task for scheduler
 * @package truncate_job
 */
class Tx_TruncateJob_TruncateTask extends AbstractTask {
	/**
	 * @var string
	 */
	private $tables;
	/**
	 * truncate tables
	 */
	public function execute() {
		foreach ( $this->getTableList () as $table ) {
			$this->truncateTable ($table);
		}
		return TRUE;
	}
	
	/**
	 * @return array
	 */
	public function getTableList() {
		$tables = explode ( ',', $this->tables );
		if(FALSE === $tables ){
			return array();
		}
		return $tables;
	}
	/**
	 * @return string
	 */
	public function getTables() {
		return $this->tables;
	}
	
	/**
	 * @param string $tables
	 */
	public function setTables($tables) {
		$this->tables = $tables;
	}
	/**
	 * @return DatabaseConnection
	 */
	public function getDb() {
		return $GLOBALS ['TYPO3_DB'];
	}
	/**
	 * @param string $table
	 * @throws Exception
	 */
	private function truncateTable($table) {
		if (FALSE === $this->getDb ()->exec_TRUNCATEquery ( $table )) {
			throw new Exception ( 'Truncate of table ' . $table . ' failed ' );
		}
	}

}