############################################################
# Dockerfile to build RStudio container image for the eBioKit
# Based on rocker/rstudio-stable
############################################################

# Set the base image to wurmlab/sequenceserver
FROM rocker/rstudio-stable:3.4.1

# File Author / Maintainer
MAINTAINER Rafael Hernandez <ebiokit@gmail.com>

################## BEGIN INSTALLATION ######################
#Add the link to internal MRS service

COPY configs/index.html /var/www/html
COPY configs/admin.php /var/www/html
COPY configs/default /etc/nginx/sites-available/

RUN apt-get update \
    && apt-get -y install nginx php5-fpm

##################### INSTALLATION END #####################
