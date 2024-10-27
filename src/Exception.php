<?php

declare(strict_types=1);

/**
 * This file is part of the RealpadTakeout package
 *
 * https://github.com/Spoje-NET/PHP-Realpad-Takeout
 *
 * (c) Spoje.Net IT s.r.o. <http://spojenenet.cz/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SpojeNet\Realpad;

/**
 * Description of Exception.
 *
 * @author vitex
 */
class Exception extends \Ease\Exception
{
    /**
     * Original server response.
     */
    private string $serverResponse = '';

    /**
     * Error messages sit here.
     */
    private array $errorMessages = [];

    /**
     * RealPad API response as Exception.
     *
     * @param string    $message good to know
     * @param ApiClient $caller  Client Object
     */
    public function __construct($message, ApiClient $caller, ?\Ease\Exception $previous = null)
    {
        $this->errorMessages = $caller->getErrors();
        parent::__construct(\get_class($caller).': '.$message, $caller->getLastResponseCode(), $previous);
    }

    /**
     * Get (first) error message.
     *
     * @param int $index which message
     *
     * @return string
     */
    public function getErrorMessage($index = 0)
    {
        return $this->errorMessages[$index];
    }

    /**
     * All stored Error messages.
     *
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
}
