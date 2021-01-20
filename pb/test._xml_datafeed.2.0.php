<?
/**
 * FoxyCart Test XML Generator
 * 
 * @link http://wiki.foxycart.com/integration:misc:test_xml_post
 * @version 2.0
 */
/*
	DESCRIPTION: =================================================================
	The purpose of this file is to help you set up and debug your FoxyCart XML DataFeed scripts.
	It's designed to mimic FoxyCart.com and send encrypted and encoded XML to a URL of your choice.
	It will print out the response that your script gives back, which should be "foxy" if successful.
	
	USAGE: =======================================================================
	- Place this file somewhere on your server.
	- Edit the $myURL to the URL where your XML processing script is located.
	- Edit the $myKey to match the key you put in your FoxyCart admin.
	- Edit the $XMLOutput if you have specific data you'd like to test.
	- Save.
	- Load this file in your browser. It will send XML to your script just like FoxyCart would
	  after an order on your store, and will output what your script returns.
	- Test until you get your script working properly.
	
	REQUIREMENTS: ================================================================
	- PHP
	- cURL support in PHP
*/

// ======================================================================================
// CHANGE THIS DATA:
// Set the URL you want to post the XML to.
// Set the key you entered in your FoxyCart.com admin.
// Modify the XML below as necessary.  DO NOT modify the structure, just the data
// ======================================================================================
$myURL = 'http://www.example.com/myxmlprocessor.php';
$myKey = 'CHANGE THIS TEXT to your own datafeed keyphrase';

// You can change the test data below if you'd like to test specific fields.
// For example, you may want to set it up to mirror 
$XMLOutput = <<<XML
<?xml version='1.0' standalone='yes'?>
<foxydata>
	<datafeed_version>XML FoxyCart Version 0.6</datafeed_version>
	<transactions>
		<transaction>
			<id>616</id>
			<store_id>9</store_id>
			<store_version>2.0</store_version>
			<is_test>1</is_test>
			<is_hidden>0</is_hidden>
			<data_is_fed>0</data_is_fed>
			<transaction_date>2010-08-19 13:50:00</transaction_date>
			<processor_response>Authorize.net Transaction ID:2154082729</processor_response>
			<transaction_date>2007-05-04 20:53:57</transaction_date>
			<customer_id>122</customer_id>
			<is_anonymous>0</is_anonymous>
			<minfraud_score>0</minfraud_score>
			<customer_first_name>John</customer_first_name>
			<customer_last_name>Doe</customer_last_name>
			<customer_company>Your Company</customer_company>
			<customer_address1>12345 Any Street</customer_address1>
			<customer_address2></customer_address2>
			<customer_city>Any City</customer_city>
			<customer_state>TN</customer_state>
			<customer_postal_code>37013</customer_postal_code>
			<customer_country>US</customer_country>
			<customer_phone>(123) 456-7890</customer_phone>
			<customer_email>someone@somewhere.com</customer_email>
			<customer_ip>71.228.237.177</customer_ip>
			<shipping_first_name>John</shipping_first_name>
			<shipping_last_name>Doe</shipping_last_name>
			<shipping_company></shipping_company>
			<shipping_address1>1234 Any Street</shipping_address1>
			<shipping_address2></shipping_address2>
			<shipping_city>Some City</shipping_city>
			<shipping_state>TN</shipping_state>
			<shipping_postal_code>37013</shipping_postal_code>
			<shipping_country>US</shipping_country>
			<shipping_phone></shipping_phone>
			<shipping_service_description>UPS: Ground</shipping_service_description>
			<purchase_order></purchase_order>
			<cc_number_masked>xxxxxxxxxxxx4242</cc_number_masked>
			<cc_type>Visa</cc_type>
			<cc_exp_month>08</cc_exp_month>
			<cc_exp_year>2013</cc_exp_year>
			<cc_start_date_month>06</cc_start_date_month>
			<cc_start_date_year>2008</cc_start_date_year>
			<cc_issue_number>01</cc_issue_number>
			<product_total>20.00</product_total>
			<tax_total>0.00</tax_total>
			<shipping_total>4.38</shipping_total>
			<order_total>24.38</order_total>
			<order_total>24.38</order_total>
			<payment_gateway_type>authorize</payment_gateway_type>
			<status>approved</status>
			<customer_password>1aab23051b24582c5dc8e23fc595d505</customer_password>
			<customer_password_salt>SSCtVKDnH1vAwuLyY2XHziIFv3fN5laN8DbYiIcUDBkZW2pP</customer_password_salt>
			<customer_password_hash_type>sha256_salted_suffix</customer_password_hash_type>
			<customer_password_hash_config>48</customer_password_hash_config>
			<custom_fields>
				<custom_field>
					<custom_field_name>My_Cool_Text</custom_field_name>
					<custom_field_value>Value123</custom_field_value>
					<custom_field_is_hidden>1</custom_field_is_hidden>
				</custom_field>
				<custom_field>
					<custom_field_name>Another_Custom_Field</custom_field_name>
					<custom_field_value>10</custom_field_value>
					<custom_field_is_hidden>1</custom_field_is_hidden>
				</custom_field>
			</custom_fields>
			<transaction_details>
				<transaction_detail>
					<product_name>foo</product_name>
					<product_price>20.00</product_price>
					<product_quantity>1</product_quantity>
					<product_weight>0.10</product_weight>
					<product_code></product_code>
					<parent_code></parent_code>
					<image></image>
					<url></url>
					<length></length>
					<width></width>
					<height></height>
					<expires></expires>
					<sub_token_url></sub_token_url>
					<subscription_nextdate>0000-00-00</subscription_nextdate>
					<subscription_enddate>0000-00-00</subscription_enddate>
					<is_future_line_item>0</is_future_line_item>
					<subscription_frequency>1m</subscription_frequency>
					<subscription_startdate>2007-07-07</subscription_startdate>
					<shipto>John Doe</shipto>
					<category_description>Default for all products</category_description>
					<category_code>DEFAULT</category_code>
					<product_delivery_type>shipped</product_delivery_type>
					<transaction_detail_options>
						<transaction_detail_option>
							<product_option_name>color</product_option_name>
							<product_option_value>blue</product_option_value>
							<price_mod></price_mod>
							<weight_mod></weight_mod>
						</transaction_detail_option>
					</transaction_detail_options>
				</transaction_detail>
			</transaction_details>
			<shipto_addresses>
				<shipto_address>
					<address_name>John Doe</address_name>
					<shipto_first_name>John</shipto_first_name>
					<shipto_last_name>Doe</shipto_last_name>
					<shipto_address1>2345 Some Address</shipto_address1>
					<shipto_address2></shipto_address2>
					<shipto_city>Some City</shipto_city>
					<shipto_state>TN</shipto_state>
					<shipto_postal_code>37013</shipto_postal_code>
					<shipto_country>US</shipto_country>
					<shipto_shipping_service_description>DHL: Next Afternoon</shipto_shipping_service_description>
					<shipto_subtotal>52.15</shipto_subtotal>
					<shipto_tax_total>6.31</shipto_tax_total>
					<shipto_shipping_total>15.76</shipto_shipping_total>
					<shipto_total>74.22</shipto_total>
					<shipto_custom_fields>
						<shipto_custom_field>
							<shipto_custom_field_name>My_Custom_Info</shipto_custom_field_name>
							<shipto_custom_field_value>john's stuff</shipto_custom_field_value>
						</shipto_custom_field>
						<shipto_custom_field>
							<shipto_custom_field_name>More_Custom_Info</shipto_custom_field_name>
							<shipto_custom_field_value>more of john's stuff</shipto_custom_field_value>
						</shipto_custom_field>
					</shipto_custom_fields>
				</shipto_address>
			</shipto_addresses>
		</transaction>
	</transactions>
</foxydata>
XML;



// ======================================================================================
// YOU'RE DONE.  DO NOT MODIFY BELOW THIS LINE.
// The code below this line should not be modified unless you have a good reason to do so.
// ======================================================================================

// ======================================================================================
// ENCRYPT YOUR XML
// Modify the include path to go to the rc4crypt file.
// ======================================================================================
$XMLOutput_encrypted = rc4crypt::encrypt($myKey,$XMLOutput);
$XMLOutput_encrypted = urlencode($XMLOutput_encrypted);


// ======================================================================================
// POST YOUR XML TO YOUR SITE
// Do not modify.
// ======================================================================================
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $myURL);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("FoxyData" => $XMLOutput_encrypted));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// Shared hosting users on GoDaddy or other hosts may need to uncomment the following lines:
// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
// curl_setopt($ch, CURLOPT_PROXY,"http://64.202.165.130:3128"); // Replace this IP with whatever your host specifies.
// End shared hosting options
$response = curl_exec($ch);
curl_close($ch);


header("content-type:text/plain");
print $response;




// ======================================================================================
// RC4 ENCRYPTION CLASS
// Do not modify.
// ======================================================================================
/**
 * RC4Crypt 3.2
 *
 * RC4Crypt is a petite library that allows you to use RC4
 * encryption easily in PHP. It's OO and can produce outputs
 * in binary and hex.
 *
 * (C) Copyright 2006 Mukul Sabharwal [http://mjsabby.com]
 *     All Rights Reserved
 *
 * @link http://rc4crypt.devhome.org
 * @author Mukul Sabharwal <mjsabby@gmail.com>
 * @version $Id: class.rc4crypt.php,v 3.2 2006/03/10 05:47:24 mukul Exp $
 * @copyright Copyright &copy; 2006 Mukul Sabharwal
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package RC4Crypt
 */

/**
 * RC4 Class
 * @package RC4Crypt
 */
class rc4crypt {
	/**
	 * The symmetric encryption function
	 *
	 * @param string $pwd Key to encrypt with (can be binary of hex)
	 * @param string $data Content to be encrypted
	 * @param bool $ispwdHex Key passed is in hexadecimal or not
	 * @access public
	 * @return string
	 */
	function encrypt ($pwd, $data, $ispwdHex = 0)
	{
		if ($ispwdHex)
			$pwd = @pack('H*', $pwd); // valid input, please!

		$key[] = '';
		$box[] = '';
		$cipher = '';

		$pwd_length = strlen($pwd);
		$data_length = strlen($data);

		for ($i = 0; $i < 256; $i++)
		{
			$key[$i] = ord($pwd[$i % $pwd_length]);
			$box[$i] = $i;
		}
		for ($j = $i = 0; $i < 256; $i++)
		{
			$j = ($j + $box[$i] + $key[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
		for ($a = $j = $i = 0; $i < $data_length; $i++)
		{
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$k = $box[(($box[$a] + $box[$j]) % 256)];
			$cipher .= chr(ord($data[$i]) ^ $k);
		}
		return $cipher;
	}
	/**
	 * Decryption, recall encryption
	 *
	 * @param string $pwd Key to decrypt with (can be binary of hex)
	 * @param string $data Content to be decrypted
	 * @param bool $ispwdHex Key passed is in hexadecimal or not
	 * @access public
	 * @return string
	 */
	function decrypt ($pwd, $data, $ispwdHex = 0)
	{
		return rc4crypt::encrypt($pwd, $data, $ispwdHex);
	}
}
// ======================================================================================
// END RC4 ENCRYPTION CLASS
// Do not modify.
// ======================================================================================

?>