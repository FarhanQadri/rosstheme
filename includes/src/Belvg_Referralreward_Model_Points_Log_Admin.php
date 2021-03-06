<?php
/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
/******************************************
 *      MAGENTO EDITION USAGE NOTICE      *
 ******************************************/
 /* This package designed for Magento COMMUNITY edition
 * BelVG does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * BelVG does not provide extension support in case of
 * incorrect edition usage.
/******************************************
 *      DISCLAIMER                        *
 ******************************************/
/* Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future.
 ******************************************
 * @category   Belvg
 * @package    Belvg_Referralreward
 * @copyright  Copyright (c) 2010 - 2011 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */

class Belvg_Referralreward_Model_Points_Log_Admin extends Belvg_Referralreward_Model_Points_Log_Abstract
{
    /**
     * Supplement Points
     *
     * @param Mage_Newsletter_Model_Subscriber
     * @param array
     * @return Belvg_Referralreward_Model_Points_Log | boolean
     */
    public function supplementPoints($customerId, $params = array())
    {
        if (isset($params['points']) && $params['points']) {
            $params['status']      = 0;
            $params['type']        = Belvg_Referralreward_Model_Points_Log::TYPE_ADMIN;
            $params['object_id']   = 0;
            //$params['points']      = $points;
            $params['points_orig'] = $params['points'];
            $params['customer_id'] = $customerId;

            return Mage::getModel('referralreward/points_log')
                ->supplementPoints($customerId, $params);
        }

        return FALSE;
    }

    /**
     * Withdraw Points
     *
     * @param Varien_Object
     */
    public function withdrawPoints($object)
    {
        // $object->getCustomerId()
        // $object->getPoints()

        $pointsLog = Mage::getModel('referralreward/points_log');
        $pointsLog->withdrawPoints($object->getCustomerId(), $object->getPoints());
    }

    /**
     * Get Log Item Title
     *
     * @return string
     */
    public function getLogTitle()
    {
        return Mage::helper('referralreward')->__('Admin');
    }

    /**
     * Get Log Item Description
     *
     * @param int Current Item Object Id
     * @return string
     */
    public function getLogDescription()
    {
        return '';
    }
}
