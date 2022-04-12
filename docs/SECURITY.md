# Security

Where the project spent its time. The core app does the standard things: bcrypt password
hashing, prepared statements on every query with user input, htmlspecialchars on output,
CSRF tokens, an encrypted JWT session refreshed each request, email OTP, Google
Authenticator TOTP, reCAPTCHA, per route authorization and an admin log.

On top of that the includes/security library adds:

- session.php   hardened session cookies (HttpOnly, Secure, SameSite) and id rotation
- headers.php   security headers sent from PHP as well as .htaccess
- csp.php       a Content-Security-Policy builder
- tokens.php    random tokens and constant-time comparison
- ratelimit.php login attempt throttling with a lockout window
- honeypot.php  a hidden field to catch form bots
- upload.php    real MIME and size checks on uploaded images, plus filename cleaning
- audit.php     a single place to append audit log lines

Include includes/bootstrap.php at the top of a page to turn the session hardening, headers
and error handling on in one line.
