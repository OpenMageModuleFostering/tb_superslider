<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
DROP TABLE IF EXISTS `superslider`;
create table superslider(
		`slide_id`int(11) unsigned NOT NULL auto_increment,
		`title` varchar(255) NOT NULL default '',
		`status` smallint(6) NOT NULL default '0',
		`store_id` varchar(255) NOT NULL,
		`url` varchar(255) NULL,
		`image`	varchar(255) NULL,
		`content` text NULL,
		primary key(slide_id));
	
SQLTEXT;

$installer->run($sql);
$installer->endSetup();