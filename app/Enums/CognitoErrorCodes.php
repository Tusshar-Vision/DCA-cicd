<?php

namespace App\Enums;

enum CognitoErrorCodes : string
{
    case NEW_PASSWORD_CHALLENGE = 'NEW_PASSWORD_REQUIRED';
    case FORCE_PASSWORD_STATUS  = 'FORCE_CHANGE_PASSWORD';
    case RESET_REQUIRED         = 'PasswordResetRequiredException';
    case USER_NOT_FOUND         = 'UserNotFoundException';
    case USER_NOT_CONFIRMED     = 'UserNotConfirmedException';
    case NOT_AUTHORIZED         = 'NotAuthorizedException';
    case USERNAME_EXISTS        = 'UsernameExistsException';
    case INVALID_PASSWORD       = 'InvalidPasswordException';
    case CODE_MISMATCH          = 'CodeMismatchException';
    case EXPIRED_CODE           = 'ExpiredCodeException';
    case TOO_MANY_REQUESTS      = 'TooManyRequestsException';
    case LIMIT_EXCEEDED         = 'LimitExceededException';
    case CODE_DELIVERY_FAILED   = 'CodeDeliveryFailureException';
    case USER_LAMBDA_VALIDATION = 'UserLambdaValidationException';
    case INVALID_PARAMETER_EXCEPTION = 'InvalidParameterException';
}
