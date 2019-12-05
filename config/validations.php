<?php 

return [
    'getTollInfoAndFare' => [
        'VehicleTypeId' => 'required|numeric|min:1|max:7',
        'TripTypeId' => 'required|numeric|min:1|max:14',
        'Source.PlaceId' => 'string',
        'Destination.0.PlaceId' => 'string',
        'Rides' =>  'array',
        'PAYGAmount' =>  'numeric',
        'NoOfTrips' =>  'numeric|min:1|max:6',
    ],
    'initiateBookRideAndTransactions' => [
        'VehicleTypeId' => 'required|numeric|min:1|max:7',
        'TripTypeId' => 'required|numeric|min:1|max:14',
        'Source.PlaceId' => 'string',
        'Destination.PlaceId' => 'string',
        'Rides' =>  'array|min:1',
        'Vehicles' => 'required|array|min:1',
        'PayableAmount' => "required|regex:/^\d+(\.\d{1,2})?$/",
        'TotalAmount' => "required|regex:/^\d+(\.\d{1,2})?$/",
        'TaxCalculationDetails' => "required|string"
    ],
    'qrCodeStatus' => [
        'QrC' => 'required|string'
    ],
    'forgotPassword' => [
        'EmailId' => 'required|string|email'
    ],
    'resetPassword' => [
        'password' => 'required|string|confirmed'
    ],
    'verifyToken' => [
        'Token' => 'required|string'
    ],
    'updateTransactionPaymentStatus' => [
        'TransactionId' => 'required|numeric',
        'RideIds' => 'required|string',
        'RazorPaymentId' => 'required|string',
        'RazorPaymentResponse' => 'string',
        'Status' => 'required|string',
    ],
    'contactFormData' => [
        'FullName' => 'required|string',
        'EmailId' => 'required|email',
        'MobileNo' => 'required|numeric',
        'Message' => 'required|string'
    ],
    'addCorporateUser' => [
        'CountryCode' => 'required|string',
        'UserRole' => 'required|numeric',
        'Name' => 'required|string',
        'MobileNumber' => 'required|numeric',
        'EmailId' => 'required|email',
        'MaximumBookingAmount' => 'required|numeric',
    ],
    'updateCorporateUser' => [
        'CorporateId' => 'required|numeric',
        'CorporateUserId' => 'required|numeric',
        'CountryCode' => 'required|string',
        'UserRole' => 'required|numeric',
        'Name' => 'required|string',
        'MobileNumber' => 'required|numeric',
        'EmailId' => 'required|email',
        'MaximumBookingAmount' => 'required|numeric',
    ],
    'updateCorporateUserStatus' => [
        'CorporateId' => 'required|numeric',
        'Status' => 'required|numeric',
    ] 
];