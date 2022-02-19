<?php

// Central place for the limits and whitelists the rest of the app checks against.

define('MAX_USERNAME_LEN', 30);
define('MAX_EMAIL_LEN', 254);
define('MAX_NAME_LEN', 60);
define('MAX_REVIEW_LEN', 1000);
define('MIN_PASSWORD_LEN', 8);

define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('MAX_UPLOAD_BYTES', 2 * 1024 * 1024); // 2 MB

define('LOGIN_MAX_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_SECONDS', 900); // 15 minutes
define('OTP_TTL_SECONDS', 300);       // 5 minutes
