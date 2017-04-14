<?php

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
 * Ajax Dispatcher
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class AjaxDispatcher
{

    /**
     * Array of all request Arguments
     *
     * @var array
     */
    protected $requestArguments = [];

    /**
     * Extbase Object Manager
     * @var Tx_Extbase_Object_ObjectManager
     */
    protected $objectManager;

    /**
     * @var string
     */
    protected $extensionName;

    /**
     * @var string
     */
    protected $pluginName;

    /**
     * @var string
     */
    protected $controllerName;

    /**
     * @var string
     */
    protected $actionName;

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var int
     */
    protected $pageUid;

    /**
     * Initializes and dispatches actions
     *
     * Call this function if you want to use this dispatcher "standalone"
     */
    public function initAndDispatch()
    {
        $this->initCallArguments()->dispatch();
    }

    /**
     * Called by ajax.php / eID.php
     * Builds an extbase context and returns the response
     *
     * ATTENTION: You should not call this method without initializing the dispatcher. Use initAndDispatch() instead!
     */
    public function dispatch_alt()
    {
        $configuration['extensionName'] = $this->extensionName;
        $configuration['pluginName'] = $this->pluginName;

        $bootstrap = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Core_Bootstrap');
        $bootstrap->initialize($configuration);

        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');

        $request = $this->buildRequest();
        $response = $this->objectManager->create('Tx_Extbase_MVC_Web_Response');

        $dispatcher = $this->objectManager->get('Tx_Extbase_MVC_Dispatcher');
        $dispatcher->dispatch($request, $response);

        $response->sendHeaders();
        return $response->getContent();
    }

    /**
     * Called by ajax.php / eID.php
     * Builds an extbase context and returns the response
     *
     * ATTENTION: You should not call this method without initializing the dispatcher. Use initAndDispatch() instead!
     */
    public function dispatch()
    {
        $this->conf = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_dates.'];

        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            'TYPO3\CMS\Extbase\Object\ObjectManager'
        );

        $this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            'TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager'
        );
    }

    /**
     * @param null $pageUid
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function init($pageUid = null)
    {
        //define('TYPO3_MODE','FE');

        $this->pageUid = $pageUid;

        $GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tslib_fe', $TYPO3_CONF_VARS, $pageUid, '0', 1, '', '', '', '');
        $GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_pageSelect');

        //$GLOBALS['TSFE']->initFeuser();
        $GLOBALS['TSFE']->fe_user = \TYPO3\CMS\Frontend\Utility\EidUtility::initFeUser();

        return $this;
    }

    /**
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function initTypoScript()
    {
        $GLOBALS['TSFE']->getPageAndRootline();
        $GLOBALS['TSFE']->initTemplate();
        $GLOBALS['TSFE']->getConfigArray();

        return $this;
    }

    /**
     */
    public function cleanShutDown()
    {
        $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
        $this->objectManager->get('Tx_Extbase_Reflection_Service')->shutdown();
    }

    /**
     * Build a request object
     *
     * @return Tx_Extbase_MVC_Web_Request $request
     */
    protected function buildRequest()
    {
        $request = $this->objectManager->get('Tx_Extbase_MVC_Web_Request');
        /* @var $request Tx_Extbase_MVC_Request */
        $request->setControllerExtensionName($this->extensionName);
        $request->setPluginName($this->pluginName);
        $request->setControllerName($this->controllerName);
        $request->setControllerActionName($this->actionName);
        $request->setArguments($this->arguments);

        return $request;
    }

    /**
     * Prepare the call arguments
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function initCallArguments()
    {
        $request = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('request');

        if ($request) {
            $this->setRequestArgumentsFromJSON($request);
        } else {
            $this->setRequestArgumentsFromGetPost();
        }

        $this->extensionName = $this->requestArguments['extensionName'];
        $this->pluginName = $this->requestArguments['pluginName'];
        $this->controllerName = $this->requestArguments['controllerName'];
        $this->actionName = $this->requestArguments['actionName'];

        $this->arguments = $this->requestArguments['arguments'];

        if (!is_array($this->arguments)) {
            $this->arguments = [];
        }

        return $this;
    }

    /**
     * Set the request array from JSON
     *
     * @param string $request
     */
    protected function setRequestArgumentsFromJSON($request)
    {
        $requestArray = json_decode($request, true);
        if (is_array($requestArray)) {
            $this->requestArguments = \TYPO3\CMS\Core\Utility\GeneralUtility::mergeRecursiveWithOverrule($this->requestArguments, $requestArray);
        }
    }

    /**
     * Set the request array from the getPost array
     */
    protected function setRequestArgumentsFromGetPost()
    {
        $validArguments = ['extensionName', 'pluginName', 'controllerName', 'actionName', 'arguments'];
        foreach ($validArguments as $argument) {
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP($argument)) {
                $this->requestArguments[$argument] = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP($argument);
            }
        }
    }

    /**
     * @param $extensionName
     * @throws Exception
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function setExtensionName($extensionName)
    {
        if (!$extensionName) {
            throw new Exception('No extension name set for extbase request.', 1327583056);
        }

        $this->extensionName = $extensionName;
        return $this;
    }

    /**
     * @param $pluginName
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function setPluginName($pluginName)
    {
        $this->pluginName = $pluginName;
        return $this;
    }

    /**
     * @param $controllerName
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @param $actionName
     * @return Tx_PtExtbase_Utility_AjaxDispatcher
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
        return $this;
    }
}
