<?php

/**
 * PatientRestController
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Hamza Javied <mohammadzhd554@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\RestControllers;

use OpenEMR\RestControllers\RestControllerHelper;
use OpenEMR\Services\UserService;

class CredentialsRestController
{
     /**
     * @var UserService $userService
     */
    private $userService;

    
    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * OTP verification
     * @param $email/$username- User registered email or username 
     */
    public function sendOtp($credentials)
    {
        // print_r($_SESSION);exit();
        // $filteredData = $this->userService->filterData($data, self::WHITELISTED_FIELDS);
        $user= $this->userService->otp_generator($credentials['email']);
        if (false && !$user->hasErrors() && count($user->getData()) == 0) {
            return RestControllerHelper::handleProcessingResult($user, 422);
        }
        else{
            
        return RestControllerHelper::handleProcessingResult($user, 200, true);
        }
    }

    public function resetPassword($data)
    {
        $processingResult = $this->userService->resetPasswordUsingOTP($data);
        if (false &&!$processingResult->hasErrors() && count($processingResult->getData()) == 0) {
            return RestControllerHelper::handleProcessingResult($processingResult, 422);
        }
        else{
            
        return RestControllerHelper::handleProcessingResult($processingResult, 200, true);
        }

    }
}