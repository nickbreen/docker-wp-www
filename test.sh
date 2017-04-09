#!/bin/bash -x

memcdump --servers=localhost:11211 --debug
docker-compose exec apache htcacheclean -A -p /var/cache/apache2/mod_cache_disk


curl -v -u stats:password localhost/{status-apache?auto,status-fpm,ping-fpm}

curl -v localhost/{LICENSE,test-php,test.txt,wp-admin/,index.php,index.1.php,}


memcdump --servers=localhost:11211 --debug
docker-compose exec apache htcacheclean -A -p /var/cache/apache2/mod_cache_disk


