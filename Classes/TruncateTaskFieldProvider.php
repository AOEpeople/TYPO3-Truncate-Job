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

/**
 * Export Task for sheduler
 */
class tx_TruncateJob_TruncateFieldProvider implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface {
    /**
     * @param array $taskInfo
     * @param Tx_TruncateJob_TruncateTask $task
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
		$fieldCode = '<input type="text" name="tx_scheduler[tables]" id="' . $fieldID . '" value="'.$taskInfo ['tables'].'" size="30" />';
		$additionalFields = array ();
		$additionalFields [$fieldID] = array ('code' => $fieldCode, 'label' => 'Tables (Komma seperated)' );
		return $additionalFields;
	}

    /**
     * @param array $submittedData
     * @param \TYPO3\CMS\Scheduler\Task\AbstractTask $task
     */
    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task) {
		$task->setTables( $submittedData ['tables'] );
	}

    /**
     * @param array $submittedData
     * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule
     * @return bool
     */
    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule) {
		return TRUE;
	}

}