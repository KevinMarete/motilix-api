Instructions
-------------
--Setting up project
composer create-project --prefer-dist laravel/laravel motilix-api
Rename .env.exaample to .env
Configure database connection on the .env file
php artisan key:generate

--Auth using passport at this link => https://medium.com/@martin.riedweg/laravel-5-7-api-authentification-with-laravel-passport-92b909e12528
composer require laravel/passport
php artisan passport:install
php artisan make:controller Auth/AuthController.php
use Laravel\Passport\Passport --in AuthServiceProvider.php
php artisan make:middleware ForceJsonResponse
composer require guzzlehttp/guzzle --for emails
php artisan make:mail ActivateAccountEmail

Migrations
-----------
php artisan make:migration create_table_tbl_role --create=tbl_role
php artisan make:migration create_table_tbl_user --create=tbl_user
php artisan make:migration create_table_tbl_vehicle --create=tbl_vehicle
php artisan make:migration create_table_tbl_vehicle_model --create=tbl_vehicle_model
php artisan make:migration create_table_tbl_brand --create=tbl_brand
php artisan make:migration create_table_tbl_device --create=tbl_device
php artisan make:migration create_table_tbl_order --create=tbl_order
php artisan make:migration create_table_tbl_order_log --create=tbl_order_log
php artisan make:migration create_table_tbl_card --create=tbl_card
php artisan make:migration create_table_tbl_payment --create=tbl_payment
php artisan make:migration create_table_tbl_payment_installation --create=tbl_payment_installation
php artisan make:migration create_table_tbl_payment_subscription --create=tbl_payment_subscription
php artisan make:migration create_table_tbl_invoice --create=tbl_invoice
php artisan make:migration create_table_tbl_refund --create=tbl_refund
php artisan make:migration create_table_tbl_vehicle_device --create=tbl_vehicle_device

php artisan migrate -(To execute migration)
php artisan migrate:rollback -(Incase of rollback)

Models
-------
php artisan make:model User
php artisan make:model Role
php artisan make:model Vehicle
php artisan make:model VehicleModel
php artisan make:model Brand
php artisan make:model Device
php artisan make:model Order
php artisan make:model OrderLog
php artisan make:model Card
php artisan make:model Payment
php artisan make:model Installation
php artisan make:model Subscription
php artisan make:model Invoice
php artisan make:model Refund
php artisan make:model VehicleDevice
php artisan make:model Trip
php artisan make:model Health
php artisan make:model Alert

Controllers & Resources
------------------------
php artisan make:controller UserController --resource
php artisan make:controller RoleController --resource
php artisan make:controller VehicleController --resource
php artisan make:controller VehicleModelController --resource
php artisan make:controller BrandController --resource
php artisan make:controller DeviceController --resource
php artisan make:controller OrderController --resource
php artisan make:controller OrderLogController --resource
php artisan make:controller CardController --resource
php artisan make:controller PaymentController --resource
php artisan make:controller InstallationController --resource
php artisan make:controller SubscriptionController --resource
php artisan make:controller InvoiceController --resource
php artisan make:controller RefundController --resource
php artisan make:controller VehicleDeviceController --resource
php artisan make:controller TripController --resource
php artisan make:controller HealthController --resource
php artisan make:controller AlertController --resource

Endpoints
-------------
/api/v1/unauthorized --GET
/api/v1/register --POST
/api/v1/activateaccountemail --POST
/api/v1/activate --POST
/api/v1/login --POST
/api/v1/forgotpasswordemail --POST
/api/v1/resetpassword --POST
/api/v1/changepassword --POST
/api/v1/profile --GET|PUT
/api/v1/logout --POST
/api/v1/user/<id>/orders --GET
/api/v1/user/<id>/cards --GET
/api/v1/user/<id>/devices --GET
/api/v1/role --GET|POST|PUT|DELETE
/api/v1/vehicle --GET|POST|PUT|DELETE
/api/v1/vehicle/<id>/models --GET
/api/v1/vehiclemodel --GET|POST|PUT|DELETE
/api/v1/vehiclemodel/<id>/orders --GET
/api/v1/brand --GET|POST|PUT|DELETE
/api/v1/brand/<id>/devices --GET
/api/v1/device --GET|POST|PUT|DELETE
/api/v1/order --GET|POST|PUT|DELETE
/api/v1/order/<id>/logs --GET
/api/v1/order/<id>/logs/<id>/user --GET
/api/v1/orderlog --GET|POST|PUT|DELETE
/api/v1/card --GET|POST|PUT|DELETE
/api/v1/payment --GET|POST|PUT|DELETE
/api/v1/device/<id>/payments --GET
/api/v1/card/<id>/payments --GET
/api/v1/installation --GET|POST|PUT|DELETE
/api/v1/subscription --GET|POST|PUT|DELETE
/api/v1/invoice --GET|POST|PUT|DELETE
/api/v1/refund --GET|POST|PUT|DELETE
/api/v1/refund/<id>/payments --GET
/api/v1/vehicledevice --GET|POST|PUT|DELETE
/api/v1/trip --GET
/api/v1/devicetrips --POST
/api/v1/health --GET
/api/v1/trip/<id>/health --GET
/api/v1/alert --GET
/api/v1/trip/<id>/alerts --GET