<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Cart extends CI_Cart {

  function __construct(){
    parent::__construct();
  }

  function _update($items = array()){

    // Without these array indexes there is nothing we can do
    if ( ! isset($items['qty']) OR ! isset($items['rowid']) OR ! isset($this->_cart_contents[$items['rowid']])){
      return FALSE;
    }

    // create new rowid
    if (isset($items['options']) AND count($items['options']) > 0){
      $rowid = md5($items['id'].implode('', $items['options']));
    }else{
      if(isset($items['id'])){
        $rowid = md5($items['id']);
      }
    }

    if(isset($rowid)){

      // save current cart item
      $current_cart_item = $this->_cart_contents[$items['rowid']];

      // save current order
      $current_order = $this->_preserve_cart_order($this->_cart_contents);

      // remove current cart with old rowid
      unset($this->_cart_contents[$items['rowid']]);

      // create new array with new rowid
      $this->_cart_contents[$rowid] = $current_cart_item;

      // return order key with old rowid
      $order_key = array_search($items['rowid'], $current_order);

      // replace old rowid with new rowid in order array
      $current_order[$order_key] = $rowid;

      // reorder cart
      $this->_cart_contents = $this->_restore_cart_order($this->_cart_contents, $current_order);
    }else{
      $rowid = $items['rowid'];
    }

    if(isset($items['price'])){
      // Prep the price.  Remove anything that isn't a number or decimal point.
      $items['price'] = trim(preg_replace('/([^0-9\.])/i', '', $items['price']));
      // Trim any leading zeros
      $items['price'] = trim(preg_replace('/(^[0]+)/i', '', $items['price']));

      // Is the price a valid number?
      if ( ! is_numeric($items['price'])){
        log_message('error', 'An invalid price was submitted for product ID: '.$items['id']);
        return FALSE;
      }
      else{
        $this->_cart_contents[$rowid]['price'] = $items['price'];
      }
    }
    // Prep the quantity
    $items['qty'] = preg_replace('/([^0-9])/i', '', $items['qty']);

    // Is the quantity a number?
    if ( ! is_numeric($items['qty'])){
      return FALSE;
    }

    // Is the quantity zero?  If so we will remove the item from the cart.
    // If the quantity is greater than zero we are updating
    if ($items['qty'] == 0){
      unset($this->_cart_contents[$rowid]);
    }else{
      $this->_cart_contents[$rowid]['qty'] = $items['qty'];
    }

    if(isset($items['options']) AND count($items['options']) > 0){
      $this->_cart_contents[$rowid]['options'] = $items['options'];
    }

    // reset rowid
    $this->_cart_contents[$rowid]['rowid'] = $rowid;

    return TRUE;
  }

  // end of _update function

  function _preserve_cart_order($cart){
    $cart_order = array();
    foreach($cart as $key=>$index){
      $cart_order[] = $key;
    }
    return $cart_order;
  }

  function _restore_cart_order($cart,$cart_order){
    $ordered = array();
    foreach($cart_order as $key){
      if(array_key_exists($key,$cart)){
        $ordered[$key] = $cart[$key];
        unset($cart[$key]);
      }
    }
    return $ordered + $cart;
  }


} // end of class
