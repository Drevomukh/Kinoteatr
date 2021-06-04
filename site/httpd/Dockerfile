FROM httpd
RUN sed -i 's/AllowOverride None/AllowOverride All/' /usr/local/apache2/conf/httpd.conf
RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

RUN sed -i '/LoadModule proxy_module modules\/mod_proxy.so/s/^#//g' /usr/local/apache2/conf/httpd.conf
RUN sed -i '/LoadModule proxy_fcgi_module modules/mod_proxy_fcgi.so/s/^#//g' /usr/local/apache2/conf/httpd.conf