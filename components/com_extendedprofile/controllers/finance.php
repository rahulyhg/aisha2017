<?php
defined('_JEXEC') or die;
require_once JPATH_COMPONENT.'/controller.php';
class ExtendedProfileControllerFinance extends ExtendedProfileController
{
    public function saveDetails()
    {
        if(isset($_POST['bank_submit']))
        {
            $acc_name               = $_POST['acc_bank'];       
            $acc_number             = $_POST['acc_number'];
            $acc_bank_name          = $_POST['acc_bank_name'];
            $acc_bank_addr          = $_POST['acc_bank_addr'];
            $acc_iban               = $_POST['acc_iban'];
            $acc_swift              = $_POST['acc_swift'];
            $acc_ifsc               = $_POST['acc_ifsc'];
            $acc_paypal             = $_POST['acc_paypal'];
            
            $details                = array( 'acc_name'=>$acc_name, 'acc_number'=>$acc_number,
                                            'acc_bank_name'=>$acc_bank_name, 'acc_bank_addr'=>$acc_bank_addr,
                                            'acc_iban'=>$acc_iban,'acc_swift'=>$acc_swift,'acc_ifsc'=>$acc_ifsc,
                                            'acc_paypal'=>$acc_paypal
                                            );
            $model          = $this->getModel('finance');  // Add the array to model
            $data           = $model->saveDetails($details);
        }
    }
    function paidMember()
    {
        if(isset($_POST['pay_submit']))
        {
            $choice         = $_POST['pay_choice'];
            $currency       = $_POST['pay_currency'];
            $country        = $_POST['pay_country'];
            $amount         = $_POST['pay_amount'];
            $details                = array('pay_choice'=>$choice,'pay_currency'=>$currency,
                                            'pay_amount'=> $amount,'pay_country'=>$country);
            $model          = $this->getModel('finance');  // Add the array to model
            $model->getPaidMembership($details);
        }
    }
    function orderStatus()
    {
        echo "calls";exit;
    }
}