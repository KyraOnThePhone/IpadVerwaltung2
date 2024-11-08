FROM webdevops/php-apache

USER root

# Alte PHP-Version entfernen und das benötigte Repository hinzufügen
RUN apt-get update && \
    apt-get remove -y php* && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.2

# Bereinigen, um die Größe des Docker-Images zu verringern
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/*

