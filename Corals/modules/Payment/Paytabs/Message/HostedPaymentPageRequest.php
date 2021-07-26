<?php

namespace Corals\Modules\Payment\Paytabs\Message;
use Illuminate\Support\Facades\URL;

class HostedPaymentPageRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['cart_id'] = $this->getCartId();
        $data['cart_description'] =  $this->getCartDescription();
       
        $data['cart_currency'] =  $this->getCartCurrency();
        $data['cart_amount'] = $this->getCartAmount();


        $data['capture'] = 'false';
        $data['profile_id'] = 69420;
        $data['tran_type'] =  'sale';
        $data['tran_class'] = 'ecom';
        $data['return'] = URL::to('/result');
       // $data['callback'] = 
       
        return $data;
    }


 /*   public function setProfile_id($value)
    {
        $this->setParameter('profile_id', $value);
    }


    public function getProfile_id()
    {
        return $this->getParameter('profile_id');
    }


    public function setTran_type($value)
    {
        $this->setParameter('tran_type', $value);
    }


    public function getTran_type()
    {
        return $this->getParameter('tran_type');
    }



    public function setTran_class($value)
    {
        $this->setParameter('tran_class', $value);
    }


    public function getTran_class()
    {
        return $this->getParameter('tran_class');
    }

  */

    public function setCartId($value)
    {
        $this->setParameter('cart_id', $value);
    }


    public function getCartId()
    {
        return $this->getParameter('cart_id');
    }
 


    public function setCartDescription($value)
    {
        $this->setParameter('cart_description', $value);
    }


    public function getCartDescription()
    {
        return $this->getParameter('cart_description');
    }
 

    public function setCartCurrency($value)
    {
        $this->setParameter('cart_currency', $value);
    }


    public function getCartCurrency()
    {
        return $this->getParameter('cart_currency');
    }


    public function setCartAmount($value)
    {
        $this->setParameter('cart_amount', $value);
    }


    public function getCartAmount()
    {
        return $this->getParameter('cart_amount');
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }
  
/*
    public function setReturn($value)
    {
        $this->setParameter('return', $value);
    }


    public function getReturn()
    {
        return $this->getParameter('return');
    }

    public function setCallback($value)
    {
        $this->setParameter('callback', $value);
    }


    public function getCallback()
    {
        return $this->getParameter('callback');
    }
    */
}