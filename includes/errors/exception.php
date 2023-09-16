<?php

// One exception type for the app's own error cases, so they can be caught apart from the
// built in ones. Keeps a separate user-facing message from the internal one.
class AppException extends Exception
{
    private $userMessage;

    public function __construct(string $message, string $userMessage = 'Something went wrong.', int $code = 0)
    {
        parent::__construct($message, $code);
        $this->userMessage = $userMessage;
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }
}
