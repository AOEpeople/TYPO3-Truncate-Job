<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
if (TYPO3_MODE == 'BE') {
	require_once t3lib_extMgm::extPath($_EXTKEY) . 'Classes/TruncateTask.php';
	require_once t3lib_extMgm::extPath($_EXTKEY) . 'Classes/TruncateTaskFieldProvider.php';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Tx_TruncateJob_TruncateTask'] = array(
		'extension' => $_EXTKEY,
		'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xml:scheduler_task.name',
		'description' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xml:scheduler_task.description',
		'additionalFields' => 'tx_TruncateJob_TruncateFieldProvider',
	);
}