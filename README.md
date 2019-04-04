<h1><a id="vine__wordpress_theme_0"></a>vine - wordpress theme</h1>
<p>There are two methods:<br>
First:</p>
<ol>
<li>Download branch <br>
a) git remote add origin https://github.com/BartoszBury/vine.git
</li>
<li>Open download directory and:<br>
a) npm install<br>
b) Open gulpfile.js and setup proxy. Default &quot;<a href="http://localhost">http://localhost</a>&quot;<br>
c) npm start
</li>
</ol>
<p>Second used Docker. Below is<br>
docker-composer.yml:</p>
<pre>
version: '2'
services:
    wordpress:
        image: wordpress
        links:
            - db:mysql
        ports:
            - 80:80
        domainname: localhost
        hostname: localhost
        volumes:
            - ./wp-content:/var/www/html/wp-content
        environment:
            WORDPRESS_DB_PASSWORD: docker
        depends_on:
            - db
    db:
        image: mysql:5.7
        ports:
            - 3306:3306
        environment:
            MYSQL_ROOT_PASSWORD: docker

</pre># inven
