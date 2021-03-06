<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Collpur
 * @version    1.0.6
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Collpur_Model_Mysql4_Rewrite extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('collpur/rewrite', 'id');
    }

    public function loadByKey($key, $storeId) {

        $select = $this->_getReadAdapter()->select()->from($this->getTable('collpur/rewrite'), array('deal_id'))
                        ->where('identifier  = ?', $key)
                        ->where('store_id = ?', $storeId);
        
        if ($dealId = $this->_getReadAdapter()->fetchOne($select)) {
            return $dealId;
        }

        return false;
    }


     public function loadByDealId($dealId, $storeId) {

        $select = $this->_getReadAdapter()->select()->from($this->getTable('collpur/rewrite'), array('identifier'))
                        ->where('deal_id  = ?', $dealId)
                        ->where('store_id = ?', $storeId);

        if ($identifier = $this->_getReadAdapter()->fetchOne($select)) {
            return $identifier;
        }

        return false;
    }

    public function isUnique($storeId,$identifier) {

         $select = $this->_getReadAdapter()->select()->from($this->getMainTable(), array('*'))
                        ->where('store_id  = ?', $storeId)
                        ->where('identifier = ?', $identifier);

         if($this->_getReadAdapter()->fetchRow($select)) {             
             return false;
         }
         
         return true;
    }

}