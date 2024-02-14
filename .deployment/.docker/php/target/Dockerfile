ARG COMPOSER_IMAGE

FROM $COMPOSER_IMAGE

# Set working directory
WORKDIR /app

# Copy sources
COPY --chown=www-data:www-data . .

# Cope env
RUN mv .env.example .env

# Discover packages
RUN php artisan package:discover

# Copy docker-entrypoint.sh
COPY .deployment/.scripts/docker-entrypoint.sh .
RUN chmod +x ./docker-entrypoint.sh

EXPOSE 9000
STOPSIGNAL SIGQUIT

ENTRYPOINT ["./docker-entrypoint.sh"]
CMD ["php-fpm"]
