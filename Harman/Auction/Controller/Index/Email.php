<?php

namespace Harman\Auction\Controller\Index;

use Magento\Framework\App\RequestInterface;

class Email extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $_request;
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context
        , \Magento\Framework\App\Request\Http $request
        , \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
        , \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $post['name'] = 'manish sharma';
        $post['email'] = 'manish.1986200821@gmail.com';
        $post['test'] = 'manish.1986200821@gmail.com';

        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($post);
        
        $sender = [
            'name' => trim($post['name']),
            'email' => trim($post['email']),
            ];


        $store = $this->_storeManager->getStore()->getId();
        $transport = $this->_transportBuilder->setTemplateIdentifier('send_auction_email_template')
            ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
            ->setTemplateVars(
                [
                    'store' => $this->_storeManager->getStore(),
                ]
            )
            ->setFrom('general')
            // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
            ->addTo('manish@email.com', 'Customer Name')
            ->getTransport();
        try{
            $transport->sendMessage();
        }catch(Exception $e){
            echo $e->getMessage(); exit;
        }
        return $this;
    }
}