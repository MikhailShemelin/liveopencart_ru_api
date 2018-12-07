<?php

namespace liveopencart;

class api_msg {
	
	protected $hash_method = 'sha256';
	protected $hash_key = '';

	public function __construct($hash_key, $hash_method='sha256') {
		$this->hash_key 	= $hash_key;
		$this->hash_method 	= $hash_method;
	}
	
	protected function hmac($data_str) {
		return hash_hmac($this->hash_method, $data_str, $this->hash_key); 
	}
	
	public function getMsgStatus($msg) {
		if ( isset($msg['hash']) && isset($msg['data']) ) {
			return $msg['hash'] === $this->hmac($msg['data']);
		}
	}
	
	public function getDataFromMsg($msg) {
		$msg_status = $this->getMsgStatus($msg);
		if ( !$msg_status ) {
			return $msg_status;
		} else {
			return $msg['data'];
		}
	}
	
	public function getDataFromPost() {
		return $this->getDataFromMsg($_POST);
	}
	
	public function getDecodedDataFromPost($assoc=false) {
		$data = $this->getDataFromPost();
		if ( $data ) {
			return json_decode($data, $assoc);
		} else {
			return $data;
		}
	}
	
	public function generateMsg($data) {
		$msg = array(
			'hash' => $this->hmac($data),
			'data' => $data,
		);
		return $msg;
	}
	
	public function generateEncodedMsg($data) {
		return json_encode($this->generateMsg($data));
	}
	
}

