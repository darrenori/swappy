# SWAP (swappy)

SWAP is a campus marketplace we built from scratch for our second year project at Temasek
Poly. Students and staff can buy and sell things, and managers get a back office to run the
stores, track stock, hand out tasks and keep an eye on staff attendance.

It's plain PHP on MySQL, served through Apache (XAMPP). No framework. We wrote the router,
the login, the session handling and the security layer ourselves, since the point of the
module was to understand that rather than let a framework hide it.

## What it runs on

- PHP 7.4+, mostly procedural
- MySQL / MariaDB through XAMPP (ours is on port 3307)
- Apache with mod_rewrite, everything goes through index.php
- Composer: firebase/php-jwt, lablnet/encryption,
  sonata-project/google-authenticator, PHPMailer

## Layout

- index.php, router/       every route is registered and dispatched here
- authorization.inc.php    per route access control
- includes/                db connection, auth and the helper library (see below)
- includes/security/       session, headers, csp, rate limiting, uploads, audit
- includes/helpers/        formatting, text, pagination, http
- includes/validate/       reusable input validators
- includes/db/             prepared-statement query helpers
- product/, store/, checkoutpage/, prodmanager/, storemanager/, manager/,
  attendancepage/, reviews/, admin/   the features
- mydb.sql                 schema and seed data
- docs/                    the rest of the write ups

## Getting it running

See docs/INSTALL.md. Drop it into your web root as swapproj, composer install in the root,
api/ and googleauth/, import mydb.sql into a database called mydb, create
includes/dbh.inc.php, do the HTTPS setup, then open https://www.swapamc.com/swapproj/.

Contact 2004217B@student.tp.edu.sg. All rights reserved.

## Documentation

- docs/INSTALL.md, setup
- docs/SECURITY.md, the security model and the security library
- docs/ARCHITECTURE.md, how a request flows
- docs/ROUTES.md, the routes
- docs/DATABASE.md, the schema
- docs/DEVELOPMENT.md, working on the code
- docs/FAQ.md, quick answers

Built 2022 at Temasek Polytechnic. Reference project, not maintained. All rights reserved.
