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
class Tb_Superslider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid{
	
	public function __construct()
    {
        parent::__construct();
        $this->setId('supersliderGrid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }
	
	/*protected function _prepareCollection()
    {
        $collection = Mage::getModel('superslider/superslider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }*/
	protected function _prepareCollection() {
		$collection = Mage::getModel("superslider/superslider")->getCollection();
		$this->setCollection($collection);
		parent::_prepareCollection();
		
		foreach($collection as $link){
			if($link->getStoreId() && $link->getStoreId() != 0 ){
			$link->setStoreId(explode(',',$link->getStoreId()));
			}
			else{
			$link->setStoreId(array('0'));
			}
		}
		
		return $this;
	}
	
	protected function _filterStoreCondition($collection, $column){
	    if (!$value = $column->getFilter()->getValue()) {
	        return;
	    }
	    $this->getCollection()->addStoreFilter($value);
	}
	
	protected function _prepareColumns()
    {
        $this->addColumn('slide_id', array(
          'header'    => Mage::helper('superslider')->__('ID'),
          'align'     =>'right',
          'width'     => '10px',
          'index'     => 'slide_id',
        ));
		
		$this->addColumn('title', array(
          'header'    => Mage::helper('superslider')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
          'width'     => '150px',
        ));
 
          
        $this->addColumn('url', array(
            'header'    => Mage::helper('superslider')->__('Url'),
            'width'     => '150px',
            'index'     => 'url',
        ));
		
		if (!Mage::app()->isSingleStoreMode()) {
		    $this->addColumn('store_id', array(
		        'header'        => Mage::helper('superslider')->__('Store View'),
		        'index'         => 'store_id',
		        'type'          => 'store',
		        'store_all'     => true,
		        'store_view'    => true,
		        'sortable'      => true,
		        'filter_condition_callback' => array($this,
		            '_filterStoreCondition'),
		    ));
		}
		
		$this->addColumn('image', array(
          'header'    => Mage::helper('superslider')->__('Image'),
          'align'     =>'left',
          'type'      => 'image',
          'index'     => 'image',
          'renderer' => 'superslider/adminhtml_slider_render_image',
          'filter'    => false,
		  'width'     => '100px',
          'sortable'  => false,
));
		
		$this->addColumn('status', array(
            'header'    => Mage::helper('superslider')->__('Status'),
            'align'     => 'left',
            'width'     => '70',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => Mage::helper('superslider')->__('Enabled'),
                0 => Mage::helper('superslider')->__('Disabled')
            ),
        ));
		
		$this->addColumn('action',
            array(
                'header'    =>  Mage::helper('superslider')->__('Action'),
                'width'     => '60',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('superslider')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    ),
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		return parent::_prepareColumns();
	}
	public function getRowUrl($row){
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
	
	 
	 protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('superslider');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('superslider')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('superslider')->__('Are you sure?')
        ));

        $statuses = array(
              1 => Mage::helper('superslider')->__('Enabled'),
              0 => Mage::helper('superslider')->__('Disabled')
        );
        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('superslider')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('superslider')->__('Status'),
                         'values' => array(
                                            1 => 'Enabled',
                                            0 => 'Disabled',
                                        )
                     )
             )
        ));
        return $this;
    }
		
}
?>