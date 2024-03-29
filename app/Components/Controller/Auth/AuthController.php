<?php

namespace Solital\Components\Controller\Auth;

use Solital\Core\Resource\Session;
use Solital\Core\Security\Guardian;

class AuthController extends Guardian
{
    /**
     * @var string
     */
    private $user_column;

    /**
     * @var string
     */
    private $pass_column;

    /**
     * @var string
     */
    private $user_post;

    /**
     * @var string
     */
    private $pass_post;

    /**
     * Authenticates the user in the system
     * @param string $table
     */
    public function register(string $table, string $redirect = null)
    {
        $user = filter_input(INPUT_POST, $this->user_post);
        $pass = filter_input(INPUT_POST, $this->pass_post);

        $res = Guardian::verifyLogin()
            ->table($table)
            ->fields($this->user_column, $this->pass_column, $user, $pass);
        
        if ($res) {
            if ($redirect != null) {
                Session::new('solital_index_profile', $user);
                Session::new('last_id', $res['idProfile']);
                
                response()->redirect($redirect);
            } else {
                Guardian::validate($user);
            }
        } else {
            return false;
        }
    }

    /**
     * Database columns
     * @param string $user_column
     * @param string $pass_column
     */
    public function columns($user_column, $pass_column): self
    {
        $this->user_column = $user_column;
        $this->pass_column = $pass_column;

        return $this;
    }

    /**
     * HTML input values
     * @param string $user_post
     * @param string $pass_post
     */
    public function values($user_post, $pass_post): self
    {
        $this->user_post = $user_post;
        $this->pass_post = $pass_post;

        return $this;
    }
}
