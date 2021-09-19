<b>A simple link shortener on pure PHP.</b><br>
Version 1.0<br>

- PHP must have PDO_MYSQL PHP extension.<br>
- The config.php & /logs dir must not be in git repo. I did it for clarity.<br>
- The config.php must not be in /public directory for security reasons.<br>
- You can find a small promo video about shortener works in /Video dir.<br>
- I spended a bit more of 3 hours for this project.<br>

Any questions let me know vgolovko2017@gmail.com<br>
Thanks.<br>

<b>Dev/Test environment which I used below:</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;        Xubuntu 18.04 (64-bit)<br>
&nbsp;&nbsp;&nbsp;&nbsp;        Apache/2.4.29<br>
&nbsp;&nbsp;&nbsp;&nbsp;        PHP 7.4.23<br>
&nbsp;&nbsp;&nbsp;&nbsp;        MySQL 5.7.35<br>
&nbsp;&nbsp;&nbsp;&nbsp;        PhpStorm 2019.2<br>

<b>Third party packages are used in project:</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;        bootstrap 4.6.0<br>
&nbsp;&nbsp;&nbsp;&nbsp;        jquery 3.5.1<br>

<b>Tested in next browsers:</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;        Chrome 93.0.4577.82 (Official Build) (64-bit)<br>
&nbsp;&nbsp;&nbsp;&nbsp;        FireFox 92.0 (64-bit)<br>

<b>MySql command for table creation:</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;        CREATE TABLE short_urls (<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                id MEDIUMINT NOT NULL AUTO_INCREMENT,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                original_url VARCHAR(2048) NOT NULL,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                short_url_id VARCHAR(32) NOT NULL,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                PRIMARY KEY (id)<br>
&nbsp;&nbsp;&nbsp;&nbsp;        );<br>

<b>Config for virtual host (apache2 version):</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;        <VirtualHost *:80><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            ServerAdmin admin@example.com<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            ServerName smartylab-test.local<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            ServerAlias www.smartylab-test.local<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            DocumentRoot /var/www/html/smartylab-test.local/public<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            <Directory /var/www/html/smartylab-test.local/public><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                Options Indexes FollowSymLinks MultiViews<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                AllowOverride All<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                Require all granted<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            <\/Directory><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            ErrorLog ${APACHE_LOG_DIR}/error.log<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            CustomLog ${APACHE_LOG_DIR}/access.log combined<br>
&nbsp;&nbsp;&nbsp;&nbsp;        <\/VirtualHost><br>
