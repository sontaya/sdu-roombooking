<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();

	}

  public function login($identity, $password)
  {

    if(empty($identity) || empty($password))
    {
      //-- Set error msg
      return false;
    }

    //-- LDAP Auth
    $auth_info = ldap_bind_authenticate($identity, $password);


    if($auth_info != null)
    {
      $auth['uid'] = $auth_info["uid"]["0"];
      // $auth['mail'] = $auth_info["mail"]["0"];
      // $auth['title'] = $auth_info["title"]["0"];
      $auth['hrcode'] = $auth_info["hrcode"]["0"];
      $auth['citizencode'] = $auth_info["idcardno"]["0"];
      $auth['name'] = $auth_info["thcn"]["0"];
      $auth['surname'] = $auth_info["thsn"]["0"];
      $auth['displayname'] = $auth_info["displayname"]["0"];

      return $auth;

    }else{
      $auth['uid'] = "";
      $auth['hrcode'] = "";
      $auth['citizencode'] = "";
      $auth['name'] = "";
      $auth['surname'] = "";
      $auth['displayname'] = "";

      return $auth;
    }

  }




}
