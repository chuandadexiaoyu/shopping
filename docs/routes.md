Project Routes
==============================

$ php artisan routes
URI                                      Name                    Action

GET /                                    home                    UsersController@getLogin
GET /accounts                            accounts.index          AccountsController@index
GET /accounts/create                     accounts.create         AccountsController@create
GET /accounts/{accounts}                 accounts.show           AccountsController@show
GET /accounts/{accounts}/edit            accounts.edit           AccountsController@edit
GET /cart_items                          cart_items.index        Cart_itemsController@index
GET /cart_items/create                   cart_items.create       Cart_itemsController@create
GET /cart_items/{cart_items}             cart_items.show         Cart_itemsController@show
GET /cart_items/{cart_items}/edit        cart_items.edit         Cart_itemsController@edit
GET /carts                               carts.index             CartsController@index
GET /carts/create                        carts.create            CartsController@create
GET /carts/{carts}                       carts.show              CartsController@show
GET /carts/{carts}/edit                  carts.edit              CartsController@edit
GET /item_vendors                        item_vendors.index      ItemVendorsController@index
GET /item_vendors/create                 item_vendors.create     ItemVendorsController@create
GET /item_vendors/{item_vendors}         item_vendors.show       ItemVendorsController@show
GET /item_vendors/{item_vendors}/edit    item_vendors.edit       ItemVendorsController@edit
GET /items                               items.index             ItemsController@index
GET /items/create                        items.create            ItemsController@create
GET /items/{items}                       items.show              ItemsController@show
GET /items/{items}/edit                  items.edit              ItemsController@edit
GET /items/{item}/carts                                          ItemsController@carts
GET /items/{item}/vendors                                        ItemsController@vendors
GET /user/login                          login                   UsersController@getLogin
GET /user/logout                         logout                  UsersController@getLogout
GET /users                               users.index             UsersController@index
GET /users/create                        users.create            UsersController@create
GET /users/{users}                       users.show              UsersController@show
GET /users/{users}/edit                  users.edit              UsersController@edit
GET /vendors                             vendors.index           VendorsController@index
GET /vendors/create                      vendors.create          VendorsController@create
GET /vendors/{vendors}                   vendors.show            VendorsController@show
GET /vendors/{vendors}/edit              vendors.edit            VendorsController@edit
PATCH /accounts/{accounts}                                       AccountsController@update
PATCH /cart_items/{cart_items}                                   Cart_itemsController@update
PATCH /carts/{carts}                                             CartsController@update
PATCH /item_vendors/{item_vendors}                               ItemVendorsController@update
PATCH /items/{items}                                             ItemsController@update
PATCH /users/{users}                                             UsersController@update
PATCH /vendors/{vendors}                                         VendorsController@update
POST /accounts                           accounts.store          AccountsController@store
POST /cart_items                         cart_items.store        Cart_itemsController@store
POST /carts                              carts.store             CartsController@store
POST /item_vendors                       item_vendors.store      ItemVendorsController@store
POST /items                              items.store             ItemsController@store
POST /user/login                                                 UsersController@postLogin
POST /users                              users.store             UsersController@store
POST /vendors                            vendors.store           VendorsController@store
PUT /accounts/{accounts}                 accounts.update         AccountsController@update
PUT /cart_items/{cart_items}             cart_items.update       Cart_itemsController@update
PUT /carts/{carts}                       carts.update            CartsController@update
PUT /item_vendors/{item_vendors}         item_vendors.update     ItemVendorsController@update
PUT /items/{items}                       items.update            ItemsController@update
PUT /users/{users}                       users.update            UsersController@update
PUT /vendors/{vendors}                   vendors.update          VendorsController@update
DELETE /accounts/{accounts}              accounts.destroy        AccountsController@destroy
DELETE /cart_items/{cart_items}          cart_items.destroy      Cart_itemsController@destroy
DELETE /carts/{carts}                    carts.destroy           CartsController@destroy
DELETE /item_vendors/{item_vendors}      item_vendors.destroy    ItemVendorsController@destroy
DELETE /items/{items}                    items.destroy           ItemsController@destroy
DELETE /users/{users}                    users.destroy           UsersController@destroy
DELETE /vendors/{vendors}                vendors.destroy         VendorsController@destroy
