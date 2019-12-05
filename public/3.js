webpackJsonp([3],{

/***/ 787:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(6);

var _react2 = _interopRequireDefault(_react);

var _bookingDetail = __webpack_require__(793);

var _getBookings = __webpack_require__(796);

var _getBookings2 = _interopRequireDefault(_getBookings);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

// import Pagination from '../components/ui/pagination';

var Bookings = function (_Component) {
    _inherits(Bookings, _Component);

    function Bookings(props) {
        _classCallCheck(this, Bookings);

        var _this = _possibleConstructorReturn(this, (Bookings.__proto__ || Object.getPrototypeOf(Bookings)).call(this, props));

        _this.counter = 0;

        _this.handleBookingDetailClick = function (ele) {
            var slideEle = ele.target.parentElement.parentElement.parentNode.nextSibling;
            if (slideEle != null) {
                if (slideEle.style.display === '') {
                    slideEle.style.display = 'none';
                } else {
                    slideEle.style.display = '';
                }
            }
        };

        _this.loadBookingData = function (page) {
            var obj = new _getBookings2.default(_this);
            obj.makeRequest(page);
        };

        _this.state = {
            bookings: []
        };
        _this.loadBookingData(1);
        return _this;
    }

    _createClass(Bookings, [{
        key: 'render',
        value: function render() {
            var _this2 = this;

            this.counter = 0;
            return _react2.default.createElement(
                'div',
                { className: 'borders m-b' },
                _react2.default.createElement(
                    'h2',
                    { className: 'namePart' },
                    'Bookings'
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'grid-list p-lr' },
                    _react2.default.createElement(
                        'div',
                        { className: 'list-in lbs' },
                        _react2.default.createElement(
                            'div',
                            { className: 'table-responsive' },
                            _react2.default.createElement(
                                'table',
                                { className: 'tables' },
                                _react2.default.createElement(
                                    'thead',
                                    null,
                                    _react2.default.createElement(_bookingDetail.TableHeading, null)
                                ),
                                _react2.default.createElement(
                                    'tbody',
                                    null,
                                    this.state.bookings.map(function (booking) {
                                        _this2.counter++;
                                        return _react2.default.createElement(_bookingDetail.BookingDetail, {
                                            key: booking.Transaction.TransactionId,
                                            booking: booking,
                                            counter: _this2.counter,
                                            onClick: _this2.handleBookingDetailClick
                                        });
                                    })
                                )
                            )
                        )
                    )
                )
            );
        }
    }]);

    return Bookings;
}(_react.Component);

exports.default = Bookings;

/***/ }),

/***/ 793:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.TableHeading = exports.BookingDetail = undefined;

var _react = __webpack_require__(6);

var _react2 = _interopRequireDefault(_react);

var _reactRouterDom = __webpack_require__(24);

var _receipt = __webpack_require__(296);

var _receipt2 = _interopRequireDefault(_receipt);

__webpack_require__(794);

var _helper = __webpack_require__(297);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var BookingDetail = exports.BookingDetail = function BookingDetail(props) {
    var bookingType = props.booking.Ride.BookingType === 'route-specific' ? 'Route specific' : 'Toll specific';
    var toll = function toll(booking) {
        var ret = '';
        if (booking.Ride.BookingType === 'route-specific') {
            var source = booking.Ride.Source_Name;
            var destination = booking.Ride.Destination_Name;
            ret = source + '-' + destination;
        } else {
            var aride = booking.Ride.AssociateRides[0];
            ret = aride.Tolls[0].Name;
        }
        return ret;
    };

    var vehicles = props.booking.VehicleBookings.map(function (vehicle) {
        return vehicle.RegistrationNumber;
    });

    return _react2.default.createElement(
        _react.Fragment,
        null,
        _react2.default.createElement(
            'tr',
            null,
            _react2.default.createElement(
                'td',
                null,
                props.counter
            ),
            _react2.default.createElement(
                'td',
                null,
                (0, _helper.datetimeTodate)(props.booking.Transaction.UpdatedOnDate)
            ),
            _react2.default.createElement(
                'td',
                null,
                props.booking.Transaction.TransactionId
            ),
            _react2.default.createElement(
                'td',
                null,
                (0, _helper.getVehicleTypeTitle)(props.booking.Ride.VehicleTypeId)
            ),
            _react2.default.createElement(
                'td',
                null,
                (0, _helper.getTripTypeTitle)(props.booking.Ride.TripTypeId)
            ),
            _react2.default.createElement(
                'td',
                null,
                bookingType
            ),
            _react2.default.createElement(
                'td',
                { title: vehicles.join(', ') },
                props.booking.VehicleBookings.length
            ),
            _react2.default.createElement(
                'td',
                null,
                toll(props.booking)
            ),
            _react2.default.createElement(
                'td',
                null,
                _react2.default.createElement(
                    'span',
                    null,
                    _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' })
                ),
                props.booking.Transaction.Amount
            ),
            _react2.default.createElement(
                'td',
                null,
                _react2.default.createElement(
                    _reactRouterDom.Link,
                    { onClick: function onClick(e) {
                            return props.onClick(e);
                        }, to: '#', className: 'openTr' },
                    _react2.default.createElement('i', { className: 'fa fa-angle-double-right', 'aria-hidden': 'true' })
                )
            ),
            _react2.default.createElement(
                'td',
                null,
                _react2.default.createElement(_receipt2.default, { booking: props.booking })
            )
        ),
        _react2.default.createElement(
            'tr',
            { style: { display: 'none' } },
            _react2.default.createElement(
                'td',
                { colSpan: '11' },
                _react2.default.createElement(ReceiptDetails, { booking: props.booking })
            )
        )
    );
};

var ReceiptDetails = function ReceiptDetails(props) {
    return _react2.default.createElement(
        'table',
        { style: { width: '100%', padding: '30px' }, className: 'tableSlideOpen' },
        _react2.default.createElement(
            'tbody',
            null,
            _react2.default.createElement(RideDetails, { ride: props.booking.Ride }),
            _react2.default.createElement(
                'tr',
                null,
                _react2.default.createElement(
                    'td',
                    { colSpan: '2' },
                    _react2.default.createElement(
                        'strong',
                        null,
                        'Toll Fees'
                    )
                ),
                _react2.default.createElement(
                    'td',
                    { colSpan: '1' },
                    _react2.default.createElement(
                        'strong',
                        null,
                        _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                        props.booking.Ride.TotalAmount
                    )
                )
            ),
            _react2.default.createElement(
                'tr',
                null,
                _react2.default.createElement(
                    'td',
                    null,
                    _react2.default.createElement(
                        'strong',
                        null,
                        'Vehicles'
                    )
                ),
                _react2.default.createElement(
                    'td',
                    null,
                    _react2.default.createElement(
                        'strong',
                        null,
                        'Vehicle Reference No'
                    )
                ),
                _react2.default.createElement(
                    'td',
                    null,
                    _react2.default.createElement(
                        'strong',
                        null,
                        'Fare'
                    )
                )
            ),
            props.booking.VehicleBookings.map(function (vehicle) {
                return _react2.default.createElement(
                    'tr',
                    { key: vehicle.RegistrationNumber },
                    _react2.default.createElement(
                        'td',
                        null,
                        vehicle.RegistrationNumber
                    ),
                    _react2.default.createElement(
                        'td',
                        null,
                        vehicle.BookingId ? vehicle.BookingId : ''
                    ),
                    _react2.default.createElement(
                        'td',
                        null,
                        _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                        vehicle.TotalAmount
                    )
                );
            }),
            _react2.default.createElement(TaxCalculations, { transaction: props.booking.Transaction }),
            _react2.default.createElement(
                'tr',
                null,
                _react2.default.createElement(
                    'td',
                    { colSpan: '2' },
                    _react2.default.createElement(
                        'strong',
                        null,
                        'Amount Payable'
                    )
                ),
                _react2.default.createElement(
                    'td',
                    { colSpan: '1' },
                    _react2.default.createElement(
                        'strong',
                        null,
                        _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                        props.booking.Transaction.Amount
                    )
                )
            )
        )
    );
};

var RideDetails = function RideDetails(props) {
    if (props.ride.BookingType === 'route-specific') {
        var i = 0;
        return props.ride.AssociateRides.map(function (aride) {
            return _react2.default.createElement(
                _react.Fragment,
                { key: aride.AssociateRideId },
                _react2.default.createElement(
                    'tr',
                    null,
                    _react2.default.createElement(
                        'td',
                        { colSpan: '3' },
                        _react2.default.createElement(
                            'span',
                            { className: 'arideTitle' },
                            _react2.default.createElement(
                                'strong',
                                null,
                                aride.Source_Name,
                                '-',
                                aride.Destination_Name
                            )
                        )
                    )
                ),
                aride.Tolls.map(function (toll) {
                    return _react2.default.createElement(
                        'tr',
                        { key: toll.TollId },
                        _react2.default.createElement(
                            'td',
                            { colSpan: '2' },
                            _react2.default.createElement(
                                'span',
                                { className: 'srNo' },
                                ++i,
                                '.'
                            ),
                            toll.Name
                        ),
                        _react2.default.createElement(
                            'td',
                            { colSpan: '1' },
                            _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                            toll.TollFare
                        )
                    );
                })
            );
        });
    } else {
        var tollname = props.ride.AssociateRides[0].Tolls[0].Name;
        var tripType = (0, _helper.getTripTypeTitle)(props.ride.TripTypeId);
        var _i = 0;
        return _react2.default.createElement(
            _react.Fragment,
            null,
            _react2.default.createElement(
                'tr',
                null,
                _react2.default.createElement(
                    'td',
                    { colSpan: '3', className: 'arideTitle' },
                    _react2.default.createElement(
                        'strong',
                        null,
                        tollname
                    )
                )
            ),
            props.ride.AssociateRides.map(function (aride) {
                return _react2.default.createElement(
                    'tr',
                    { key: aride.AssociateRideId },
                    _react2.default.createElement(
                        'td',
                        { colSpan: '2' },
                        _react2.default.createElement(
                            'span',
                            { className: 'srNo' },
                            ++_i,
                            '.'
                        ),
                        tripType
                    ),
                    _react2.default.createElement(
                        'td',
                        { colSpan: '1' },
                        _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                        aride.Tolls[0].TollFare
                    )
                );
            })
        );
    }
};

var TaxCalculations = function TaxCalculations(props) {

    return _react2.default.createElement(
        _react.Fragment,
        null,
        _react2.default.createElement(
            'tr',
            null,
            _react2.default.createElement(
                'td',
                { colSpan: '2' },
                '(a). Toll Fees'
            ),
            _react2.default.createElement(
                'td',
                { colSpan: '1' },
                props.transaction.TollAmount
            )
        ),
        _react2.default.createElement(
            'tr',
            { rowSpan: '2' },
            _react2.default.createElement(
                'td',
                { colSpan: '2' },
                _react2.default.createElement(
                    'div',
                    { className: 'flex' },
                    '(b). Booking Fee @ ',
                    props.transaction.ConvenienceChargesTaxValue,
                    '%'
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'flex' },
                    'Integrated GST @ ',
                    props.transaction.GSTTaxValue,
                    '%'
                )
            ),
            _react2.default.createElement(
                'td',
                { colSpan: '1' },
                _react2.default.createElement(
                    'div',
                    { className: 'flex' },
                    _react2.default.createElement(
                        'span',
                        null,
                        _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                        props.transaction.ConvenienceCharges
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'flex' },
                    _react2.default.createElement(
                        'span',
                        null,
                        _react2.default.createElement('i', { className: 'fa fa-inr', 'aria-hidden': 'true' }),
                        props.transaction.GST
                    )
                )
            )
        )
    );
};

var TableHeading = exports.TableHeading = function TableHeading() {
    return _react2.default.createElement(
        'tr',
        null,
        _react2.default.createElement(
            'th',
            null,
            'S.NO.'
        ),
        _react2.default.createElement(
            'th',
            null,
            'DATE'
        ),
        _react2.default.createElement(
            'th',
            null,
            'INVOICE'
        ),
        _react2.default.createElement(
            'th',
            null,
            'CLASS'
        ),
        _react2.default.createElement(
            'th',
            null,
            'TICKET'
        ),
        _react2.default.createElement(
            'th',
            null,
            'BOOKING'
        ),
        _react2.default.createElement(
            'th',
            null,
            'VECHILE(S)'
        ),
        _react2.default.createElement(
            'th',
            null,
            'TOLLS'
        ),
        _react2.default.createElement(
            'th',
            null,
            'TOTAL'
        ),
        _react2.default.createElement(
            'th',
            null,
            'VIEW'
        ),
        _react2.default.createElement(
            'th',
            null,
            'DOWNLOAD'
        )
    );
};

/***/ }),

/***/ 794:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(795);
if(typeof content === 'string') content = [[module.i, content, '']];
// Prepare cssTransformation
var transform;

var options = {}
options.transform = transform
// add the styles to the DOM
var update = __webpack_require__(65)(content, options);
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!./booking.css", function() {
			var newContent = require("!!../../../../../../node_modules/css-loader/index.js!./booking.css");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 795:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(64)(false);
// imports


// module
exports.push([module.i, ".tableSlideOpen {\n    -webkit-transition: width 2s; /* For Safari 3.1 to 6.0 */\n    transition: width 2s;\n}\n\n.arideTitle{\n    font-size: 12px;\n}\n\n.srNo{\n    margin-left: 2px;\n    margin-right: 4px;\n}\n.flex{\n    display: flex;\n    justify-content: space-between;\n}", ""]);

// exports


/***/ }),

/***/ 796:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _baseService = __webpack_require__(101);

var _baseService2 = _interopRequireDefault(_baseService);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var GetBookings = function (_BaseService) {
    _inherits(GetBookings, _BaseService);

    function GetBookings() {
        var _ref;

        var _temp, _this, _ret;

        _classCallCheck(this, GetBookings);

        for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
            args[_key] = arguments[_key];
        }

        return _ret = (_temp = (_this = _possibleConstructorReturn(this, (_ref = GetBookings.__proto__ || Object.getPrototypeOf(GetBookings)).call.apply(_ref, [this].concat(args))), _this), _this.requestStr = function () {
            return [];
        }, _this.makeRequest = function (page) {
            _this.api.get('getBookings', { params: { page: page } }).then(function (res) {
                _this.mainObj.setState({ bookings: res.data.response });
            }).catch(function (err) {
                return console.log(err);
            });
        }, _temp), _possibleConstructorReturn(_this, _ret);
    }

    return GetBookings;
}(_baseService2.default);

exports.default = GetBookings;

/***/ })

});