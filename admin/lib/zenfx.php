<?php
/* 
 * Company: DNAVAL
 * Author: Daniel Naval
 * Department: PHP Web Developer
 * Date: 20210922
 * Utility functions
 */

 class zenfx {

    public function navActive($page) {
       
        switch($page) {
            case 'home':  $navact = array('nav1'=>'dn-active','nav2'=>'','nav3'=>'','nav4'=>'','nav5'=>''); break;
            case 'content':  $navact = array('nav1'=>'','nav2'=>'dn-active','nav3'=>'','nav4'=>'','nav5'=>''); break;
            case 'skills':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'dn-active','nav4'=>'','nav5'=>''); break;
            case 'addskills':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'dn-active','nav4'=>'','nav5'=>''); break;
            case 'projects':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'dn-active','nav5'=>''); break;
            case 'addproject':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'dn-active','nav5'=>''); break;
            case 'projecttype':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'dn-active','nav5'=>''); break;
            case 'addtype':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'dn-active','nav5'=>''); break;
            case 'users':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'','nav5'=>'dn-active'); break;
            case 'adduser':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'','nav5'=>'dn-active'); break;
            case 'resetuserpwd':  $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'','nav5'=>'dn-active'); break;
            default: $navact = array('nav1'=>'','nav2'=>'','nav3'=>'','nav4'=>'','nav5'=>''); break;
        }
        return $navact;
    }


 }