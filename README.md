# This Image

See docker-compose.yml for an example of configuration.

# Apache

Apache is configured with `mod_cache` with both `mod_cache_disk` and `mod_cache_socache` with `socache_memcache`.

# PHP

FPM is configured to use memcached for session storage.
