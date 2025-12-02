<?php
require_once("server.conf");
require_once("functions.php");
require_once("Authentication.php");
require_once("Connection.php");
require_once("Interaction.php");

function process_method($data, $type, $headers)
{

	if ( !is_client_allowed( $_SERVER['REMOTE_ADDR'] ) ) 
	{
		syslog(LOG_INFO, "Client not allowed: " . $_SERVER['REMOTE_ADDR']);
		$return_processed_data = array(
			'odata.error' => array(
				'code' => 'Request_BadRequest',
				'message' => array(
					'value' => "Client not allowed"
				)
			)
		);
	}
	else
	{
		$return_processed_data = array(
			'odata.error' => array(
				'code' => 'Request_BadRequest',
				'message' => array(
					'value' => "Unknown action"
				)
			)
		);
	
		if(isset($data['action']))
		{
			if($data['action'] == 'oauth2')
			{
				$return_processed_data = Authentication::oauth2($data);
			}
			else
			{
				if(Authentication::validate_header($headers) == false)
				{
					syslog(LOG_INFO, 'Authentication failure');
					$return_processed_data = array(
							'odata.error' => array(
								'code' => 'Request_BadRequest',
								'message' => array(
									'value' => "Authentication failure"
								)
							)
						);
				}
				else
				{
					switch($data['action'])
					{
						case 'create_user':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::create_user($data);
							}
						}
						break;
	
						case 'check_user':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::check_user($data);
							}
						}
						break;
	
						case 'update_user':
						{
							//Restringe para comandos do tipo PATCH
							if($type == "PATCH")
							{
								$return_processed_data = Interaction::update_user($data);
							}
						}
						break;
	
						case 'update_user_id':
							{
								//Restringe para comandos do tipo PATCH
								if($type == "PATCH")
								{
									$return_processed_data = Interaction::update_user_id($data);
								}
							}
							break;
	
						case 'lock_user':
						{
							if($type == "PATCH")
							{
								$return_processed_data = Interaction::lock_user($data);
							}
						}
	
						case 'unlock_user':
							{
								if($type == "PATCH")
								{
									$return_processed_data = Interaction::unlock_user($data);
								}
							}
						break;
	
						case 'set_user_password':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::set_user_password($data);
							}
						}
						break;
	
						case 'delete_user':
						{
							if($type == "DELETE")
							{
								$return_processed_data = Interaction::delete_user($data);
							}
						}
						break;
	
						case 'find_all_users':
						{
							if($type == "GET")
							{
								$return_processed_data = Interaction::find_all_users();
							}
						}
						break;
	
						case 'create_right':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::create_right($data);
							}
						}
						break;
	
						case 'delete_right':
						{
							if($type == "DELETE")
							{
								$return_processed_data = Interaction::delete_right($data);
							}
						}
						break;
	
						case 'update_right':
						{
							if($type == "PATCH")
							{
								$return_processed_data = Interaction::update_right($data);
							}
						}
						break;
	
						case 'check_right':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::check_right($data);
							}
						}
						break;
	
						case 'find_all_rights':
						{
							if($type == "GET")
							{
								$return_processed_data = Interaction::find_all_rights();
							}
						}
						break;
	
						case 'associate_right_to_user':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::associate_right_to_user($data);
							}
						}
						break;
	
						case 'unassociate_right_to_user':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::unassociate_right_to_user($data);
							}
						}
						break;
	
						case 'change_user_right':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::change_user_right($data);
							}
	
							break;
						}
	
						case 'find_all_user_rights':
						{
							if($type == "POST")
							{
								$return_processed_data = Interaction::find_all_user_rights($data);
							}
						}
						break;
					}
				}
			}
		}
	}

	return $return_processed_data;
}

// //Remove expired tokens
if($GLOBALS['token_expiration_time'] > 0)
{
	Authentication::remove_expired_tokens( $GLOBALS['token_expiration_time'] );
}

//Process actions
$data = file_get_contents('php://input');
$output = array();

if($_SERVER['REQUEST_METHOD'] != 'GET' && !empty($data))
{
	$output = json_decode($data, true);

	if ( $output === null )
	{
		$output = decode_url_params( $data );
	}
}

multidimensionalArrayMap("utf8_decode", $output, null, true);

$dadosRecebidos = array_merge($output, $_GET);

if( $GLOBALS['debug'] )
{
	syslog(LOG_INFO, "Received data: " . json_encode($dadosRecebidos) );
}

$response_data = process_method($dadosRecebidos, $_SERVER['REQUEST_METHOD'], apache_request_headers());
multidimensionalArrayMap('utf8_encode', $response_data, null, true);
$response_data = json_encode($response_data);
if($GLOBALS['debug'])
{
	syslog(LOG_INFO, "Response data: " . $response_data);
}
echo($response_data);