<?php
namespace RGJL\HotelBooking\ViewHelpers;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * FlexForm configuration container ViewHelper
 *
 * @package Flux
 * @subpackage ViewHelpers/Xml
 */
class AddSlashesViewHelper extends AbstractTagBasedViewHelper {

    /**
     * Escapes special characters with their escaped counterparts as needed using PHPs htmlspecialchars() function.
     *
     * @param string $value string to format
     * @return string the altered string
     * @see http://www.php.net/manual/function.htmlspecialchars.php
     * @api
     */
    public function render($value = NULL) {
        if ($value === NULL) {
            $value = $this->renderChildren();
        }
        if (!is_string($value)) {
            return $value;
        }
        return addslashes($value);
    }

}