# Installing SWAP

Built and run on Windows with XAMPP.

1. Put the project in your web root as `C:\xampp\htdocs\swapproj\`. The name matters, it's
   hardcoded in config/__init.php and the .htaccess rewrite base.
2. `composer install` in the root, then in `api/`, then in `googleauth/`.
3. Start Apache and MySQL. mod_rewrite must be on. Our MySQL is on 3307; change the port in
   includes/dbh.inc.php if yours differs.
4. Make a database called `mydb` in phpMyAdmin and import `mydb.sql`.
5. Create includes/dbh.inc.php with your DB login (it's gitignored). There's a second
   gitignored file, product/includes/checkproduct.inc.php, that the stock check needs.
6. Set up HTTPS and the swapamc.com host from SSLDOCUMENTATION/Group1.txt.
7. Open https://www.swapamc.com/swapproj/.

If every page 404s, mod_rewrite is off. If you get a DB error, recheck the port and
password. If the Google Authenticator code is rejected, sync your machine and phone clocks.
