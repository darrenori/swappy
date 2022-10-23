# Routes

Every route is registered in index.php. GET renders a page, POST usually points at an
include that does the work and redirects. A readable map:

- Auth: /login, /logininc, /signup, /incsignup, /emailverification, /googleauthentication,
  /check, /logout
- Storefront: /campus, /allstores, /allstores/store, /allproducts, /allproducts/product,
  /search, /sortinc, /home, /faq
- Cart and checkout: /allproducts/product/addtocart, .../viewcart, .../editcart,
  /checkquantity, /checkout, /checkoutinc, /checkout/emailotp, /checkout/success, and the
  shipping address routes under /checkout/
- Back office: /employeemanager, /employeemanager/taskmanager, /productmanager,
  /storemanageradd, /storemanager/editstore, /attendance, /adminlogs, /downloadlogs
- Reviews and misc: /addreview, /editreview, /replyreview, /likeordislike,
  /viewnotifications, /image, and the /forgetpassword routes
