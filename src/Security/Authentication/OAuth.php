<?php

namespace Rad\Security\Authentication;

use Rad\Security\Authentication\OAuth\Config;
use Rad\Security\Authentication\OAuth\ConfigManager;
use Rad\Security\Authentication\OAuth\Exception;

/**
 * OAuth
 *
 * @package Rad\Security\Authentication
 */
class OAuth
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * Rad\Security\Authentication\OAuth constructor
     *
     * @param string $configId
     *
     * @throws Exception
     */
    public function __construct($configId)
    {
        if (ConfigManager::exist($configId)) {
            $this->config = ConfigManager::get($configId);
        } else {
            throw new Exception(sprintf('OAuth config id "%s" does not exist.', $configId));
        }
    }

    /**
     * Get authorize uri
     *
     * @return string
     */
    public function getAuthorizeUri()
    {
        return $this->config->getProvider()->getAuthorizeUri();
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->config->getProvider()->getAccessToken();
    }

    /**
     * Get user
     *
     * @param string $token Access token
     *
     * @return OAuth\User
     */
    public function getUser($token)
    {
        return $this->config->getProvider()->getUser($token);
    }
}
