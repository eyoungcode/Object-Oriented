<?php

namespace eyoung21\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/classes/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *creating a class for table 'Author'
 */
class Author {
	/**
	 *id and primary key for table.
	 * mentioning a function to validate uuid's, but we dont have the actual uuid yet.
	 */
	use ValidateUuid;
	private $authorId;
	/**
	 * creating private variables for authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername all in the same fashion. create them within a private class for distribution per our discretion later on.
	 */
	private $authorAvatarUrl;
	private $authorActivationToken;
	private $authorEmail;
	private $authorHash;
	private $authorUserName;
	/**
	 * constructor for this Author
	 *
	 * @param string|Uuid $newAuthorId id of this Author or null if a new Author
	 * @param string newAuthorAvatarUrl for the new Author
	 * @param string|Uuid newAuthorActivationToken id for this Author or null if token already exist
	 * @param string newAuthorEmail for new Author email or null of email already exist
	 * @param string newAuthorHash has for this Author or null if not new Author
	 * @param string newAuthorUserName of this Author or null if user name aleady exist
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newAuthorId, string $newAuthorAvatarUrl, string $newAuthorActivationToken,
										 string $newAuthorEmail, string $newAuthorHash, string $newAuthorUserName) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUserName($newAuthorUserName);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	/**
	 * mutator method for authorId
	 *
	 * @param Uuid| string $newAuthorId
	 * @throws \RangeException if $newAuthorId value of new authorId
	 * @throws \TypeError if the authorId is not positive
	 * @thros \TypeError if the authorId is not
	 */
	public function setAuthorId($newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store authorId
		$this->authorId = $uuid;
	}
	/**
	 * accessor method for authorAvatarUrl
	 *
	 * @return string value of authorAvatarUrl
	 */
	public function getAuthorAvatarUrl(): ?string {
		return ($this->authorAvatarUrl);
	}
	/**
	 * mutator method for authorAvatarUrl
	 *
	 * @param string $newAuthorAvatarUrl
	 * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
	 * @throws \RangeException if the Url is not < 255 characters
	 * @throws \TypeError if the Url is not a string
	 */
	public function setAuthorAvatarUrl($newAuthorAvatarUrl) : void {


		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING);
		if(empty($newAuthorAvatarUrl) === true) {
			throw(new \RangeException("no avatar on file"));
		}

		if(strlen($newAuthorAvatarUrl) >  128) {
			//throw(new \RangeException("Your avatar is to large"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/* accessor method for authorActivationToken
	 *
	 * @return string value of authorActivationToken
	 */


	public function getAuthorActivationToken(): ?string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException if the url is not a string or insecure
	 * @throws \ TypeError if the url is not a string
	 */
	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for authorEmail
	 * @return string value of authorEmail
	 */
	public function getAuthorEmail():?string {
		return $this->authorEmail;
	}
	/**
	 *mutator method for authorEmail
	 *
	 *@param string $newAuthorEmail new email
	 *@throws \ InvalidArgumentException if $newEmail is not valid email or insecure
	 *@throws \RangeException if $newEmail is >128 characters
	 *@throws \TypeError if $newEmail is not a string
	 */
	public function setAuthorEmail( string $newAuthorEmail): void{
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("no email on file"));
		}
		if(strlen($newAuthorEmail) >128) {
			throw(new \RangeException("email address is to long"));
		}
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 *accessor method for author hash
	 *
	 * @return string value authorHash
	 */
	public function getAuthorHash():?string {
		return $this->authorHash;
	}
	/**
	 * Mutator method for author hash
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is >128 characters
	 */

	public function setAuthorHash(string $newAuthorHash): void {
		//enforce hash formatting
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("invalid hash try again"));
		}
		//enforce that it is an argon hash
		$newAuthorHashInfo = password_get_info($newAuthorHash);
		if($newAuthorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("invalid hash"));
		}
		if(strlen($newAuthorHash) !==128 ) {
			throw(new \RangeException("hash is to long"));
		}
		$this->authorHash = $newAuthorHash;
	}
	/**
	 * accessor method for AuthorUserName
	 *
	 */
	public function getAuthorUserName():?string {
		return $this->authorUserName;
	}
	public function setAuthorUserName(string $newAuthorUserName) : void {
		$newAuthorUserName = trim($newAuthorUserName);
		if(empty($newAuthorUserName) === true) {
			throw(new \InvalidArgumentException("author username can not be empty"));
		}
		if(strlen($newAuthorUserName)>32){
			throw(new \RangeException("Author username not long enough"));
		}
		$this->authorUserName = $newAuthorUserName;
	}
}
