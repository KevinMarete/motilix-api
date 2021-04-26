## Motilix-API

This is the core API for Motilix Web and Mobile Apps

###Available endpoints

- /api/v1/unauthorized --GET
- /api/v1/register --POST
- /api/v1/activateaccountemail --POST
- /api/v1/activate --POST
- /api/v1/login --POST
- /api/v1/forgotpasswordemail --POST
- /api/v1/resetpassword --POST
- /api/v1/changepassword --POST
- /api/v1/profile --GET|PUT
- /api/v1/logout --POST
- /api/v1/activateaccountcode --GET
- /api/v1/verifyaccountcode --POST
- /api/v1/user/<id>/orders --GET
- /api/v1/user/<id>/cards --GET
- /api/v1/user/<id>/devices --GET
- /api/v1/role --GET|POST|PUT|DELETE
- /api/v1/vehicle --GET|POST|PUT|DELETE
- /api/v1/vehicle/<id>/models --GET
- /api/v1/vehiclemodel --GET|POST|PUT|DELETE
- /api/v1/vehiclemodel/<id>/orders --GET
- /api/v1/brand --GET|POST|PUT|DELETE
- /api/v1/brand/<id>/devices --GET
- /api/v1/device --GET|POST|PUT|DELETE
- /api/v1/order --GET|POST|PUT|DELETE
- /api/v1/order/<id>/logs --GET
- /api/v1/order/<id>/logs/<id>/user --GET
- /api/v1/orderlog --GET|POST|PUT|DELETE
- /api/v1/card --GET|POST|PUT|DELETE
- /api/v1/payment --GET|POST|PUT|DELETE
- /api/v1/device/<id>/payments --GET
- /api/v1/card/<id>/payments --GET
- /api/v1/installation --GET|POST|PUT|DELETE
- /api/v1/subscription --GET|POST|PUT|DELETE
- /api/v1/invoice --GET|POST|PUT|DELETE
- /api/v1/refund --GET|POST|PUT|DELETE
- /api/v1/refund/<id>/payments --GET
- /api/v1/vehicledevice --GET|POST|PUT|DELETE
- /api/v1/vehicledevice/<id>/logs --GET
- /api/v1/vehicledevice/<id>/logs/<id>/user --GET
- /api/v1/vehicledevicelog --GET|POST|PUT|DELETE
- /api/v1/trip --GET
- /api/v1/devicetrips --POST
- /api/v1/health --GET
- /api/v1/trip/<id>/health --GET
- /api/v1/alert --GET
- /api/v1/trip/<id>/alerts --GET
- /api/v1/centre --GET|POST|PUT|DELETE
- /api/v1/service --GET|POST|PUT|DELETE
- /api/v1/servicehistory/<device> --GET
- /api/v1/notification --GET|POST|PUT|DELETE
- /api/v1/user/<id>/notification --GET
- /api/v1/pricing --GET|POST|PUT|DELETE

###Passport Issue 
- https://stackoverflow.com/questions/39414956/laravel-passport-key-path-oauth-public-key-does-not-exist-or-is-not-readable