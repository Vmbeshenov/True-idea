<?php
class Enc {
 
	static public function get_keys($login) {
		
		$config = array(
			"private_key_type"=>OPENSSL_KEYTYPE_RSA,
			"private_key_bits"=>1024
		);
		$file_name = $login . "_private.txt";
		$res = openssl_pkey_new($config);
		$privateKey = '';
		openssl_pkey_export($res,$privateKey);

		$fpr = fopen($file_name,"w");
		fwrite($fpr,$privateKey);
		fclose($fpr);

		$arr = array(
			"countryName" => "RU",
			"stateOrProvinceName" => "Republic of Tatarstan",
			"localityName" => "Kazan",
			"organizationName" => "True idea",
			"organizationalUnitName" => "True idea Books",
			"commonName" => "www.true-idea",
			"emailAddress" => "trueidea@gmail.com"
		);
		
		$csr = openssl_csr_new($arr,$privateKey);
		$cert = openssl_csr_sign($csr,NULL, $privateKey,365);
		openssl_x509_export($cert,$str_cert);

		$public_key = openssl_pkey_get_public($str_cert);
		$public_key_details = openssl_pkey_get_details($public_key); 
		$public_key_string = $public_key_details['key'];
 
		$file_name = $login . "_public.txt";
		$fpr1 = fopen($file_name,"w");
		fwrite($fpr1,$public_key_string);
		fclose($fpr1);

		return array('private'=>$privateKey,'public'=>$public_key_string);
	}
	
	public function my_enc($str, $login) {
		
		$path = $login . "_public.txt";
		$fpr = fopen($path,"r");
		$pub_key = fread($fpr,2048);
		fclose($fpr);
 
		openssl_public_encrypt($str,$result,$pub_key);
		return $result;
	}
	
	public function my_dec($str, $login) {
		
		$path = $login . "_private.txt";
		$fpr = fopen($path,"r");
		$pr_key = fread($fpr,2048);
		fclose($fpr);
 
		openssl_private_decrypt($str,$result,$pr_key); 
		return $result;
	}
}
