FROM jdecode/laravel-breeze-php8-pg-node:latest


### Note : Change the IP (in the command below) to match the one that is to be used in the project
### Since this is editable, so this is not in the docker image, rather configurable via Dockerfile(this)
### Disable following 3 sections if you do not need HTTPS URLs on local

# Create local SSL certificate (to allow HTTPS URLs on local)
RUN apt-get install -y ssl-cert
RUN openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 -subj  "/C=IN/ST=PB/L=MOH/O=FNL/CN=210.81.1.1" -keyout ./docker-ssl.key -out ./docker-ssl.pem -outform PEM
RUN mv docker-ssl.pem /etc/ssl/certs/ssl-cert-snakeoil.pem
RUN mv docker-ssl.key /etc/ssl/private/ssl-cert-snakeoil.key

# Setup Apache2 mod_ssl
RUN a2enmod ssl
# Setup Apache2 HTTPS env
RUN a2ensite default-ssl.conf

### Enable these based on your need
### Note : volume-mapping maps the current folder to the docker web root, so no need to copy files
### Since ENV VARs are setup in docker-compose.yml, so no need to have .env file
### .env.testing still might be required, depending on the configuration of phpunit.xml - enable it if needed

#COPY . /var/www/html
#RUN cp .env.example .env
#RUN cp .env.example .env.testing
