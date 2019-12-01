# Getting the base image
FROM httpd:alpine

# Copying the source file
COPY ./src/ /usr/local/apache2/htdocs/
