FROM kibatic/symfony:8.2 as base

RUN apt-get -qqq update && DEBIAN_FRONTEND=noninteractive apt-get install -qqq -y \
        vim make openssl curl git gnupg2 \
        build-essential xorg libssl-dev libxrender-dev \
        php8.2-curl \
        php8.2-gd \
        php8.2-zip \
        php8.2-soap \
        php8.2-xml \
        php8.2-pgsql && \
        apt-get clean && \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# NodeJs
RUN apt-get -qqq update && apt-get install -qqq -y gnupg2 && \
    curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    DEBIAN_FRONTEND=noninteractive apt-get install -qqq -y nodejs && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Yarn
RUN  curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
     echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
     apt-get -qqq update && apt-get install -qqq -y yarn  && \
     apt-get clean && \
     rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN git config --global user.email "dev@localhost"
RUN git config --global user.name "dev"

ADD . /var/www
