<?php

namespace marinopusic\PhpMvcCore\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You dont have permission to access this particular page';
    protected $code = 403;

}