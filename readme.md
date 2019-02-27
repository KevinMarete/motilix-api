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
- /api/v1/order/<id>/logs --GET|POST|PUT|DELETE
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