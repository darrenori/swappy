# FAQ

**Why plain PHP and not a framework?**
Security module. We wanted to write the auth and request handling ourselves.

**Why MySQL on 3307?**
That's how our XAMPP was set up. Change the port in includes/dbh.inc.php.

**Every page 404s.**
mod_rewrite is off, or the app isn't in a folder called swapproj.

**Login won't take my code.**
The Google Authenticator code is time based; sync your machine and phone clocks.

**Where are the DB credentials?**
includes/dbh.inc.php, which is gitignored. You create it, see docs/INSTALL.md.

**Can I use this for my own thing?**
Ask first. 2004217B@student.tp.edu.sg. All rights reserved.
