<?php

namespace Harman\Auction\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){
          /*auction product table*/

		$installer->run('CREATE TABLE `harman_auction_product` (
  `auction_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `starting_price` decimal(15,4) NOT NULL DEFAULT \'0.0000\',
  `reserve_price` decimal(15,4) NOT NULL DEFAULT \'0.0000\',
  `start_auction_time` datetime NOT NULL,
  `end_auction_time` datetime NOT NULL,
  `min_qty` int(11) NOT NULL,
  `max_qty` int(11) NOT NULL,
  `increment_enable` tinyint(2) NOT NULL,
  `increment_step` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1');
$installer->run('ALTER TABLE `harman_auction_product`
  ADD PRIMARY KEY (`auction_product_id`)');
$installer->run('ALTER TABLE `harman_auction_product`
  MODIFY `auction_product_id` int(11) NOT NULL AUTO_INCREMENT');

/*bidder table */
$installer->run('CREATE TABLE `harman_auction_bidder` (
  `auction_bidder_id` int(11) NOT NULL,
  `bidder_email` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `auction_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bidder_price` decimal(15,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `harman_auction_bidder`
  ADD PRIMARY KEY (`auction_bidder_id`);
  ALTER TABLE `harman_auction_bidder`
  MODIFY `auction_bidder_id` int(11) NOT NULL AUTO_INCREMENT;');
		//demo 
//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//$scopeConfig = $objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
//demo 

		}

        $installer->endSetup();

    }
}