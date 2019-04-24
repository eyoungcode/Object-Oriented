<?php

namespace Deepdiveeyoung21\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/classes/autoload.php");

class author {
	/**
	 * id for the author, this is the primary key
	 *  @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * activationToken the author
	 * @var string $activationToken
	 **/
	private $activationToken;
	/**
	 * email of the author
	 * @var string $email
	 **/
	private $email;
	/**
	 * hash of the author
	 * @var string $hash
	 **/
	private $hash;
	/**
	 * userName of the author
	 * @var string $userName
	 **/
	private $userName;


public function getAuthorId () {
	return ($this->authorId);
}
		public function getActivationToken() {
	return ($this->activationToken);
}
			public function getEmail() {
	return ($this->email);
}
				public function getHash() {
	return ($this->hash);
}
					public function getUserName(){
						return ($this->userName);
}}
/**
 * constructor for author
 *
 * @param string|Uuid $newAuthorId id of the author
 * @param string $newActivationToken activation token to help setup the account
 * @param string $newEmail string containing email
 * @param string $newHash string containing password hash
 * @param string $newUserName string containing user name information
 **/



