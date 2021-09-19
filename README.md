A simple link shortener on pure PHP.
Version 1.0

- PHP must have PDO_MYSQL PHP extension.
- The config.php & /logs dir must not be in git repo. I did it for clarity.
- The config.php must not be in /public directory for security reasons.
- You can find a small promo video about shortener works in /Video dir.
- I spended a bit more of 3 hours for this project.

Any questions let me know vgolovko2017@gmail.com
Thanks.

Dev/Test environment which I used below:
	Xubuntu 18.04 (64-bit)
	Apache/2.4.29
	PHP 7.4.23
	MySQL 5.7.35
	PhpStorm 2019.2

Third party packages are used in project:
	bootstrap 4.6.0
	jquery 3.5.1

Tested in next browsers:
	Chrome 93.0.4577.82 (Official Build) (64-bit)
	FireFox 92.0 (64-bit)

MySql command for table creation:
	CREATE TABLE short_urls (
		id MEDIUMINT NOT NULL AUTO_INCREMENT,
		original_url VARCHAR(2048) NOT NULL,
		short_url_id VARCHAR(32) NOT NULL,
		ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id)
	);

Config for virtual host (apache2 version):
	<VirtualHost *:80>
	    ServerAdmin admin@example.com
	    ServerName smartylab-test.local
	    ServerAlias www.smartylab-test.local
	    DocumentRoot /var/www/html/smartylab-test.local/public
	    <Directory /var/www/html/smartylab-test.local/public>
	        Options Indexes FollowSymLinks MultiViews
	        AllowOverride All
	        Require all granted
	    </Directory>
	    ErrorLog ${APACHE_LOG_DIR}/error.log
	    CustomLog ${APACHE_LOG_DIR}/access.log combined
	</VirtualHost>

