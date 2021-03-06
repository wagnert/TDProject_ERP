<?php

/**
 * TDProject_ERP_Common_ValueObjects_AddressViewData
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

require_once 'TechDivision/Collections/Interfaces/Collection.php';
require_once 'TechDivision/Collections/ArrayList.php';
require_once 'TechDivision/Model/Interfaces/Value.php';
require_once 'TDProject/ERP/Common/ValueObjects/AddressValue.php';

/**
 * This class is the data transfer object between the
 * model and the controller for the table address.
 *
 * Each class member reflects a database field and
 * the values of the related dataset.
 *
 * @category   	TDProject
 * @package     TDProject_ERP
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 * 				Open Software License (OSL 3.0)
 * @author      Tim Wagner <tw@techdivision.com>
 */
class TDProject_ERP_Common_ValueObjects_AddressViewData 
    extends TDProject_ERP_Common_ValueObjects_AddressValue 
    implements TechDivision_Model_Interfaces_Value {
    
    /**
     * The countries available in the system.
     * @var TechDivision_Collections_Interfaces_Collection
     */
    protected $_countries = null;
    
    /**
     * The constructor intializes the DTO with the
     * values passed as parameter.
     *
     * @param TDProject_ERP_Model_Entities_Address $address 
     * 		The array with the virtual members to pass to the parent constructor
     * @return void
     */
    public function __construct(TDProject_ERP_Model_Entities_Address $address = null)
    {
        // call the parents constructor
        parent::__construct($address);
        // initialize the ValueObject with the passed data
        $this->_countries = new TechDivision_Collections_ArrayList();
    }
        
    /**
     * Sets the available countries.
     * 
     * @param TechDivision_Collections_Interfaces_Collection $countries
     * 		The countries available in the system
     * @return void
     */
    public function setCountries(
        TechDivision_Collections_Interfaces_Collection $countries) {
        $this->_countries = $countries;
    }
        
    /**
     * Returns the available countries.
     * 
     * @return TechDivision_Collections_Interfaces_Collection
     * 		The countries available in the system
     */
    public function getCountries()
    {
        return $this->_countries;
    }
}