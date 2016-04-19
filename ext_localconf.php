<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RGJL.' . $_EXTKEY,
	'Booking',
	array(
		'Rent' => 'front, list, show, new, create, edit, update, delete',
		'Price' => 'list, show, new, create, edit, update, delete',
		'Booking' => 'list, show, new, create, edit, update, delete, listByRent',
		'User' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Rent' => 'create, update, delete',
		'Price' => 'create, update, delete',
		'Booking' => 'create, update, delete',
		'User' => 'create, update, delete',
		
	)
);
