<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2009 AOE media GmbH <dev@aoemedia.de>
 * All rights reserved
 *
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
require_once dirname ( __FILE__ ) . '/../Classes/TruncateTask.php';
/**
 * test case for Tx_TruncateJob_TruncateTask
 * @package truncate_job
 * @subpackage Tests
 */
class Tx_TruncateJob_TruncateTaskTest extends Tx_Phpunit_Database_TestCase {
	/**
	 * @var Tx_TruncateJob_TruncateTask
	 */
	private $task;
	/**
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp() {
		$this->createDatabase();
		$this->useTestDatabase();
		$this->task = new Tx_TruncateJob_TruncateTask();
	}
	/**
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::tearDown()
	 */
	protected function tearDown() {
		$this->dropDatabase();
		unset($this->task);
	}
	/**
	 * @test
	 * 
	 */
	public function test_execute(){
		$this->task->getDb()->admin_query("CREATE TABLE tx_truncate_job_text1 (uid int(11) unsigned DEFAULT '0' NOT NULL);");
		$this->task->getDb()->exec_INSERTquery('tx_truncate_job_text1', array('uid'=>1));
		$this->task->getDb()->admin_query("CREATE TABLE tx_truncate_job_test2 (uid int(11) unsigned DEFAULT '0' NOT NULL);");
		$this->task->getDb()->exec_INSERTquery('tx_truncate_job_test2', array('uid'=>1));
		$this->assertEquals(1, $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_text1'),'tx_truncate_job_text1 is empty');
		$this->assertEquals(1, $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_test2'),'tx_truncate_job_text2 is empty');
		$this->task->setTables('tx_truncate_job_text1,tx_truncate_job_test2');
		$this->assertTrue($this->task->execute());
		$this->assertEquals(0, $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_text1'));
		$this->assertEquals(0, $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_test2'));
	}
}