<?php

/**
 * TDProject_ERP_Model_Assembler_Country
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * @category   	TDProject
 * @package    	TDProject_Core
 * @copyright  	Copyright (c) 2010 <info@techdivision.com> - TechDivision GmbH
 * @license    	http://opensource.org/licenses/osl-3.0.php
 * 				Open Software License (OSL 3.0)
 * @author      Tim Wagner <tw@techdivision.com>
 */
class TDProject_ERP_Model_Assembler_Country 
    extends TDProject_Core_Model_Assembler_Abstract {

    /**
     * Factory method to create a new instance.
     *
     * @param TechDivision_Model_Interfaces_Container $container The container instance
     * @return TDProject_Channel_Model_Actions_Category
     * 		The requested instance
     */
    public static function create(TechDivision_Model_Interfaces_Container $container)
    {
        return new TDProject_ERP_Model_Assembler_Country($container);
    }  

    /**
     * Returns an ArrayList with all countries 
     * assembled as LVO's.
     * 
     * @return TechDivision_Collections_ArrayList
     * 		The requested country LVO's
     */
    public function getCountryLightValues() {
        // initialize a new ArrayList
        $list = new TechDivision_Collections_ArrayList();
        // load the countries
        $countries = TDProject_ERP_Model_Utils_CountryUtil::getHome($this->getContainer())
            ->findAll();
        // assemble the countries
        foreach ($countries as $country) {
            $list->add($country->getLightValue());
        }
        // return the ArrayList with the CountryLightValues
        return $list;
    }  

    /**
     * Returns an ArrayList with all countries 
     * assembled as DTO's.
     * 
     * @return TechDivision_Collections_ArrayList
     * 		The requested country DTO's
     */
    public function getCountryOverviewData() {
        // initialize a new ArrayList
        $list = new TechDivision_Collections_ArrayList();
        // load the countries
        $countries = TDProject_ERP_Model_Utils_CountryUtil::getHome($this->getContainer())
            ->findAll();
        // assemble the countries
        foreach ($countries as $country) {
            $list->add(
            	new TDProject_ERP_Common_ValueObjects_CountryOverviewData($country)
            );
        }
        // return the ArrayList with the CountryOverviewData DTO's
        return $list;
    }
}