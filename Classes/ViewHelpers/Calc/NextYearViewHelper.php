<?php

namespace Extcode\Dates\ViewHelpers\Calc;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * NextYearViewHelper ViewHelper
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class NextYearViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('year', 'integer', 'Year to Display', true);
        $this->registerArgument('month', 'integer', 'Month to Display', true);
        $this->registerArgument('offset', 'integer', 'Offset to Month to Display', false);
    }

    /**
     * Display the table view of a given month
     *
     * @return string
     */
    public function render()
    {
        $year = intval($this->arguments['year']);
        $month = intval($this->arguments['month']);
        $offset = intval($this->arguments['offset']);

        if (!$offset) {
            $offset = 1;
        }

        $month += $offset;

        if ($month > 12) {
            $year_offset = intval($month / 12);
        }

        return $year + $year_offset;
    }
}
