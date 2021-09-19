A simple link shortener on pure PHP.<br>
Version 1.0<br><br>

- PHP must have PDO_MYSQL PHP extension.<br>
- The config.php & /logs dir must not be in git repo. I did it for clarity.<br>
- The config.php must not be in /public directory for security reasons.<br>
- You can find a small promo video about shortener works in /Video dir.<br>
- I spended a bit more of 3 hours for this project.<br><br>

Any questions let me know vgolovko2017@gmail.com<br>
Thanks.<br><br>

Dev/Test environment which I used below:<br>
	Xubuntu 18.04 (64-bit)<br>
	Apache/2.4.29<br>
	PHP 7.4.23<br>
	MySQL 5.7.35<br>
	PhpStorm 2019.2<br><br>

Third party packages are used in project:<br>
	bootstrap 4.6.0<br>
	jquery 3.5.1<br><br>

Tested in next browsers:<br>
	Chrome 93.0.4577.82 (Official Build) (64-bit)<br>
	FireFox 92.0 (64-bit)<br><br>

MySql command for table creation:<br>
	CREATE TABLE short_urls (<br>
		id MEDIUMINT NOT NULL AUTO_INCREMENT,<br>
		original_url VARCHAR(2048) NOT NULL,<br>
		short_url_id VARCHAR(32) NOT NULL,<br>
		ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,<br>
		PRIMARY KEY (id)<br>
	);<br><br>

Config for virtual host (apache2 version):<br>
	<VirtualHost *:80><br>
	    ServerAdmin admin@example.com<br>
	    ServerName smartylab-test.local<br>
	    ServerAlias www.smartylab-test.local<br>
	    DocumentRoot /var/www/html/smartylab-test.local/public<br>
	    <Directory /var/www/html/smartylab-test.local/public><br>
	        Options Indexes FollowSymLinks MultiViews<br>
	        AllowOverride All<br>
	        Require all granted<br>
	    </Directory><br>
	    ErrorLog ${APACHE_LOG_DIR}/error.log<br>
	    CustomLog ${APACHE_LOG_DIR}/access.log combined<br>
	</VirtualHost><br>
<br>
