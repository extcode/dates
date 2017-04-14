<?php

namespace Extcode\Dates\Controller;

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
 * Dates Controller
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class DatesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * dateRepository
     *
     * @var \Extcode\Dates\Domain\Repository\DateRepository
     * @inject
     */
    protected $dateRepository;

    /**
     * action calendar
     */
    public function calendarAction()
    {
        $month = 0;
        $year = 0;
        $monthOffset = 0;
        $yearOffset = 0;

        if ($this->request->hasArgument('offset')) {
            if (intval($this->request->getArgument('offset'))) {
                $monthOffset = intval($this->request->getArgument('offset'));
                if (($monthOffset < -12) || ($monthOffset > 12)) {
                    $monthOffset = 0;
                }
            }
        }

        if ($this->request->hasArgument('month')) {
            if (intval($this->request->getArgument('month'))) {
                if (($this->request->getArgument('month') >= 1) && ($this->request->getArgument('month') <= 12)) {
                    $month = intval($this->request->getArgument('month'));
                } else {
                    $this->redirect('list', 'Dates', null, ['year' => date('Y'), 'month' => date('m')]);
                }
            }
        }

        if (!$month) {
            $month = date('m');
        } else {
            if ($monthOffset) {
                $month = $month + $monthOffset;
            }

            if ($month < 1) {
                $month = $month + 12;
                $yearOffset = -1;
            } elseif ($month > 12) {
                $month = $month - 12;
                $yearOffset = +1;
            }
        }
        $this->view->assign('month', $month);

        if ($this->request->hasArgument('year')) {
            if (intval($this->request->getArgument('year'))) {
                if (($this->request->getArgument('year') >= (1900 + $yearOffset))
                    && ($this->request->getArgument('year') <= (2100 + $yearOffset))
                ) {
                    $year = intval($this->request->getArgument('year')) + $yearOffset;
                } else {
                    $this->redirect('list', 'Dates', null, ['year' => date('Y'), 'month' => date('m')]);
                }
            }
        }
        if (!$year) {
            $year = date('Y');
        }
        $this->view->assign('year', $year);

        $dates = $this->dateRepository->findAllByMonthAndYear($month, $year);
        $this->view->assign('dates', $dates);
    }

    /**
     * action list
     */
    public function listAction()
    {
        $month = 0;
        $year = 0;
        $monthOffset = 0;
        $yearOffset = 0;

        if ($this->request->hasArgument('offset')) {
            if (intval($this->request->getArgument('offset'))) {
                $monthOffset = intval($this->request->getArgument('offset'));

                if (($monthOffset < -12) && ($monthOffset > 12)) {
                    $monthOffset = 0;
                }
            }
        }
        $this->view->assign('offset', $monthOffset);

        if ($this->request->hasArgument('month')) {
            if (intval($this->request->getArgument('month'))) {
                $month = intval($this->request->getArgument('month'));

                if (($month < 1) && ($month > 12)) {
                    $this->redirect('list', 'Dates', null, ['year' => date('Y'), 'month' => date('m')]);
                }
            }
        }

        if (!$month) {
            $month = intval(date('n'));
        } else {
            if ($monthOffset) {
                $month = $month + $monthOffset;
            }
            if ($month < 1) {
                $month = $month + 12;
                $yearOffset = -1;
            } elseif ($month > 12) {
                $month = $month - 12;
                $yearOffset = +1;
            } else {
                $yearOffset = 0;
            }
        }
        $this->view->assign('month', $month);

        if ($this->request->hasArgument('year')) {
            if (intval($this->request->getArgument('year'))) {
                $year = intval($this->request->getArgument('year'));

                if (($year >= (1900 + $yearOffset)) && ($year <= (2100 + $yearOffset))) {
                    $year = $year + $yearOffset;
                } else {
                    $this->redirect('list', 'Dates', null, ['year' => date('Y'), 'month' => date('m')]);
                }
            }
        }
        if (!$year) {
            $year = date('Y');
        }
        $this->view->assign('year', $year);

        $dates = $this->dateRepository->findAllByMonthAndYear($month, $year, $this->settings['list']['showMonth']);
        $beforeDates = $this->dateRepository->countAllBeforeMonthAndYear($month, $year);
        $afterDates = $this->dateRepository->countAllAfterMonthAndYear($month, $year);

        $skipEmptyMonth = intval($this->settings['listView']['$skipEmptyMonth']);

        if ($dates->count() || !$skipEmptyMonth) {
            $this->view->assign('dates', $dates);
            $this->view->assign('before_dates', $beforeDates);
            $this->view->assign('after_dates', $afterDates);
        } else {
            if ($monthOffset == 0) {
                $monthOffset = 1;
            }

            if ($monthOffset > 0) {
                //check if events in future exist, else do not skip month
                if ($afterDates == 0) {
                    $skipEmptyMonth = 0;
                }
            } else {
                //check if events in past exist, else do not skip month
                if ($beforeDates == 0) {
                    $skipEmptyMonth = 0;
                }
            }

            if ($skipEmptyMonth) {
                // find for max skipping month event dates
                $skipMaxMonth = intval($this->settings['listView']['skipMaxMonth']);
                for ($calc_offset = 0; $calc_offset < $skipMaxMonth; $calc_offset++) {
                    $month_with_offset = $this->getMonthByOffset($month, ($calc_offset + 1) * $monthOffset);
                    $year_with_offset = $this->getYearByOffset($month, $year, ($calc_offset + 1) * $monthOffset);
                    $next_dates_count = $this->dateRepository->findAllByMonthAndYear(
                        $month_with_offset,
                        $year_with_offset,
                        1
                    )->count();
                    if ($next_dates_count > 0) {
                        $this->redirect(
                            'list',
                            'Dates',
                            null,
                            ['month' => $month_with_offset, 'year' => $year_with_offset]
                        );
                    }
                }
            }

            //assign actual values if not skipping month or within skip max month no events available
            $this->view->assign('dates', $dates);
            $this->view->assign('before_dates', $beforeDates);
            $this->view->assign('after_dates', $afterDates);
        }
    }

    /**
     * @param $month
     * @param $offset
     * @return mixed
     */
    protected function getMonthByOffset($month, $offset)
    {
        if ($month) {
            $month = $month + $offset;
        }
        if ($month < 1) {
            $month = $month + 12;
        } elseif ($month > 12) {
            $month = $month - 12;
        }
        return $month;
    }

    /**
     * @param $month
     * @param $year
     * @param $offset
     * @return mixed
     */
    protected function getYearByOffset($month, $year, $offset)
    {
        if ($month) {
            $month = $month + $offset;
        }
        if ($month < 1) {
            $year = $year - 1;
        } elseif ($month > 12) {
            $year = $year + 1;
        }
        return $year;
    }

    /**
     * action detail
     *
     * @param \Extcode\Dates\Domain\Model\Date $date
     */
    public function detailAction(\Extcode\Dates\Domain\Model\Date $date)
    {
        $this->view->assign('date', $date);
    }

    /**
     * action show
     *
     * @param \Extcode\Dates\Domain\Model\Date $date
     * @param \Extcode\Dates\Domain\Model\Registration $registration
     * @dontvalidate $registration
     */
    public function showAction(
        \Extcode\Dates\Domain\Model\Date $date,
        \Extcode\Dates\Domain\Model\Registration $registration = null
    ) {
        if (!$registration) {
            $registration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                '\Extcode\Dates\Domain\Model\Registration'
            );
        }
        $this->view->assign('registration', $registration);
        $this->view->assign('actionName', 'show');
        $this->view->assign('date', $date);
    }

    /**
     * action teaser
     */
    public function teaserAction()
    {
        $timestamp = time();
        $limit = 1;

        if (intval($this->settings['teaser']['limit'])) {
            $limit = intval($this->settings['teaser']['limit']);
        }

        $dates = $this->dateRepository->findNextTeaserableDate($timestamp, $limit);

        $this->view->assign('dates', $dates);
    }

    /**
     * action singledate
     *
     * @param \Extcode\Dates\Domain\Model\Registration $registration
     * @dontvalidate $registration
     */
    public function singledateAction(\Extcode\Dates\Domain\Model\Registration $registration = null)
    {
        if (!$registration) {
            $registration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                '\Extcode\Dates\Domain\Model\Registration'
            );
        }

        $date = $this->dateRepository->findByUId($this->settings['selectDate']);

        $this->view->assign('actionName', 'singledate');
        $this->view->assign('registration', $registration);
        $this->view->assign('date', $date);
    }

    /**
     * action register
     *
     * @param \Extcode\Dates\Domain\Model\Date $date
     * @param \Extcode\Dates\Domain\Model\Registration $registration
     */
    public function registerAction(
        \Extcode\Dates\Domain\Model\Date $date,
        \Extcode\Dates\Domain\Model\Registration $registration
    ) {
        if ($date) {
            // send email to form sender
            if (!empty($this->settings['email']['register']['sender']['from'])) {
                $renderer = $this->getEmailRenderer('EmailFormSender');
                $renderer->assign('date', $date);
                $renderer->assign('registration', $registration);
                $mailBody = $renderer->render();

                $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_mail_Message');
                $mail->setFrom($this->settings['email']['register']['sender']['from'])
                    ->setTo($registration->getEmail())
                    ->setSubject(
                        \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                            'tx_dates_domain_model_date.mail.subject',
                            'Dates'
                        )
                    )
                    ->setBody($mailBody, 'text/html')
                    ->addPart(strip_tags($mailBody), 'text/plain')
                    ->send();
            }

            // send email to form administrator
            if (!empty($this->settings['email']['register']['administrator']['from'])
                && !empty($this->settings['email']['register']['administrator']['to'])
            ) {
                $renderer = $this->getEmailRenderer('EmailFormAdministrator');
                $renderer->assign('date', $date);
                $renderer->assign('registration', $registration);
                $mailBody = $renderer->render();

                $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_mail_Message');
                $mail->setFrom($this->settings['email']['register']['administrator']['from'])
                    ->setTo($this->settings['email']['register']['administrator']['to'])
                    ->setSubject(
                        \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                            'tx_dates_domain_model_date.mail.subject',
                            'Dates'
                        )
                    )
                    ->setBody($mailBody, 'text/html')
                    ->addPart(strip_tags($mailBody), 'text/plain')
                    ->send();
            }

            // redirect
            $this->redirect('confirmation');
        } else {
            // TODO: error Message
            $message = '';
        }

        $this->redirect('list', 'Dates');
    }

    /**
     * This creates another stand-alone instance of the Fluid view to render a plain text e-mail template
     *
     * @param string $templateName
     * @param string $format
     *
     * @return \TYPO3\CMS\Fluid\View\StandaloneView the Fluid instance
     */
    protected function getEmailRenderer($templateName = 'default', $format = 'html')
    {
        $emailView = $this->objectManager->create('\TYPO3\CMS\Fluid\View\StandaloneView');
        $emailView->setFormat($format);

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['templateRootPath']
        );

        $templatePathAndFilename = $templateRootPath . $this->request->getControllerName() . '/' . $templateName . '.' . $format;

        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->setPartialRootPath(
            \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                $extbaseFrameworkConfiguration['view']['partialRootPath']
            )
        );
        $emailView->setLayoutRootPath(
            \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                $extbaseFrameworkConfiguration['view']['layoutRootPath']
            )
        );
        $emailView->assign('settings', $this->settings);

        return $emailView;
    }

    protected function addEndingSlash($path)
    {
        if (substr($path, (0 - strlen(DIRECTORY_SEPARATOR))) !== DIRECTORY_SEPARATOR) {
            $path .= DIRECTORY_SEPARATOR;
        }
        return $path;
    }

    /**
     * action confirmation
     */
    public function confirmationAction()
    {
    }
}
