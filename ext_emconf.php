<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "truncate_job".
 *
 * Auto generated 16-01-2013 13:35
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Truncate Job',
	'description' => 'Scheduler Job to truncate tables',
	'category' => 'be',
	'author' => 'Axel Jung',
	'author_email' => 'axel.jung@aoemedia.de',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => 'AOE Media GmbH',
	'version' => '0.0.2',
	'constraints' => array(
		'depends' => array(
			'php' => '5.1.0-0.0.0',
			'typo3' => '4.3.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:8:{s:12:"ext_icon.gif";s:4:"71d2";s:17:"ext_localconf.php";s:4:"3d48";s:24:"Classes/TruncateTask.php";s:4:"234b";s:37:"Classes/TruncateTaskFieldProvider.php";s:4:"74c5";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"d70a";s:17:"Tests/phpunit.xml";s:4:"cf77";s:26:"Tests/TruncateTaskTest.php";s:4:"f91f";s:14:"doc/manual.sxw";s:4:"9cd6";}',
	'suggests' => array(
	),
);

?>