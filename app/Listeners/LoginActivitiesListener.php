<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\LoginActivities; 

class LoginActivitiesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        LoginActivities::insert([
            'associate_id'  =>  $event->user->associate_id,
            'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent'),
            'browser'       =>  $this->getBrowser()->browser." (".$this->getBrowser()->version.")",
            'platform'      =>  $this->getBrowser()->platform,
            'ip_address'    =>  request()->input('ip_address')?request()->input('ip_address'):$this->getBrowser()->ip_address,
            'mac_address'   =>  $this->getBrowser()->mac_address, 
            'login_at'      =>  date("Y-m-d H:i:s"), 
        ]);
    }


    public function getBrowser() 
    { 
        $u_agent    = $_SERVER['HTTP_USER_AGENT']; 
        $bname      = 'Unknown';
        $os         = 'windows';
        $platform   = 'Unknown';
        $version    = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
            $os = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
            $os = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
            $os = 'windows';

            if (preg_match('/NT 6.2/i', $u_agent)) { $platform .= ' 8'; }
                elseif (preg_match('/NT 10.0/i', $u_agent)) { $platform .= ' 10'; }
                elseif (preg_match('/NT 6.3/i', $u_agent)) { $platform .= ' 8.1'; }
                elseif (preg_match('/NT 6.1/i', $u_agent)) { $platform .= ' 7'; }
                elseif (preg_match('/NT 6.0/i', $u_agent)) { $platform .= ' Vista'; }
                elseif (preg_match('/NT 5.1/i', $u_agent)) { $platform .= ' XP'; }
                elseif (preg_match('/NT 5.0/i', $u_agent)) { $platform .= ' 2000'; }
            if (preg_match('/WOW64/i', $u_agent) || preg_match('/x64/i', $u_agent)) { $platform .= ' (x64)'; 
            }

        }
        
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 
        
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }
        
        // check if we have a number
        if ($version==null || $version=="") {$version="?";} 
        
        return (object)array(
            'userAgent' => $u_agent,
            'browser'   => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'   => $pattern,
            'ip_address'  => $this->GetIP(),
            'mac_address' => $this->GetMAC($os)
        );
    } 

    public function GetMAC($os = null)
    {
        if ($os == 'linux')
        {
            $macCommandString = "arp | awk 'BEGIN{ i=1; } { i++; if(i==3) print $3 }'"; 
            return exec($macCommandString);
        }
        else
        {
            ob_start();
            system('getmac');
            $content = ob_get_contents();
            ob_clean();
            return substr($content, strpos($content,'\\')-20, 17);
        } 
    }
 
    public function GetIP()
    {
        // ip address
        ob_start();
        system('ipconfig');
        $content = ob_get_contents();
        ob_clean();
        $ip_address = "";
        $content = substr($content, strpos($content, 'IPv4 Address')+36, 16);


        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $content, $ip_match)) 
        {
           $ip_address = $ip_match[0];
        }
        else
        {
            if (getenv('HTTP_CLIENT_IP'))
                $ip_address = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ip_address = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                 $ip_address = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ip_address = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
                $ip_address = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ip_address = getenv('REMOTE_ADDR');
            else
                $ip_address = 'UNKNOWN'; 
        }
        return $ip_address;
    }
 
}
