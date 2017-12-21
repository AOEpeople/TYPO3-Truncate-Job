<?php

namespace Aoe\TruncateJob\Tests\Functional;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 AOE GmbH <dev@aoe.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Aoe\TruncateJob\TruncateTask;
use Nimut\TestingFramework\TestCase\FunctionalTestCase;

/**
 * test case for TruncateTask
 * @package truncate_job
 * @subpackage Tests
 */
class TruncateTaskTest extends FunctionalTestCase
{
    /**
     * @var TruncateTask
     */
    private $task;

    /**
     * @var array
     */
    protected $testExtensionsToLoad = ['typo3conf/ext/truncate_job'];

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['port'] = 3306;

        parent::setUp();

        $this->task = new TruncateTask();
        $this->task->getDb()->admin_query("CREATE TABLE tx_truncate_job_test1 (uid int(11) unsigned DEFAULT '0' NOT NULL);");
        $this->task->getDb()->admin_query("CREATE TABLE tx_truncate_job_test2 (uid int(11) unsigned DEFAULT '0' NOT NULL);");

        $this->importDataSet(dirname(__FILE__) . '/Fixtures/tx_truncate_job_test1.xml');
        $this->importDataSet(dirname(__FILE__) . '/Fixtures/tx_truncate_job_test2.xml');
    }

    /**
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    protected function tearDown()
    {
        unset($this->task);
    }

    /**
     * @test
     *
     */
    public function test_execute()
    {
        $this->assertEquals(
            1,
            $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_test1'),
            'tx_truncate_job_text1 is empty'
        );
        $this->assertEquals(
            1,
            $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_test2'),
            'tx_truncate_job_text2 is empty'
        );
        $this->task->setTables('tx_truncate_job_test1,tx_truncate_job_test2');
        $this->assertTrue($this->task->execute());
        $this->assertEquals(0, $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_test1'));
        $this->assertEquals(0, $this->task->getDb()->exec_SELECTcountRows('uid', 'tx_truncate_job_test2'));
    }
}
