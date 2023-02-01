FROM php:8.1

ARG PROJECT_DIR=/opt/project

# hadolint ignore=DL3022
COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . ${PROJECT_DIR}
WORKDIR ${PROJECT_DIR}

# hadolint ignore=DL3008
RUN apt-get update && apt-get install --no-install-recommends -y \
    zip \
    git \
    && composer i \
    && rm -rf /var/lib/apt/lists/*

