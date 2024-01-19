<?php

namespace App\Enums;

enum CognitoErrorCodes : string
{
    case NEW_PASSWORD_CHALLENGE = 'NEW_PASSWORD_REQUIRED';
    case FORCE_PASSWORD_STATUS  = 'FORCE_CHANGE_PASSWORD';
    case RESET_REQUIRED         = 'PasswordResetRequiredException';
    case USER_NOT_FOUND         = 'UserNotFoundException';
    case USERNAME_EXISTS        = 'UsernameExistsException';
    case INVALID_PASSWORD       = 'InvalidPasswordException';
    case CODE_MISMATCH          = 'CodeMismatchException';
    case EXPIRED_CODE           = 'ExpiredCodeException';
}
