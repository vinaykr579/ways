<?php 
return [
    'users' => [
        [
            'key' => 'MobileNumber'
        ],
        [
            'key' => 'EmailId'
        ],
        [
            'key' => 'CountryCode'
        ],
        [
            'key' => 'Name'
        ],
    ],
    'corporates' => [
        [
            'key' => 'UserId',
            'runFunc' => 'getUserId'
        ],
        [
            'key' => 'CorporateUserId',
            'runFunc' => 'getCorporateUserId'
        ],
        [
            'key' => 'UpdatedByUserId',
            'runFunc' => 'getUpdatedByUserId'
        ],
        [
            'key' => 'VerifiiedDate',
            'runFunc' => 'getVerifiiedDate'
        ],
        [
            'key' => 'IsVerified',
            'runFunc' => 'getIsVerified'
        ],
        [
            'key' => 'IsActive',
            'runFunc' => 'getIsActive'
        ],
        [
            'key' => 'UserRole'
        ],
        [
            'key' => 'MaximumBookingAmount'
        ]
    ]
];