<?php
	
	class Authentication
	{
		/**
		 * Creates a token for a valid user
		 * @param array $data Received parameters for token creation
		 *		array(
		 *			'grant_type' => string 'client_credentials',
		 *			'client_id' => int Internar user id,
		 *			'client_secret' => string User password
		 *		)
		 * @return array Formated request return
		 *		array(
		 *			'token_type' => string 'SWT',
		 *			'access_token' => string Access Token
		 *		)
		 */
		public static function oauth2($data)
		{
			$return_data['token_type'] = 'SWT';
			$return_data['access_token'] = '';
			$return_data['status'] = "ERROR";
			
			if(isset($data['grant_type'], $data['client_secret'], $data['client_id']))
			{
				if($data['grant_type'] == 'client_credentials')
				{
					$search_result = false;

					foreach ($GLOBALS['oauth2_users'] as $user) {
						if( $user['client_id'] == $data['client_id'] && $user['client_secret'] == $data['client_secret']){
							$search_result = true;
						}
					}

					if($search_result)
					{
						$return_data['access_token'] = self::create_token($data['client_id']);
						$return_data['status'] = "OK";
						if($GLOBALS['debug'])
						{
							syslog(LOG_INFO, "Created token");
						}
					}
					else
					{
						if($GLOBALS['debug'])
						{
							syslog(LOG_INFO, "Invalid User - Valid token not created");
						}
					}
				}
				else
				{
					if($GLOBALS['debug'])
					{
						syslog(LOG_INFO, "Invalid Grant Type - Valid token not created");
					}
				}
			}
			else
			{
				if($GLOBALS['debug'])
				{
					syslog(LOG_INFO, 'Structural error: missing "grant_type", "client_secret", "client_id"');
				}
			}
			
			return $return_data;
		}
		
		/**
		 * Creates the token
		 * @param int $user_id ID interno do usuario
		 * @return string Created token
		 */
		private static function create_token($user_id)
		{
			$token = md5(uniqid(rand().$user_id, true));
			self::save_token($token, $user_id);

			return $token;
		}
		
		/**
		 * Validates the header of the received request
		 * @param array $header Received Header 
		 * @return boolean true if valid, false if not valid
		 */
		public static function validate_header($header)
		{
			$error = false;
			
			if(!isset($header['Authorization']))
			{
				$error = true;
			}
			else
			{
				$token = explode(" ", $header['Authorization']);				
				$search_result = self::get_token( $token[count($token) - 1] );
				
				if( $search_result[0]['valid_acess'] == 0 )
				{
					$error = true;
				}
			}
			
			if($error)
			{
				if( $GLOBALS['debug'] )
				{
					syslog(LOG_INFO, "Invalid token");
				}
				return false;
			}
			else
			{
				if ($GLOBALS['debug'] )
				{
					syslog(LOG_INFO, "Valid token");
				}
				return true;
			}
		}

		// CUSTOMIZABLE FUNCTIONS
		
		/**
		 * Remove expired tokens from the database
		 * @param int $time_in_minutes Time of validation in minutes.
		 */
		public static function remove_expired_tokens($time_in_minutes)
		{
			// Insert your code here.

			if($GLOBALS['debug'])
			{
				syslog(LOG_INFO, "Removed expired tokens");
			}
		}

		/**
		 * Saves the created token in the database
		 * @param string $token Generated token
		 * @param string $user_id User interna id
		 */
		public static function save_token($token, $user_id)
		{
			// Insert your code here.
		}

		/**
		 * Returns the requested token from the database
		 * @param string $token Requested token
		 */
		public static function get_token($token)
		{
			// Insert your code here.
		}
	}