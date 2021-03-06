<?php

/**
 * TDProject_ERP_Controller_Company_Ajax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

require_once 'TechDivision/Collections/ArrayList.php';
require_once 'TDProject/Core/Common/ValueObjects/System/UserValue.php';
require_once 'TDProject/Core/Controller/Util/GlobalForwardKeys.php';
require_once 'TDProject/ERP/Controller/Abstract.php';
require_once 'TDProject/Core/Block/Action/Messages.php';
require_once 'TDProject/ERP/Controller/Util/WebRequestKeys.php';
require_once 'TDProject/ERP/Controller/Util/MessageKeys.php';
require_once 'TDProject/ERP/Controller/Util/ErrorKeys.php';
require_once 'TDProject/ERP/Common/ValueObjects/CompanyAddressLightValue.php';
require_once 'TDProject/ERP/Common/ValueObjects/CompanyNoteLightValue.php';
require_once 'TDProject/ERP/Common/ValueObjects/PersonLightValue.php';

/**
 * @category   	TDProject
 * @package    	TDProject_ERP
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 * 				Open Software License (OSL 3.0)
 * @author      Johann Zelger <jz@techdivision.com>
 */
class TDProject_ERP_Controller_Company_Ajax
    extends TDProject_ERP_Controller_Abstract {

    /**
     * This method is automatically invoked by the controller and implements
     * the functionality to relate a newly created address with the actual
     * company.
     *
     * @return ActionForward Returns a ActionForward
     */
    public function relateCompanyAddressAction()
    {
        try {
            // load the address ID from the request
            $addressId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::ADDRESS_ID_FK,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // load the address type ID from the request
            $addressTypeId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::ADDRESS_TYPE_ID_FK,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // load the company ID from the request
            $companyId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::COMPANY_ID,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // initialize a new LVO
            $lvo = new TDProject_ERP_Common_ValueObjects_CompanyAddressLightValue();
            $lvo->setCompanyIdFk($companyId);
            $lvo->setAddressIdFk($addressId);
            $lvo->setAddressTypeIdFk($addressTypeId);
            // save the company-address relations
            $this->_getDelegate()->relateCompanyAddress($lvo);
            // create the affirmation message
	        $actionMessages = new TechDivision_Controller_Action_Messages();
            $actionMessages->addActionMessage(
                new TechDivision_Controller_Action_Message(
                    TDProject_ERP_Controller_Util_MessageKeys::AFFIRMATION,
                    $this->translate('companyAddressRelate.successfull')
                )
            );
            // save the ActionMessages in the request
            $this->_saveActionMessages($actionMessages);
            return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_MESSAGES
			);

        } catch(Exception $e) {
            // create and add and save the error
            $errors = new TechDivision_Controller_Action_Errors();
            $errors->addActionError(
                new TechDivision_Controller_Action_Error(
                    TDProject_ERP_Controller_Util_ErrorKeys::SYSTEM_ERROR,
                    $e->__toString()
                )
            );
            // adding the errors container to the Request
			$this->_saveActionErrors($errors);
			// set the ActionForward in the Context
			return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_ERROR
			);
        }
    }

    /**
     * This method is automatically invoked by the controller and implements
     * the functionality to unrelate a address with the actual company.
     *
     * @return ActionForward Returns a ActionForward
     */
    public function unrelateCompanyAddressAction()
    {
        try {
            // load the address ID from the request
            $addressId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::ADDRESS_ID_FK,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // load the company ID from the request
            $companyId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::COMPANY_ID,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // initialize a new LVO
            $lvo = new TDProject_ERP_Common_ValueObjects_CompanyAddressLightValue();
            $lvo->setCompanyIdFk($companyId);
            $lvo->setAddressIdFk($addressId);
            // delete the company-address relations
            $this->_getDelegate()->unrelateCompanyAddress($lvo);
            // create the affirmation message
	        $actionMessages = new TechDivision_Controller_Action_Messages();
            $actionMessages->addActionMessage(
                new TechDivision_Controller_Action_Message(
                    TDProject_ERP_Controller_Util_MessageKeys::AFFIRMATION,
                    $this->translate('companyAddressUnrelate.successfull')
                )
            );
            // save the ActionMessages in the request
            $this->_saveActionMessages($actionMessages);
            return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_MESSAGES
			);

        } catch(Exception $e) {
            // create and add and save the error
            $errors = new TechDivision_Controller_Action_Errors();
            $errors->addActionError(
                new TechDivision_Controller_Action_Error(
                    TDProject_ERP_Controller_Util_ErrorKeys::SYSTEM_ERROR,
                    $e->__toString()
                )
            );
            // adding the errors container to the Request
			$this->_saveActionErrors($errors);
			// set the ActionForward in the Context
			return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_ERROR
			);
        }
    }

    /**
     * This method is automatically invoked by the controller and implements
     * the functionality to relate a person with the actual company.
     *
     * @return ActionForward Returns a ActionForward
     */
    public function relateCompanyPersonAction()
    {
        try {
            // load the person ID from the request
            $personIdFk = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::PERSON_ID_FK,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // load the company ID from the request
            $companyId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::COMPANY_ID,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // initialize a new LVO
            $lvo = new TDProject_ERP_Common_ValueObjects_PersonLightValue();
            $lvo->setPersonId($personIdFk);
            $lvo->setCompanyIdFk($companyId);
            // save the company-address relations
            $this->_getDelegate()->relateCompanyPerson($lvo);
            // create the affirmation message
	        $actionMessages = new TechDivision_Controller_Action_Messages();
            $actionMessages->addActionMessage(
                new TechDivision_Controller_Action_Message(
                    TDProject_ERP_Controller_Util_MessageKeys::AFFIRMATION,
                    $this->translate('companyPersonRelate.successfull')
                )
            );
            // save the ActionMessages in the request
            $this->_saveActionMessages($actionMessages);
            return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_MESSAGES
			);
        } catch(Exception $e) {
            // create and add and save the error
            $errors = new TechDivision_Controller_Action_Errors();
            $errors->addActionError(
                new TechDivision_Controller_Action_Error(
                    TDProject_ERP_Controller_Util_ErrorKeys::SYSTEM_ERROR,
                    $e->__toString()
                )
            );
            // adding the errors container to the Request
			$this->_saveActionErrors($errors);
			// set the ActionForward in the Context
			return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_ERROR
			);
        }
    }

    /**
     * This method is automatically invoked by the controller and implements
     * the functionality to delete the relation of a person with the actual company.
     *
     * @return ActionForward Returns a ActionForward
     */
    public function unrelateCompanyPersonAction()
    {
    	try {
            // load the person ID from the request
            $personIdFk = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::PERSON_ID_FK,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // load the company ID from the request
            $companyId = TechDivision_Lang_Integer::valueOf(
                new TechDivision_Lang_String(
                    $this->_getRequest()->getParameter(
                    	TDProject_ERP_Controller_Util_WebRequestKeys::COMPANY_ID,
                    	FILTER_VALIDATE_INT
                    )
                )
            );
            // initialize a new LVO
            $lvo = new TDProject_ERP_Common_ValueObjects_PersonLightValue();
            $lvo->setPersonId($personIdFk);
            $lvo->setCompanyIdFk($companyId);
            // delete the company-address relations
            $this->_getDelegate()->unrelateCompanyPerson($lvo);
            // create the affirmation message
	        $actionMessages = new TechDivision_Controller_Action_Messages();
            $actionMessages->addActionMessage(
                new TechDivision_Controller_Action_Message(
                    TDProject_ERP_Controller_Util_MessageKeys::AFFIRMATION,
                    $this->translate('companyPersonUnrelate.successfull')
                )
            );
            // save the ActionMessages in the request
            $this->_saveActionMessages($actionMessages);
            return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_MESSAGES
			);

        } catch(Exception $e) {
            // create and add and save the error
            $errors = new TechDivision_Controller_Action_Errors();
            $errors->addActionError(
                new TechDivision_Controller_Action_Error(
                    TDProject_ERP_Controller_Util_ErrorKeys::SYSTEM_ERROR,
                    $e->__toString()
                )
            );
            // adding the errors container to the Request
			$this->_saveActionErrors($errors);
			// set the ActionForward in the Context
			return $this->_findForward(
			    TDProject_Core_Controller_Util_GlobalForwardKeys::SYSTEM_ERROR
			);
        }
    }

	/**
	 * Tries to load the Block class specified as path parameter
	 * in the ActionForward. If a Block was found and the class
	 * can be instanciated, the Block was registered to the Request
	 * with the path as key.
	 *
	 * @param TechDivision_Controller_Action_Forward $actionForward
	 * 		The ActionForward to initialize the Block for
	 * @return void
	 */
	protected function _getBlock(
	    TechDivision_Controller_Action_Forward $actionForward) {
	    // check if the class required to initialize the Block is included
	    if (!class_exists($path = $actionForward->getPath())) {
	        return;
	    }
	    // initialize the messages and add the Block
	    $page = new $path($this->getContext());
	    // register the Block in the Request
	    $this->_getRequest()->setAttribute($path, $page);
	}
}