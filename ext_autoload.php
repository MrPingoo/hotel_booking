<?php
$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('hotel_booking') . 'Classes/';

$default = array(
   'GeneralUtility' => $extensionClassesPath . 'Utility/GeneralUtility.php',
);
return $default;