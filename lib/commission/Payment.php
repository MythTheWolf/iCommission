<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\API\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Exception\PayPalConnectionException;
class PayPalPayment {
	private $API;
	private $redirects;
	private $Acceptor;
	private $Commissioner;
	private $Commprice;
	private $Payer;
	private $Amount;
	private $Details;
	private $Transaction;
	private $PayMent;
	function __construct($comm, $price) {
		// Connection and setup
		$clientId = "ASa1TLptLDSfcCxaVS7S5HbD7EK7ZGhCdJvykHU5pmp4brGq9b_Nt2MC8E-yESm4x0pzQ5ltj76Jdn0z";
		$clientSecret = "EGU4wQAWwoCJOTXOSN6FswzvMcGm4t1gGZXjTurKNXyPQES2WXiF4jLUSK3vShTc9_ma96twLOX6o9";
		$this->API = new ApiContext ( new OAuthTokenCredential ( $clientId, $clientSecret ) );
		$this->API->setConfig ( [ 
				'mode' => "sandbox",
				'http.connectionTimeOut' => 30,
				'log.logEnabled' => true,
				'log.FileName' => "thread.log",
				'validation.level' => "log" 
		] );
	
		// Setting defaults
		$this->Amount = new Amount ();
		$this->Payer = new Payer ();
		$this->Details = new Details ();
		$this->Transaction = new Transaction ();
		$this->PayMent = new Payment ();
		$this->redirects = new RedirectUrls ();
		// Payer
		$this->Payer->setPaymentMethod ( "paypal" );
		
		// Setting details
		$this->Details->setHandlingFee ( "5.00" )->setSubtotal ( $price );
		
		// Setting amount stuff
		$this->Amount->setCurrency ( "USD" )->setTotal ( $price + 5.00 )->setDetails ( $this->Details );
		
		// Actual Transaction
		$this->Transaction->setAmount ( $this->Amount )->setDescription ( "Commission Settlement" );
		// Payment
		$this->PayMent->setIntent ( "sale" )->setPayer ( $this->Payer )->setTransactions ( [ 
				$this->Transaction 
		] );
		
		// Redirect rules
		$this->redirects->setReturnUrl ( "http://localhost/lib/commission/pay-done.php" )->setCancelUrl ( "http://localhost/lib/commission/pay-cancel.php" );
		
		$this->PayMent->setRedirectUrls ( $this->redirects );
		
		try {
			$this->PayMent->create ( $this->API );
			
			// Store transactions
		} catch ( PayPalConnectionException $e ) {
			echo $e->getMessage();
		}
	}
	function getRedirectURL() {
		foreach ( $this->PayMent->getLinks () as $link ) {
			if ($link->getHref () == "approval_url") {
				return $link->getHref();
			}
		}
	}
}
?>