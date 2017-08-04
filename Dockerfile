FROM alpine:3.6

LABEL description "Containerized Simple PHP Contact Form" \
      maintainer="Kayvan Sylvan <kayvansylvan@gmail.com>"

ENV UID=991 GID=991

RUN echo "@community https://nl.alpinelinux.org/alpine/v3.6/community" >> /etc/apk/repositories \
 && apk -U upgrade \
 && apk add -t build-dependencies \
    gnupg \
    openssl \
    wget \
 && apk add \
    ca-certificates \
    nginx \
    ssmtp \
    s6 \
    su-exec \
    php7-fpm@community \
    php7-curl@community \
    php7-iconv@community \
    php7-xml@community \
    php7-dom@community \
    php7-openssl@community \
    php7-json@community \
    php7-zlib@community \
    php7-pdo_mysql@community \
    php7-pdo_sqlite@community \
    php7-sqlite3@community \
    php7-ldap@community \
    php7-simplexml@community \
 && cd /tmp \
 && apk del build-dependencies \
 && rm -rf /tmp/* /var/cache/apk/* /root/.gnupg \
 && echo 'webform:x:991:991:Web Form:/tmp:/sbin/nologin' >> /etc/passwd
# The passwd hack above is for ssmtpd to function

COPY nginx.conf /etc/nginx/nginx.conf
COPY php-fpm.conf /etc/php7/php-fpm.conf
COPY s6.d /etc/s6.d
COPY run.sh /usr/local/bin/run.sh
COPY contact-form /contact

RUN chmod +x /usr/local/bin/run.sh /etc/s6.d/*/* /etc/s6.d/.s6-svscan/*

VOLUME /contact/config
VOLUME /etc/ssmtp

EXPOSE 8888

CMD ["run.sh"]
