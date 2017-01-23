<?php

defined('_JEXEC') or die;  // No direct Access
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
class AstrologinModelAstroSearch extends JModelItem
{
    var $_total         = null;
    var $_data          = null;
    var $_pagination    = null;
    function __construct()
     {
         parent::__construct();
         // Set the pagination request variables
         $this->setState('limit', JRequest::getVar('limit', 5, '', 'int'));
         $this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
         echo JRequest::getVar('limitstart');
     }
    public function getAstrologer()
    {
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
      
        $query              ->select($db->quoteName(array('b.number','b.membership','a.username',
                                    'a.name', 'b.city','b.state','b.country','b.info')))
                            ->from($db->quoteName('#__users','a'))
                              ->join('INNER', $db->quoteName('#__user_astrologer', 'b') . ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('b.UserId') . ')')
                            ->where($db->quoteName('b.approval_status').'='.$db->quote('approved').' AND '.
                                    $db->quoteName('b.profile_status').' = '.$db->quote('visible'));    
        $db                  ->setQuery($query);
       
        $this->_data         = $db->loadObjectList();
        $this->_total    = count($details);
        
       return $this->_data;
       
    }
    public function getPagination()
    {
         jimport('joomla.html.pagination');
         $this->_pagination = new JPagination($this->getAstrologer(), $this->getState('limitstart'), $this->getState('limit') );
         return $this->_pagination;
    }
    function getData() 
    { 
        $this->getAstrologer() ; 

        $limitstart = $this->getState('limitstart');
        $limit = $this->getState('limit');

        return array_slice( $this->getAstrologer(), $limitstart, $limit ); 
    }
    function getTotal() 
    { 
        return $this->_total; 
    } 
    public function getDetails($data)
    {
        //print_r($data);exit;
        $url            = array("url"=> $data['url']);
        
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $query              ->select($db->quoteName(array('b.number','b.membership','a.username','a.email',
                                    'a.name', 'a.registerDate', 'a.lastVisitDate','b.addr_1',
                                    'b.addr_2','b.city','b.state','b.country','b.postcode', 
                                    'b.phone','b.mobile','b.whatsapp','b.info')))
                            ->from($db->quoteName('#__users','a'))
                              ->join('INNER', $db->quoteName('#__user_astrologer', 'b') . ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('b.UserId') . ')')
                            ->where($db->quoteName('b.approval_status').'='.$db->quote('approved').' AND '.
                                    $db->quoteName('b.profile_status').' = '.$db->quote('visible'));
        $db                  ->setQuery($query);
        $result         = $db->loadAssoc();
        $result         = array_merge($result, $url);
        return $result;
        
    }
    public function getUser($user)
    {
        $jinput             = JFactory::getApplication()->input;
        $user               = $jinput->get('user', 'default_value', 'string');
        if($user  == 'default_value')
        {
            return;
        }
        else
        {
            $db             = JFactory::getDbo();  // Get db connection
            $query          = $db->getQuery(true);

            $query              ->select($db->quoteName(array('b.number','b.membership','a.id','a.username','a.email',
                                        'a.name', 'a.registerDate', 'a.lastVisitDate','b.addr_1',
                                        'b.addr_2','b.city','b.state','b.country','b.postcode', 
                                        'b.phone','b.mobile','b.whatsapp','b.info')))
                                ->from($db->quoteName('#__users','a'))
                                  ->join('INNER', $db->quoteName('#__user_astrologer', 'b') . ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('b.UserId') . ')')
                                ->where($db->quoteName('b.approval_status').'='.$db->quote('approved').' AND '.
                                        $db->quoteName('b.profile_status').' = '.$db->quote('visible').' AND '.
                                        $db->quoteName('a.username').' = '.$db->quote($user));
            $db                  ->setQuery($query);
            //$query          ->clear();
            $result         = $db->loadObject();
            //$result         = array_push($result,$back_url);
            return $result;
        }
    }
}
