<?php 
require_once("server.conf");

class Interaction
{
    // USER INTERACTIONS

    /**
     * Check if a user already exists in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_exists = 0: user not exists in the system.
     *      user_exists = 1: user exists in the system.
     *      error: message in case of error.
     */
    public static function check_user($data) {

        $response = array("user_exists" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Creates a user in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_created = 0: user not created.
     *      user_created = 1: user created.
     *      error: message in case of error.
     */
    public static function create_user($data) {

        $response = array("user_created" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Deletes a user from the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_deleted = 0: user not deleted.
     *      user_deleted = 1: user deleted.
     *      error: message in case of error.
     */
    public static function delete_user($data) {

        $response = array("user_deleted" => 0);

       // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Find all users in the system
     * @param array $data Request information
     * @return array $response Interaction result
     *      users: users data
     *      error: message in case of error.
     */
    public static function find_all_users($data) {

        $response = array( "users" => array() );

       // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Locks a user in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_locked = 0: user not locked.
     *      user_locked = 1: user locked.
     *      error: message in case of error.
     */
    public static function lock_user($data) {

        $response = array("user_locked" => 0);

       // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Unlocks a user in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_unloked = 0: user not unlocked.
     *      user_unloked = 1: user unlocked.
     *      error: message in case of error.
     */
    public static function unlock_user($data) {

        $response = array("user_unloked" => 0);

       // Insert your code here.

        return array("response" => $response); 
    }

    /**
     * Set a user password in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_unloked = 0: user not unlocked.
     *      user_unloked = 1: user unlocked.
     *      error: message in case of error.
     */
    public static function set_user_password($data) {

        $response = array("password_set" => 0);

       // Insert your code here.

        return array("response" => $response); 
    }

    /**
     * Updates a user in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_updated = 0: user not updated.
     *      user_updated = 1: user updated.
     *      error: message in case of error.
     */
    public static function update_user($data) {

        $response = array("user_updated" => 0);

       // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Updates the identifier of a user in the system
     * @param array $data User information
     * @return array $response Interaction result
     *      user_id_updated = 0: user id not updated.
     *      user_id_updated = 1: user id updated.
     *      error: message in case of error.
     */
    public static function update_user_id($data) {

        $response = array("user_id_updated" => 0);

        // Insert your code here.
 
         return array("response" => $response);
    }

    // RIGTH INTERACTIONS

    /**
     * Check if a right already exists in the system
     * @param array $data Right information
     * @return array $response Interaction result
     *      right_exists = 0: right not exists in the system.
     *      right_exists = 1: right exists in the system.
     *      error: message in case of error.
     */
    public static function check_right($data) {

        $response = array("right_exists" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Creates a right in the system
     * @param array $data Right information
     * @return array $response Interaction result
     *      right_created = 0: right not created.
     *      right_created = 1: right created.
     *      error: message in case of error.
     */
    public static function create_right($data) {
        
        $response = array("right_created" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Updates a right in the system
     * @param array $data Right information
     * @return array $response Interaction result
     *      right_updated = 0: right not updated.
     *      right_updated = 1: right updated.
     *      error: message in case of error.
     */
    public static function update_right($data) {

        $response = array("right_updated" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Deletes a right from the system
     * @param array $data Right information
     * @return array $response Interaction result
     *      right_deleted = 0: right not deleted.
     *      right_deleted = 1: right deleted.
     *      error: message in case of error.
     */
    public static function delete_right($data) {
        
        $response = array("right_deleted" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Find all rights in the system
     * @param array $data Request information
     * @return array $response Interaction result
     *      rights: rights data
     *      error: message in case of error.
     */
    public static function find_all_rights($data) {
        
        $response = array( "rights" => array() );

       // Insert your code here.

        return array("response" => $response);
    }

    // USER RIGHTS INTERACTIONS
    
    /**
     * Associates a right to a user in the system
     * @param array $data Request information
     * @return array $response Interaction result
     *      user_right_associated = 0: right not associated to the user.
     *      user_right_associated = 1: right associated to the user.
     *      error: message in case of error.
     */
    public static function associate_right_to_user($data) {

        $response = array("user_right_associated" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Unassociates a right from a user in the system
     * @param array $data Request information
     * @return array $response Interaction result
     *      user_right_unassociated = 0: right not unassociated to the user.
     *      user_right_unassociated = 1: right unassociated to the user.
     *      error: message in case of error.
     */
    public static function unassociate_right_to_user($data) {
        
        $response = array("user_right_unassociated" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Changes the rights of a user in the system
     * @param array $data Request information
     * @return array $response Interaction result
     *      user_right_changed = 0: rights not changed.
     *      user_right_changed = 1: rights changed.
     *      error: message in case of error.
     */
    public static function change_user_right($data) {

        $response = array("user_right_changed" => 0);

        // Insert your code here.

        return array("response" => $response);
    }

    /**
     * Find all rights of a user in the system
     * @param array $data Request information
     * @return array $response Interaction result
     *      user_rights: user rights data
     *      error: message in case of error.
     */
    public static function find_all_user_rights($data) {

        $response = array( "user_rights" => array() );

       // Insert your code here.

        return array("response" => $response);
    }
}