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
class Tb_Superslider_Helper_Data extends Mage_Core_Helper_Abstract{
	
	public function isEnabled()
    {
        return Mage::getStoreConfig('slideset/general_settings/enable');
    }
	
	public function isIncludeJqueryLib()
    {
        return Mage::getStoreConfig('slideset/general_settings/jquery_lib');
    }
	
	public function containerHeight()
    {
        return Mage::getStoreConfig('slideset/general_settings/height');
    }
	
	public function SlideTime()
    {
		$time = Mage::getStoreConfig('slideset/general_settings/time');
		if(empty($time)){
			$time = 5000;
		}
        return $time;
    }
	
	public function transitionTime()
    {
		$trans = Mage::getStoreConfig('slideset/general_settings/trans');
		if(empty($trans)){
			$trans = 2000;
		}
        return $trans;
    }
	
	public function  pagination()
    {
        return Mage::getStoreConfig('slideset/general_settings/pagination');
    }
	
	public function  pauseOnHover()
    {
        return Mage::getStoreConfig('slideset/general_settings/pause');
    }
	
	public function  navigation()
    {
        return Mage::getStoreConfig('slideset/general_settings/navigation');
    }
	
	}
?>