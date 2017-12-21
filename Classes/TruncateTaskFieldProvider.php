<?php
namespace Aoe\TruncateJob;

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

use TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface;

/**
 * Export Task for scheduler
 */
class tx_TruncateJob_TruncateFieldProvider implements AdditionalFieldProviderInterface {
    /**
     * @param array $taskInfo
     * @param TruncateTask $task
     * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule
     * @return array
     */
    public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule) {
		if (empty ( $taskInfo ['tables'] )) {
			if ($schedulerModule->CMD == 'edit') {
				$taskInfo ['tables'] = $task->getTables ();
			} else {
				$taskInfo ['tables'] = '';
			}
		}
	
		$fieldID = 'task_tables';
		$fieldCode = '<input type="text" name="tx_scheduler[tables]" id="' . $fieldID . '" value="'.$taskInfo ['tables'].'" size="30" class="form-control" />';
		$additionalFields = array ();
		$additionalFields [$fieldID] = array ('code' => $fieldCode, 'label' => 'Tables (Komma seperated)' );
		return $additionalFields;
	}

    /**
     * @param array $submittedData
     * @param \TYPO3\CMS\Scheduler\Task\AbstractTask $task
     */
    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task) {
        /** @var TruncateTask $task */
		$task->setTables( $submittedData ['tables'] );
	}

    /**
     * @param array $submittedData
     * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule
     * @return bool
     */
    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule) {
		return true;
	}
}
