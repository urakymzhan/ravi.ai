# Rav.ai Landing Page 

### Development: 
-  run php code locally: php -S 127.0.0.1:<port>
- Make sure you have MySQL running on localhost with proper credentials (username and password)
- You can export database from CPANEL and dump it to your local MySQL Database:
    1. Export 
    2.`use DATABASE_NAME;`  (ex: ravakilla_waitlist)
    3. `source path/to/file.sql;`
- Follow for [Mac instructions](https://flaviocopes.com/mysql-how-to-install/)
    - `brew services start mysql`
    - `mysql -u <username> -p` (ex: raxxxxxx_xxxxx)
    - Enter password: (ex: plxxxxxxxxxx.xx)


### Composer Package Manager
- Check out packeges: https://packagist.org/
- Check out CLI: https://getcomposer.org/doc/03-cli.md
- Ex: `composer init` , `composer install`, `composer require <package>` etc
- All dependencies located inside **/vendor** folder
- `composer dump-outload -o` created `autoload.php` file inside **vendor** folder. This allows us to use things like this: `require 'vendor/autoload.php';`

### Delpoyment Setup in Cpanel
- Check out their [docs](https://docs.cpanel.net/knowledge-base/web-services/guide-to-git-how-to-set-up-deployment/)
- Currently using push deployment approach.

### Admin Dashboard
- Located inside **/admin** folder
- `php -S 127.0.0.1:<port>`
- Login as admin
