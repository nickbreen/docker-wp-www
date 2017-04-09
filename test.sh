#!/bin/bash -x

cache() {
    memcdump --servers=localhost:11211 --debug
    docker-compose exec apache htcacheclean -A -p /var/cache/apache2/mod_cache_disk
}

request() {
    echo > cookie.jar
    curl -c cookie.jar -v -u stats:password localhost/{status-apache?auto,status-fpm,ping-fpm}
    curl -c cookie.jar -v localhost/{LICENSE,test-php,test.txt,wp-admin/,wp-admin/,wp-admin/fake,index.php,index.1.php,}
}

cache; request; request; cache

