<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Booking',
	'Booking'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'RGJL.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'booking',	// Submodule key
		'',						// Position
		array(
			'Rent' => 'list, show, new, create, edit, update, delete','Price' => 'list, show, new, create, edit, update, delete','Booking' => 'list, listByRent, show, new, create, edit, update, delete','User' => 'list, show, new, create, edit, update, delete',
		),
	/* JL 20151010
		array(
			'Rent' => 'list, show, new, create, edit, update, delete','Price' => 'list, show, new, create, edit, update, delete','Booking' => 'list, show, new, create, edit, update, delete','User' => 'list, show, new, create, edit, update, delete',
		),
	 */
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_booking.xlf',
			'inheritNavigationComponentFromMainModule' => FALSE,
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Hotel Booking');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hotelbooking_domain_model_rent', 'EXT:hotel_booking/Resources/Private/Language/locallang_csh_tx_hotelbooking_domain_model_rent.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hotelbooking_domain_model_rent');
$GLOBALS['TCA']['tx_hotelbooking_domain_model_rent'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hotel_booking/Resources/Private/Language/locallang_db.xlf:tx_hotelbooking_domain_model_rent',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,house_work,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Rent.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hotelbooking_domain_model_rent.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hotelbooking_domain_model_price', 'EXT:hotel_booking/Resources/Private/Language/locallang_csh_tx_hotelbooking_domain_model_price.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hotelbooking_domain_model_price');
$GLOBALS['TCA']['tx_hotelbooking_domain_model_price'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hotel_booking/Resources/Private/Language/locallang_db.xlf:tx_hotelbooking_domain_model_price',
		'label' => 'begin_date',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'begin_date,end_date,day_price,week_price,uid_foreign,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Price.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hotelbooking_domain_model_price.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hotelbooking_domain_model_booking', 'EXT:hotel_booking/Resources/Private/Language/locallang_csh_tx_hotelbooking_domain_model_booking.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hotelbooking_domain_model_booking');
$GLOBALS['TCA']['tx_hotelbooking_domain_model_booking'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hotel_booking/Resources/Private/Language/locallang_db.xlf:tx_hotelbooking_domain_model_booking',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'begin_date,end_date,price,uid_foreign,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Booking.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hotelbooking_domain_model_booking.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hotelbooking_domain_model_user', 'EXT:hotel_booking/Resources/Private/Language/locallang_csh_tx_hotelbooking_domain_model_user.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hotelbooking_domain_model_user');
$GLOBALS['TCA']['tx_hotelbooking_domain_model_user'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hotel_booking/Resources/Private/Language/locallang_db.xlf:tx_hotelbooking_domain_model_user',
		'label' => 'first_name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'first_name,last_name,email,phone,address,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/User.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hotelbooking_domain_model_user.gif'
	),
);

/* Getting the FlexForm */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_booking';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$pluginSignature,
	'FILE:EXT:hotel_booking/Configuration/FlexForms/flexform.xml'
);