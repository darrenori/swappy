# Working on the code

Runs under XAMPP, no build step. Edit a .php file and refresh.

Adding a page:

1. Write the .php file in the folder for its feature.
2. Register a GET route for it in index.php.
3. If it has a form, write the handler as an .inc.php next to it and register a POST route.
4. If it needs a login, include authorization.inc.php and add the URL to the right list in
   auth/pages.php.

Conventions: procedural PHP, prepared statements for anything with user input,
htmlspecialchars on output, shared helpers in includes/ rather than copy pasted. The
includes/security, includes/helpers, includes/validate and includes/db folders hold the
reusable library. There's no automated framework test; the standalone scripts in tests/ run
with plain php.
