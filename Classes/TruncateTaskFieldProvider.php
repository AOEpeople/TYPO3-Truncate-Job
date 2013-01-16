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
require_once (t3lib_extMgm::extPath ( 'scheduler' ) . 'interfaces/interface.tx_scheduler_additionalfieldprovider.php');
/**
 * Export Task for sheduler
 */
class tx_TruncateJob_TruncateFieldProvider implements tx_scheduler_AdditionalFieldProvider {
	/**
	 * @param array &$taskInfo
	 * @param Tx_TruncateJob_TruncateTask $task
	 * @param tx_scheduler_Module $parentObject
	 * @return array
	 */
	public function getAdditionalFields(array &$taskInfo, $task, tx_scheduler_Module $parentObject) {
		if (empty ( $taskInfo ['tables'] )) {
			if ($parentObject->CMD == 'edit') {
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
	 * @param tx_scheduler_Task $task
	 */
	public function saveAdditionalFields(array $submittedData, tx_scheduler_Task $task) {
		$task->setTables( $submittedData ['tables'] );
	}
	/**
	 * @param array &$submittedData
	 * @param tx_scheduler_Module $parentObject
	 * @return boolean
	 */
	public function validateAdditionalFields(array &$submittedData, tx_scheduler_Module $parentObject) {
		return TRUE;
	}

}