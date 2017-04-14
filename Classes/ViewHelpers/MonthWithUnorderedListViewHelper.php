<?php

namespace Extcode\Dates\ViewHelpers;

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
 * MonthWithUnorderedList ViewHelper
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class MonthWithUnorderedListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @var int
     */
    protected $year;

    /**
     * @var int
     */
    protected $month;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var int
     */
    protected $tableCols;

    public function initializeArguments()
    {
        $this->registerArgument('year', 'integer', 'Year to displays', true);
        $this->registerArgument('month', 'integer', 'Month to displays', true);
        $this->registerArgument('offset', 'integer', 'Offset to Month to displays', false);
        $this->registerArgument('dates', 'array', 'Dates to displays', false);
        $this->registerArgument('hideMonthYearTitle', 'boolean', 'Hide Title of Month and Year', false);
        $this->registerArgument('hideWeekdayTitle', 'boolean', 'Hide Title of Day', false);
        $this->registerArgument('showWeekNumber', 'boolean', 'Show Number of Week', false);
        $this->registerArgument('showDayNumberOfPreviousAndNextMonth', 'boolean',
            'Show Number of Day of the previous and next Month', false);
        $this->registerArgument('showDatesOfPreviousAndNextMonth', 'boolean',
            'Show Dates of the previous and next Month',
            false);
    }

    /**
     * displays the table view of a given month
     *
     * @return string
     */
    public function render()
    {
        $content = '';

        $this->year = intval($this->arguments['year']);
        $this->month = intval($this->arguments['month']);
        $this->offset = intval($this->arguments['offset']);

        $this->calculateOffset();

        if ($this->arguments['showWeekNumber']) {
            $this->tableCols = 8;
        } else {
            $this->tableCols = 7;
        }

        $content .= '<div class="table-sheet-header">';
        $content .= $this->renderMonthYearInHead();
        $content .= '</div>';

        $content .= '<div class="table sheet">';
        $content .= $this->renderHead();
        $content .= $this->renderBody();
        $content .= $this->renderFoot();
        $content .= '</div>';

        return $content;
    }

    /**
     * displays the table head section
     *
     * @return string
     */
    protected function renderHead()
    {
        $content = '';

        $content .= $this->renderWeekdayInHead();

        return $content;
    }

    /**
     * displays the table body section
     *
     * @return string
     */
    protected function renderBody()
    {
        $day_today = date('j');
        $month_today = date('m');
        $year_today = date('Y');
        $week_today = date('W');

        $first_day_in_month = mktime(0, 0, 0, $this->month, 1, $this->year);
        $running_day = date('w', $first_day_in_month);
        if ($running_day == 0) {
            $running_day = 7;
        }

        $days_in_month = date('t', $first_day_in_month);
        $days_in_this_week = 1;
        $day_counter = 0;

        $week = date('W', $first_day_in_month);
        $week_class = 'week week-' . $week . ' row';
        if ($week == $week_today) {
            $week_class .= ' current';
        }

        $content = '';

        if ($running_day != 1) {
            $content .= '<ul class="' . $week_class . '">';
            $content .= $this->renderCalendarWeek($week);
        }

        for ($x = 1; $x < $running_day; $x++) {
            if ($this->arguments['showDayNumberOfPreviousAndNextMonth']) {
                $time = mktime(0, 0, 0, $this->month, 1, $this->year) - (($running_day - $x) * 86400);

                $day = date('j', $time);
                $month = date('M', $time);
                $year = date('y', $time);

                $content .= $this->renderDatesCell($day, $month, $year, $running_day,
                    $this->arguments['showDatesOfPreviousAndNextMonth']);
            } else {
                $content .= '<li></li>';
            }
            $days_in_this_week++;
        }

        for ($list_day = 1; $list_day <= $days_in_month; $list_day++) {
            if ($running_day == 1) {
                $week = date('W', mktime(0, 0, 0, $this->month, $list_day, $this->year));
                $week_class = 'calendar-row week-' . $week;
                if ($week == $week_today) {
                    $week_class .= ' current';
                }
                $content .= '<ul class="week week-' . $week_class . ' row">';

                $content .= $this->renderCalendarWeek($week);
            }

            $class = 'active';
            if (($list_day == $day_today) && ($this->month == $month_today) && ($this->year == $year_today)) {
                $class = 'active current';
            }

            $content .= $this->renderDatesCell($list_day, $this->month, $this->year, $running_day, true, $class);

            if ($running_day == 7) {
                $content .= '</ul>';

                if ($list_day != $days_in_month) {
                    $running_day = 1;
                    $days_in_this_week = 1;
                } else {
                    $days_in_this_week++;
                }
            } else {
                $running_day++;
                $days_in_this_week++;
                $day_counter++;
            }
        }

        if ($days_in_this_week < 8) {
            for ($x = 0; $x < (8 - $days_in_this_week); $x++) {
                if ($this->arguments['showDayNumberOfPreviousAndNextMonth']) {
                    $time = mktime(0, 0, 0, $this->month, 1, $this->year) + ($x * 86400);

                    $day = date('j', $time);
                    $month = date('M', $time);
                    $year = date('y', $time);
                    $weekday = date('w', $time);

                    $content .= $this->renderDatesCell($day, $month, $year, $weekday,
                        $this->arguments['showDatesOfPreviousAndNextMonth']);
                } else {
                    $content .= '<li></li>';
                }
            }
        }

        $content .= '</ul>';

        return $content;
    }

    /**
     * displays the table foot section
     *
     * @return string
     */
    protected function renderFoot()
    {
        $content = '';

        return $content;
    }

    /**
     * displays the month and year in table head section
     *
     * @return string
     */
    protected function renderMonthYearInHead()
    {
        $content = '';

        if (!$this->arguments['hideMonthYearTitle']) {
            $content .= '<tr class="calendar-row monthTitle">';
            $content .= '<th colspan="' . $this->tableCols . '">' . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.month.' . $this->month,
                    'Dates') . ' ' . $this->year . '</th>';
            $content .= '</tr>';
        }

        return $content;
    }

    /**
     * displays the weekdays in table head seaction
     *
     * @return string
     */
    protected function renderWeekdayInHead()
    {
        $dayOfWeekArr = [
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.1', 'Dates'),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.2', 'Dates'),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.3', 'Dates'),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.4', 'Dates'),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.5', 'Dates'),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.6', 'Dates'),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.7', 'Dates')
        ];

        $content = '';

        if (!$this->arguments['hideWeekdayTitle']) {
            $week_today = date('w');
            if ($week_today == 0) {
                $week_today = 7;
            }

            $content .= '<ul class="thead row">';
            if ($this->arguments['showWeekNumber']) {
                $content .= '<li class="th week-nr cell">' . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.calendar_week',
                        'Dates') . '</li>';
            }

            foreach ($dayOfWeekArr as $index => $dayOfWeek) {
                $class = 'th cell';
                if ($index + 1 == $week_today) {
                    $class .= ' current';
                }
                $content .= '<li class="' . $class . '">' . $dayOfWeek . '</li>';
            }
            $content .= '</ul>';
        }

        return $content;
    }

    /**
     * displays a list of dates for a given day
     *
     * @param int $day
     * @param int $month
     * @param int $year
     * @return string
     */
    protected function renderDatesForDay($day, $month, $year)
    {
        $dates = $this->arguments['dates'];
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        $content = '';

        if ($dates) {
            $date_content = '';
            foreach ($dates as $date) {
                $date_content .= $this->renderDateForDay($date, $timestamp);
            }

            if ($date_content != '') {
                $content .= '<li class="entries"><ol>';
                $content .= $date_content;
                $content .= '</ol></li>';
            }
        }

        return $content;
    }

    /**
     * displays a list item of dates for a given day
     *
     * @var $date \Extcode\Dates\Domain\Model\Date
     * @param $timestamp
     * @return string
     */
    protected function renderDateForDay($date, $timestamp)
    {
        $content = '';

        if (
            (
                ($date->getStart()->getTimestamp() > $timestamp) &&
                ($date->getStart()->getTimestamp() < $timestamp + 86400)
            ) || (
                ($date->getStart()->getTimestamp() < $timestamp + 86400) &&
                ($date->getEnd()->getTimestamp() > $timestamp)
            ) || (
                ($date->getEnd()->getTimestamp() > $timestamp) &&
                ($date->getEnd()->getTimestamp() < $timestamp + 86400)
            )
        ) {
            // TODO: add possibility to change links through TypoScript
            $eID = true;

            if ($eID) {
                $showActionLink = '?eID=datesAjaxDispatcher';
                $showActionLink .= '&extensionName=Dates';
                $showActionLink .= '&pluginName=dates';
                $showActionLink .= '&controllerName=Dates';
                $showActionLink .= '&actionName=detail';
                $showActionLink .= '&arguments[date]=' . $date->getUid();
            } else {
                $uriBuilder = $this->controllerContext->getUriBuilder();
                $action = 'show';
                $arguments = [
                    'date' => $date
                ];
                $showActionLink = $uriBuilder->uriFor($action, $arguments);
            }

            if ($date->getShortTitle()) {
                $content .= '<li class="item"><ul>';
                $content .= '<li class="topic event-typ-' . $date->getTyp() . '">';
                $content .= '<a class="fancybox-custom fancybox.ajax" href="' . $showActionLink . '" title="' . $date->getTitle() . '">' . $date->getShortTitle() . '</a>';
                $content .= '</li>';
                $content .= '</ul></li>';
            } else {
                $content .= '<li class="item"><ul>';
                $content .= '<li class="topic event-typ-' . $date->getTyp() . '">';
                $content .= '<a class="fancybox-custom fancybox.ajax" href="' . $showActionLink . '">' . $date->getTitle() . '</a>';
                $content .= '</li>';
                $content .= '</ul></li>';
            }
        }

        return $content;
    }

    /**
     * displays a day cell
     *
     * @param int $day
     * @param int $month
     * @param int $year
     * @param int $weekday
     * @param bool $renderDates
     * @param string $class
     * @return string
     */
    protected function renderDatesCell($day, $month, $year, $weekday, $renderDates = true, $class = 'calendar-day')
    {
        $content = '';

        $content .= '<li class="td day day-' . $day . ' cell ' . $class . '">';
        $content .= '<ul class="inner">';
        $content .= '<li class="date">' . sprintf('%02d', $day) . '</li>';
        $content .= '<li class="date-background">' . sprintf('%02d', $day) . '</li>';
        $content .= '<li class="weekday">' . \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_dates_domain_model_date.weekday.' . $weekday,
                'Dates') . '</li>';
        if ($renderDates) {
            $content .= $this->renderDatesForDay($day, $month, $year);
        }
        $content .= '</ul>';
        $content .= '</li>';

        return $content;
    }

    /**
     * displays the number of week for a given day
     *
     * @param int $week
     * @return string
     */
    protected function renderCalendarWeek($week)
    {
        $content = '';

        if ($this->arguments['showWeekNumber']) {
            $content .= '<li class="td week-nr cell">';
            $content .= '<div class="inner">';
            $content .= $week;
            $content .= '</div>';
            $content .= '</li>';
        }

        return $content;
    }

    /**
     * calculates the month and year to display for given month, year and offset
     *
     * return void
     */
    protected function calculateOffset()
    {
        $month = ($this->offset > 0) ? $this->month + $this->offset : $this->month;
        if ($month < 1) {
            $this->month = $month + 12;
            $this->year--;
        } elseif ($month > 12) {
            $this->month = $month - 12;
            $this->year++;
        } else {
            $this->month = $month;
        }
    }
}
