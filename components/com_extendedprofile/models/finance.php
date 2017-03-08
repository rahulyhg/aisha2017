<?php
defined('_JEXEC') or die;  // No direct Access
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');
class ExtendedProfileModelFinance extends JModelItem
{
    public function getData()
    {

        $user = JFactory::getUser();
        $id   = $user->id;$name = $user->name;       
        // get the data
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $query          ->select($db->quoteName(array('membership')))
                        ->from($db->quoteName('#__user_astrologer'))
                        ->where($db->quoteName('UserId').' = '.$db->quote($id));
        $db             ->setQuery($query);
        $data           = $db->loadAssoc();
        if($data['membership'] == 'Free'|| $data['membership']=='Unpaid')
        {
           $result     = $this->getLocationDetails();
        }
       
        return $result;
    }
    function getLocationDetails()
    {
        $u_id           = 750;
        $service        = 'expert_fees';
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        try
        {
            include_once "/home/astroxou/php/Net/GeoIP.php";
            $geoip                  = Net_GeoIP::getInstance("/home/astroxou/php/Net/GeoLiteCity.dat");
            //$ip    = '157.55.39.123';  // ip address
            $ip                     = $_SERVER['REMOTE_ADDR'];        // uncomment this ip on server
            $location               = $geoip->lookupLocation($ip);
            $info                   = $location->countryCode;
            $country                = $location->countryName;
            
            if($info == "US")
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('US'));
                
            }
            else if($info == "IN"||$info== 'LK'||$info=='NP'||$info=='TH'||$info=='MY'||$info=='MV')
            {
                 $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('IN'));
            }
            else if($info=='UK')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('UK'));
            }
            else if($info=='NZ')
            {
                 $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('NZ'));
            }
            else if($info=='CA')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('CA'));
            }
            else if($info=='SG')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('SG'));
            }
            else if($info=='AU')
            {
                 $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('AU'));
            }
            else if($info=='FR'||$info=='DE'||$info=='IE'||$info=='NL'||$info=='CR'||$info=='BE'
                    ||$info=='GR'||$info=='IT'||$info=='PT'||$info=='ES'||$info=='MT'||$info=='LV'||$info=='TR')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('EU'));
            }
            else if($info =='RU')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('RU'));
            }
             else
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('ROW'));
            }
             $db             ->setQuery($query);
             $country           = array("country_full"=>$country);
             $result           = $db->loadAssoc();
             $details           = array_merge($result,$country);
        }
        catch(Exception $e)
        {
            $details                =  array('error'=> 'Data not showing');
        }
        
        return $details;
    }
    function saveDetails($details)
    {
        //print_r($details);exit;
        $acc_name           = $details['acc_name'];$acc_number              = $details['acc_number'];
        $acc_bank_name      = $details['acc_bank_name'];$acc_bank_addr      = $details['acc_bank_addr'];
        $acc_iban           = $details['acc_iban'];$acc_swift               = $details['acc_swift'];
        $acc_ifsc           = $details['acc_ifsc'];$acc_paypal              = $details['acc_paypal'];
        $user           = JFactory::getUser();
        $id             = $user->id;

        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        
        $fields         = array($db->quoteName('acc_holder_name').' = '.$db->quote($acc_name),
                                $db->quoteName('acc_number').' = '.$db->quote($acc_number),
                                $db->quoteName('acc_bank_name').' = '.$db->quote($acc_bank_name),
                                $db->quoteName('acc_bank_addr').' = '.$db->quote($acc_bank_addr),
                                $db->quoteName('acc_iban').' = '.$db->quote($acc_iban),
                                $db->quoteName('acc_swift_code').' = '.$db->quote($acc_swift),
                                $db->quoteName('acc_iban').' = '.$db->quote($acc_iban),
                                $db->quoteName('acc_ifsc').' = '.$db->quote($acc_ifsc),
                                $db->quoteName('acc_paypalid').' = '.$db->quote($acc_paypal));
        $conditions     = array($db->quoteName('UserId').' = '.$db->quote($id));
        
        
        // Set the query using our newly populated query object and execute it
        $query->update($db->quoteName('#__user_finance'))->set($fields)->where($conditions);
        $db->setQuery($query);
 
        $result = $db->execute();

        if($result)
        {
            $app = JFactory::getApplication(); 
            $link = JURI::base().'dashboard?data=success';
            $msg = 'Successfully added Financial Details'; 
            $app->redirect($link, $msg, $msgType='message');
        }
        else
        {
            $app = JFactory::getApplication(); 
            $link = JURI::base().'dashboard?data=fail';
            $msg = 'Unable to add financial details'; 
            $app->redirect($link, $msg, $msgType='message');
        }
    }
    function getPaidMembership($details)
    {
        $amount     = $details['pay_amount'];
        $choice     = $details['pay_choice'];
        $currency   = $details['pay_currency'];
        $location   = $details['pay_country'];
        $token      = uniqid('token_');
        // get user details
        $app        = JFactory::getApplication(); 
        $user       = JFactory::getUser();
        $uid        = $user->id;  
        $email      = $user->email;
               
        // get the data
        $db             = JFactory::getDbo();
        $query          = $db->getQuery(true);
        $query1          = $db->getQuery(true);
        $query          ->select(array('COUNT(*)'))
                        ->from($db->quoteName('#__user_finance'))
                        ->where($db->quoteName('UserId').' = '.$db->quote($uid));
        $db             ->setQuery($query);
        $count          = $db->loadResult();
        if($count  >  0)
        {
            //echo $uid;exit;
            $query      ->clear();
            $object         = new stdClass();
            $object->UserId     = $uid;
            $object->amount     = $amount;
            $object->currency   = $currency;
            $object->location   = $location;
            $object->pay_choice = $choice;
            $result             = $db->updateObject('#__user_finance',$object,'UserId'); 
       }
        else
        {
            $query          ->clear();
            $columns        = array('UserId','amount','currency','location','token','paid','pay_choice');
            $values         = array($uid,$amount,$db->quote($currency),
                                    $db->quote($location),$db->quote($token),$db->quote('No'),$db->quote($choice));
            $query
                            ->insert($db->quoteName('#__user_finance'))
                            ->columns($db->quoteName($columns))
                            ->values(implode(',', $values));
            $db->setQuery($query);
            $result             = $db->execute();
        }

        if($result)
        {
            $query           ->clear();
            $query          ->select(array('amount','currency','location','paid','token', 'pay_choice'))
                            ->from($db->quoteName('#__user_finance'))
                            ->where($db->quoteName('UserId').' = '.$db->quote($uid));
            $db->setQuery($query);
            $data           = $db->loadObject();
            if($data->pay_choice=="phonepe"||$data->pay_choice=="bhim"||$data->pay_choice=="cheque"||$data->pay_choice="direct")
            {
                $config     = JFactory::getConfig();
                $sender     = array(
                                $config->get('mailfrom'),
                                $config->get('fromname')
                                    );
                $mailer     ->setSender($sender);
                $recepient  = $email;
                $mailer     ->addRecipient($recepient);
                $mailer     ->addBcc('kopnite@gmail.com');
                $body       = $this->getBody($data);
                $mailer->isHtml(true);
                $mailer->Encoding = 'base64';
                $mailer->setBody($body);
                if($data->pay_choice=="phonepe")
                {
                    $mailer->addAttachment(JPath.'images/phonepay_pay.png');
                }
                else if($data->pay_choice="bhim")
                {
                    $mailer->addAttachment(Jpath.'images/bhim_pay.png');
                }
                else if($data->pay_choice=="direct")
                {
                    $mailer->addAttachment(Jpath.'images/bank_details.pdf');
                }
                $send = $mailer->Send();
                $link       = JUri::base().'dashboard';
                if ( $send !== true ) {
                    $msg    = 'Error sending email: Try again and if problem continues contact admin@astroisha.com.';
                    $msgType = "error";
                    $app->redirect($link, $msg,$msgType);
                } else {
                    $msg    =  'Please check your email to see payment details.';
                    $msgType    = "success";
                    $app->redirect($link, $msg,$msgType);
                }
                
            }
        }
    }
    function getBody($data)
    {
        $user       = JFactory::getUser();
        if($data->pay_choice == "bhim"||$choice=="phonepe")
        {
            $pay_mode   = ucfirst($choice)." App";
        }
        else if($data->pay_choice=="direct")
        {
            $pay_mode   = ucfirst($choice)." Tranfer";
        }
        else
        {
            $pay_mode   = ucfirst($choice);
        }
?>
        Dear <?php $user->name; ?>,
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have applied for Paid Membership with AstroIsha(https://www.astroisha.com). 
        Once your payment is completed and authorized you would be able to avail benefits of Paid Memberships. You have chosen 
        payment by using <?php echo $pay_mode; ?>. Kindly pay the amount: <?php echo $data->amount." ".$data->currency; ?> and notify 
        to admin@astroisha.com once payment is completed. <strong>Kindly keep some reference of your payment to avoid issues later.</strong></p><br/> 
        <p><strong>Below Are The Payment Details:</strong></p>
<?php
        if($data->pay_choice == "bhim")
        {
?>
           <p><strong>Pay To: </strong>astroisha@upi or 9727841461</p>
           <p>Alternatively you can open Bhim App and scan the attached image to make payment.</p>
<?php
        }
        else if($data->pay_choice == "phonepe")
        {
?>
           <p><strong>Pay To: </strong>astroisha@ybl or 9727841461</p>
           <p>Alternatively you can open PhonePe App and scan the attached image to make payment.</p>
<?php
        }
        else if($data->pay_choice == "direct")
        {
?>
           <p><strong>Payable To: </strong>Astro Isha</p>
           <p><strong>Account Number: </strong>915020051554614</p>
           <p><strong>IFSC Code: </strong>UTIB0000080</p>
<?php
        }
        else if($data->pay_choice == $cheque)
        {
?>
           <p>Write a Cheque to <strong>Astro Isha</strong> and submit it to your near Axis Bank. Keep Cheque Number as reference.</p>
<?php
        }

    }
}
