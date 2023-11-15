<?php

// Optional front controller bootstrap. Include this at the very top of a page to turn on
// the hardened session, security headers, CSP and error handler in one line. Kept separate
// so it can be adopted page by page without touching the router.

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/security/session.php';
require_once __DIR__ . '/security/headers.php';
require_once __DIR__ . '/security/csp.php';
require_once __DIR__ . '/errors/handler.php';

hardenSession();
sendSecurityHeaders();
sendCsp();
registerErrorHandler();
