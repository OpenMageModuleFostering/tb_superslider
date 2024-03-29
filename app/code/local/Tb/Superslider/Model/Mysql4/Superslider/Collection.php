<?php
/**
 * Tb_Superslider
 * 
 /****************************************************************************
 *                      MAGENTO EDITION USAGE NOTICE                         *
 ****************************************************************************/
 /* This package designed for Magento Community edition. Author does not provide extension support in case of incorrect edition usage.
 /****************************************************************************
 * @category 	TB
 * @package 	Tb_Superslider
 * @copyright 	Copyright (c) 2014
 * @license 	http://opensource.org/licenses/OSL-3.0
 */
/**
 */
?>
<?php
class Tb_Superslider_Model_Mysql4_Superslider_Collection 
	  extends Mage_Core_Model_Mysql4_Collection_Abstract{
	  	
		
		public function _construct(){
        parent::_construct();
        $this->_init('superslider/superslider');
   		 }
		 
		 public function addStoreFilter($store, $withAdmin = true){
		    if ($store instanceof Mage_Core_Model_Store) {
		        $store = array($store->getId());
		    }
		    if (!is_array($store)) {
		        $store = array($store);
		    }
		    $this->addFilter('store_id', array('in' => $store));
		    return $this;
		}
		
		
	  }
?>