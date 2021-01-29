FROM jperat/symfony-php-apache:7.4

EXPOSE 80

COPY . /var/www/html/
WORKDIR /var/www/html
RUN composer install
RUN npm install
RUN ./node_modules/.bin/encore production
CMD ["sh", "-c","make migrate;apache2-foreground"]
