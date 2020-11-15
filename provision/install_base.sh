#!/bin/bash

RUN_AS_USER="www-data"
NEXTCLOUD_RELEASE="https://github.com/nextcloud/server/archive/v20.0.1RC1.zip"

sudo -u www-data php occ  maintenance:install --database \
 "mysql" --database-name "nextcloud"  --database-user "root" --database-pass \
 "password" --admin-user "admin" --admin-pass "password"