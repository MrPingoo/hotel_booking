<?php
namespace RGJL\HotelBooking\Utility;

use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Class GeneralUtility
 *
 */

class GeneralUtility {


	/**
	 * rentRepository
	 *
	 * @var \RGJL\HotelBooking\Domain\Repository\RentRepository
	 * @inject
	 */
	protected $rentRepository = NULL;

	/**
	 * Will get the values from plugin.tx_exlpagesutilities_pageslist.settings.sorting_options
	 * and return an array which can be used for the flexform options field.
	 *
	 * @param array	$params
	 */
	public function getOptionsForFlexform(&$params) {

		$rents = $this->rentRepository->findAll();

		var_dump($rents);
		die();

		foreach($rents as $key => $value) {
			$options[$value->getName()] = array($value->getName(), $value->getId());
		}

		asort($options);

		$params['items'] = $options;

	}

	/**
	 * Returns the TypoScript configuration of a given page as an array.
	 *
	 * @param int $uid	The uid of the page you want the TypoScript configuration from. If none given, the full configuration is used.
	 * @return array
	 */
	public static function getPageConfiguration($uid = NULL) {
		/** @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\\TYPO3\\CMS\\Extbase\\Object\\ObjectManager');

		/** @var $typoScriptService \TYPO3\CMS\Extbase\Service\TypoScriptService */
		$typoScriptService = $objectManager->get('\\TYPO3\\CMS\\Extbase\\Service\\TypoScriptService');

		if ($uid && MathUtility::canBeInterpretedAsInteger($uid) && $uid > 0) {
			/** @var $pageRepository \TYPO3\CMS\Frontend\Page\PageRepository */
			$pageRepository = $objectManager->get('\\TYPO3\\CMS\\Frontend\\Page\\PageRepository');
			$rootLine = $pageRepository->getRootLine($uid);

			/** @var $templateService \TYPO3\CMS\Core\TypoScript\TemplateService */
			$templateService = $objectManager->get('\\TYPO3\\CMS\\Core\\TypoScript\\TemplateService');
			$templateService->tt_track = 0;
			$templateService->init();
			$templateService->runThroughTemplates($rootLine);
			$templateService->generateConfig();

			$fullConfiguration = $typoScriptService->convertTypoScriptArrayToPlainArray($templateService->setup);
		}
		else {
			/** @var $configurationManager \TYPO3\CMS\Extbase\Configuration\ConfigurationManager */
			$configurationManager = $objectManager->get('\\TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

			$fullConfiguration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

			if (is_array($fullConfiguration) && !empty($fullConfiguration)) {
				$fullConfiguration = $typoScriptService->convertTypoScriptArrayToPlainArray($fullConfiguration);
			}
		}

		return $fullConfiguration;
	}

}