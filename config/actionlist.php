<?php 

return [
    'gettollinfoandfare' => [
        'action' => [
            'App\\Initialization\\SetTollBetweenLocations'
        ],
        'function' => ['doValidations']
    ],
    'settollbetweenlocations' => [
        'action' => [],
        'function' => ['calculateTollsBetweenLocations', 'getMinimumBalanceForAutoTopUp']
    ],
    'initiateBookRideAndTransactions' => [
        'action' => [
            'App\\Validations\\BookRideValidations',
            'App\\BusinessLogic\\CreateRideForVehicles',
            'App\\BusinessLogic\\CreateTransaction',
            'App\\BusinessLogic\\CreateRideDetailRelations'
        ],
        'function' => ['doValidations','createRideForEachVehicle'],
        'validation' => [
            'validateTaxCalculationJsonString',
            'validateVehicles'
        ]
    ],
    'getQrCode' => [
        'function' => ['generateQrCode', 'insertQrcodeToUsersLoginHistory']
    ],
    'qrCodeStatus' => [
        'function' => ['doValidations', 'getLoginRequestStatus']
    ],
    'forgotPassword' => [
        'function' => ['doValidations', 'createResetPasswordToken']
    ],
    'resetPassword' => [
        'function' => ['doValidations','setUpSessionData' ,'validateToken', 'updateUserPasssword']
    ],
    'verifyToken' => [
        'function' => ['doValidations', 'validateTokenForResetPassword']
    ],
    'updateTransactionPaymentStatus' => [
        'function' => ['doValidations', 'updateRideDetailStatus'],
        'action' => [
            'App\\Validations\\UpdateRideStatusValidations',
            'App\\Initialization\\SetRideDetailStatus',
            'App\\BusinessLogic\\UpdateRideDetailStatus',
            'App\\BusinessLogic\\UpdateTransactions',
            'App\\Initialization\\TransactionDetails',
            'App\\BusinessLogic\\CreateAccountingEntry'
        ]
    ],
    'updateRideDetailStatus' => [
        'function' => ['updateRidesStatus']
    ],
    'updateTransactions' => [
        'function' => ['updateTransactionStatus']
    ],
    'getUserBookings' => [
        'action' => [
            'App\\BusinessLogic\\ListUserBookings'
        ]
    ],
    'listUserBookings'=> [
        'function' => ['userBookings']
    ],
    'addCorporateUser' => [
        'action' => [
            'App\\Validations\\AddCorporateUserValidation',
            'App\\BusinessLogic\\AddCorporateUser'
        ]
    ],
    'updateCorporateUser' => [
        'action' => [
            'App\\Validations\\UpdateCorporateUserValidation',
            'App\\BusinessLogic\\UpdateCorporateUser'
        ]
    ],
    'listCorporateUsers' => [
        'function' => ['listAll']
    ],
    'showCorporateuser' => [
        'action' => [
            'App\\BusinessLogic\\ListCorporateUsers'
        ]
    ],
    'updateCorporateUserStatus' => [
        'action' => [
            'App\\BusinessLogic\\UpdateCorporateUserStatus'
        ]
    ]


];