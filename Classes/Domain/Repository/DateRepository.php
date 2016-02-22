<?php

namespace Extcode\Dates\Domain\Repository;

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
 * Date Repository
 *
 * @package date
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class DateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    public function findAllByMonthAndYear($month, $year, $span = 3)
    {
        $query = $this->createQuery();

        if (!$month) {
            $month = date('m');
        }
        if (!$year) {
            $year = date('y');
        }

        $logicalAndConstraints = [];

        $start_time_window = mktime(0, 0, 0, $month, 1, $year);
        $end_time_window = mktime(0, 0, 0, $month + $span, 1, $year);

        $logicalOrConstraints = [];

        $logicalOrConstraints[] = $query->greaterThanOrEqual('start', $start_time_window);
        $logicalOrConstraints[] = $query->lessThan('end', $end_time_window);

        $logicalAndConstraints[] = $query->logicalOr($logicalOrConstraints);

        $logicalAndConstraints[] = $query->greaterThanOrEqual('end', $start_time_window);
        $logicalAndConstraints[] = $query->lessThan('start', $end_time_window);

        unset($logicalOrConstraints);

        if ($logicalAndConstraints) {
            $query = $query->matching($query->logicalAnd($logicalAndConstraints));
        }

        return $query->execute();
    }

    public function findAllBeforeMonthAndYear($month, $year)
    {
        $query = $this->createQuery();

        if (!$month) {
            $month = date('m');
        }
        if (!$year) {
            $year = date('y');
        }

        $logicalAndConstraints = [];

        $prev_time = mktime(0, 0, 0, $month, 1, $year);

        $logicalOrConstraints = [];

        $logicalOrConstraints[] = $query->lessThan('start', $prev_time);
        $logicalOrConstraints[] = $query->lessThan('end', $prev_time);

        $logicalAndConstraints[] = $query->logicalOr($logicalOrConstraints);

        unset($logicalOrConstraints);

        if ($logicalAndConstraints) {
            $query = $query->matching($query->logicalAnd($logicalAndConstraints));
        }

        return $query->execute();
    }

    public function countAllBeforeMonthAndYear($month, $year)
    {
        return $this->findAllBeforeMonthAndYear($month, $year)->count();
    }

    public function findAllAfterMonthAndYear($month, $year)
    {
        $query = $this->createQuery();

        if (!$month) {
            $month = date('m');
        }
        if (!$year) {
            $year = date('y');
        }

        $logicalAndConstraints = [];

        $next_time = mktime(0, 0, 0, $month + 1, 1, $year);

        $logicalOrConstraints = [];

        $logicalOrConstraints[] = $query->greaterThanOrEqual('start', $next_time);
        $logicalOrConstraints[] = $query->greaterThanOrEqual('end', $next_time);

        $logicalAndConstraints[] = $query->logicalOr($logicalOrConstraints);

        unset($logicalOrConstraints);

        if ($logicalAndConstraints) {
            $query = $query->matching($query->logicalAnd($logicalAndConstraints));
        }

        return $query->execute();
    }

    public function countAllAfterMonthAndYear($month, $year)
    {
        return $this->findAllAfterMonthAndYear($month, $year)->count();
    }

    public function findNextTeaserableDate($timestamp, $limit = 3)
    {
        $query = $this->createQuery();
        $logicalOrConstraints = [];

        $logicalAndConstraints[] = $query->greaterThanOrEqual('end', $timestamp);
        $logicalAndConstraints[] = $query->equals('is_teaser', true);

        unset($logicalOrConstraints);

        if ($logicalAndConstraints) {
            $query = $query->matching($query->logicalAnd($logicalAndConstraints));
        }
        $query->setLimit((integer)$limit);

        return $query->execute();
    }

}
