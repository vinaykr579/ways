<?php

return [
    'tripTypes' => [
        'single' => 1,
        '24hrReturn' => 2,
        'return' => 3,
        'monthly' => 4,
        'localSingle' => 5,
        'localPass' => 6,
        'dayPass' => 8,
        'dayReturn' => 9,
        'multitrip' => 10,
        'payg' => 11,
        '50trips' => 13,
        '100trips' => 14
    ],
    'paymentModes' => [
        1 => 'Cash',
        2 => 'Card',
        3 => 'Net Banking',
        4 => 'Wallet',
        5 => 'UPI',
        6 => 'PayTM',
        8 => 'Ways',
        9 => 'User Credits',
        10 => 'EChallan',
        11 => 'Waived',
        13 => 'OTC',
    ],
    'autoTopUpsSupportedTrip' => [
        4,11,13,14
    ],
    'payment_mode' => [
        'card' => 2,
    ],
    'transaction' => [
        'success' => 'Success',
        'pending' => 'Pending',
        'failure' => 'Failure'
    ],
    'rideStatus' => [
        'initiated' => 'Initiated',
        'booked' => 'Booked',
        'ongoing' => 'Ongoing',
        'completed' => 'Completed',
        'paymentfailed' => 'PaymentFailed',
        'refundstarted' => 'RefundStarted',
        'aborted' => 'Aborted',
        'refunded' => 'Refunded',
    ],
    'account' => [
        'ways' => 'ways',
        'ways_credit' => 'ways_credit',
        'ways_user_payment' => 'ways_user_payment',
        'booking_entry' => 1,
        'user_credit_entry' => 3
    ]
];