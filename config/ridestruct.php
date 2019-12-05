<?php
return [
    'createRide' => [
        [
            'key' => 'Source_Name',
            'runFunc' => 'getSourceName'
        ],
        [
            'key' => 'Source_latitude',
            'runFunc' => 'getSourceLatititue'
        ],
        [
            'key' => 'Source_longitude',
            'runFunc' => 'getSourceLongitude'
        ],
        [
            'key' => 'Destination_Name',
            'runFunc' => 'getDestinationName'
        ],
        [
            'key' => 'Destination_latitude',
            'runFunc' => 'getDestinationLatitude'
        ],
        [
            'key' => 'Destination_longitude',
            'runFunc' => 'getDestinationLongitude'
        ],
        [
            'key' => 'BookedDate',
            'default' => date('Y-m-d H:i:s')
        ],
        [
            'key' => 'TotalAmount'
        ],
        [
            'key' => 'ApplicableAmount',
            'runFunc' => 'getTotalAmount'
        ],
        [
            'key' => 'PaymentStatus',
            'default' => 0
        ],
        [
            'key' => 'PaidAmount',
            'runFunc' => 'getTotalAmount'
        ],
        [
            'key' => 'PendingAmount',
            'default' => 0
        ],
        [
            'key' => 'RefundAmount',
            'default' => 0
        ],
        [
            'key' => 'ConsumedAmount',
            'default' => 0
        ],
        [
            'key' => 'TaxCalculationDetails',
            'default' => '{}'
        ],
        [
            'key' => 'RideStatus',
            'default' => 'initiated'
        ],
        [
            'key' => 'UserID',
            'runFunc' => 'getUserID'
        ],
        [
            'key' => 'UserType',
            'default' => 'user'
        ],
        [
            'key' => 'TripTypeId'
        ],
        [
            'key' => 'VehicleTypeId'
        ],
        [
            'key' => 'VehicleId',
            'runFunc' => 'getVehicleId'
        ],
        [
            'key' => 'IsCorporateBooking',
            'default' => '1'
        ],
        [
            'key' => 'CorporateBookingReasonId',
            'default' => '48'
        ],
        [
            'key' => 'CorporateBookingReason',
            'default' => ''
        ],
        [
            'key' => 'NoOfTrips',
            'default' => '1'
        ],
        [
            'key' => 'BookingType',
            'default' => 'route-specific'
        ],
        [
            'key' => 'BookedFrom',
            'default' => '3'
        ]
    ],
    'createAssociateRide' => [
        [
            'key' => 'Source_Name',
            'runFunc' => 'getSourceName'
        ],
        [
            'key' => 'Source_latitude',
            'runFunc' => 'getSourceLatititue'
        ],
        [
            'key' => 'Source_longitude',
            'runFunc' => 'getSourceLongitude'
        ],
        [
            'key' => 'Destination_Name',
            'runFunc' => 'getDestinationName'
        ],
        [
            'key' => 'Destination_latitude',
            'runFunc' => 'getDestinationLatitude'
        ],
        [
            'key' => 'Destination_longitude',
            'runFunc' => 'getDestinationLongitude'
        ],
        [
            'key' => 'EffectiveDate',
            'default' => date('Y-m-d H:i:s')
        ],
        [
            'key' => 'ExpiryDate',
            'default' => date('Y-m-d H:i:s', strtotime('+365 days', time()))
        ],
        [
            'key' => 'RideStatus',
            'default' => 'initiated'
        ],
        [
            'key' => 'IsReturnRideId'
        ],
        [
            'key' => 'SequenceNumber'
        ],
        [
            'key' => 'AssociateRideUniqueId'
        ],
        [
            'key' => 'BookingSequenceNo'
        ]
    ],
    'createTollInRide' => [
        [
            'key' => 'TollId'
        ],
        [
            'key' => 'TollFare'
        ],
        [
            'key' => 'ApplicableFare'
        ],
        [
            'key' => 'IsSelected'
        ],
        [
            'key' => 'LaneDirection'
        ],
        [
            'key' => 'ExpiredOnDate'
        ],
        [
            'key' => 'VehicleId'
        ],
        [
            'key' => 'RideStatus'
        ],
        [
            'key' => 'TollPaymentStatus'
        ],
        [
            'key' => 'TotalRidesCount'
        ],
        [
            'key' => 'ConsumedCount',
            'default' => 0
        ],
        [
            'key' => 'PaymentModeId',
        ],
        [
            'key' => 'TollTripTypeId'
        ],
        [
            'key' => 'TollUniqueId'
        ],
        [
            'key' => 'UnlimitedRide'
        ],
        [
            'key' => 'Status'
        ]
    ],
    'createTransaction' => [
        [
            'key' => 'VRNNo',
            'runFunc' => 'getVRNNo'
        ],
        [
            'key' => 'InvoiceId',
            'runFunc' => 'getInvoiceId'
        ],
        [
            'key' => 'RideIds'
        ],
        [
            'key' => 'Amount'
        ],
        [
            'key' => 'TollAmount'
        ],
        [
            'key' => 'Discounts'
        ],
        [
            'key' => 'UserCredits'
        ],
        [
            'key' => 'Waived',
            'default' => 0
        ],
        [
            'key' => 'ConvenienceCharges'
        ],
        [
            'key' => 'ConvenienceChargesTaxValue'
        ],
        [
            'key' => 'ConvenienceChargesTaxType'
        ],
        [
            'key' => 'GST'
        ],
        [
            'key' => 'GSTTaxType'
        ],
        [
            'key' => 'GSTTaxValue'
        ],
        [
            'key' => 'EChallan',
            'default' => 0
        ],
        [
            'key' => 'NetPayableAmount'
        ],
        [
            'key' => 'CashBooking',
            'default' => 0
        ],
        [
            'key' => 'Card'
        ],
        [
            'key' => 'NetBanking'
        ],
        [
            'key' => 'OTC',
            'default' => 0
        ],
        [
            'key' => 'Wallet',
            'default' => 0
        ],
        [
            'key' => 'UPI',
            'default' => 0
        ],
        [
            'key' => 'PayTM',
            'default' => 0
        ],
        [
            'key' => 'Status',
            'default' => 'Pending'
        ],
        [
            'key' => 'TxnDate',
            'default' => date('Y-m-d H:i:s')
        ],
        [
            'key' => 'UserId',
            'runFunc' => 'getUserId'
        ],
        [
            'key' => 'InitiatedByUserId',
            'runFunc' => 'getUserId'
        ],
        [
            'key' => 'IsRefund',
            'default' => 0
        ],
        [
            'key' => 'RozorPaymentID',
            'default' => ''
        ],
        [
            'key' => 'RozorPayResponse',
            'default' => '{}'
        ],
        [
            'key' => 'PaymentInfoId',
        ],
        [
            'key' => 'PaymentModeId'
        ],
        [
            'key' => 'AccountingEntry',
            'default' => 0
        ]
            
    ],
    'createPaymentInfo' => [
        [
            'key' => 'PaymentModeId'
        ],
        [
            'key' => 'UserId',
            'runFunc' => 'getUserId'
        ],
        [
            'key' => 'IdentityType',
            'default' => 'user'
        ],
        [
            'key'=> 'AccountNumber',
            'runFunc' => 'getAccountNumber'
        ],
        [
            'key' => 'Expire_yy',
            'runFunc' => 'getExpiryYear'
        ],
        [
            'key' => 'Expire_mm',
            'runFunc' => 'getExpiryMonth'
        ],
        [
            'key' => 'AccountHolderName',
            'runFunc' => 'getAccountHolderName'
        ],
        [
            'key' => 'BankName',
            'default' => ''
        ],
        [
            'key' => 'IsActive',
            'default' => '1'
        ]
    ],
    'createRideDetailRelation' => [
        [
            'key' => 'RideId',
            'runFunc' => 'getRideId'
        ],
        [
            'key' => 'AssociateRideId',
            'runFunc' => 'getAssociateRideId'
        ],
        [
            'key' => 'TollInRideId',
            'runFunc' => 'getTollInRideId'
        ],
        [
            'key' => 'TransactionId',
            'runFunc'=> 'getTransactionId'
        ],
        [
            'key' => 'UserId',
            'runFunc' => 'getUserId'
        ],
        [
            'key' => 'VehicleId',
            'runFunc' => 'getVehicleId'
        ],
        [
            'key' => 'RideSequenceNo',
            'runFunc' => 'getRideSequenceNo'
        ]
    ],
    'createTollFareAndTransactions' => [
        [
            'key' => 'EntryId'
        ],
        [
            'key' => 'VoucherNo'
        ],
        [
            'key' => 'FlowType'
        ],
        [
            'key' => 'AccountName',
            'runFunc'=> 'getAccountName'
        ],
        [
            'key' => 'TransactionId',
            'runFunc'=> 'getTransactionId'
        ],
        [
            'key' => 'TollId',
            'runFunc'=> 'getTollId'
        ],
        [
            'key' => 'VehicleId',
            'runFunc'=> 'getVehicleId'
        ],
        [
            'key' => 'UserId',
            'runFunc'=> 'getUserId'
        ],
        [
            'key' => 'Amount'
        ],
        [
            'key' => 'IdentityType',
            'runFunc' => 'getIdentityType'
        ]
    ]

];