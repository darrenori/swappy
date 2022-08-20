# How it fits together

Apache rewrites every URL to index.php (the .htaccess rule). index.php loads the config,
builds the Router, and registers every route. The Router matches the method and path and
includes the file for that route. So a URL maps to a line in index.php, not to a file at
that path.

Pages that need a login pull in authorization.inc.php, which decrypts the JWT, regenerates
it, reads the user out, and runs checkAuthorization on the current URL. Wrong user type for
that URL and you get bounced to logout.

The includes/ folder holds the db connection, the auth and helper functions, and the
security/helpers/validate/db library added on top. A page is a .php file; the logic behind
a form usually sits next to it as a something.inc.php and the page POSTs to a route that
maps to it.
