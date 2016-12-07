#Server Load Balancer
*A basic PHP load balancing system.*

##Server Types
1. Load Balancer: redirect traffice between specified possible node servers.
2. Node: single application server.

##Private Networking on DigitalOcean


##Setting up HAProxy on Load Balancer
Install HAProxy
```
apt-get install haproxy
```

Enable HAProxy to be started by the init script.
```
nano /etc/default/haproxy
```

Set enabled option to 1
```
ENABLED=1
```

Save the following configurations into /etc/haproxy/haproxy.cfg

```
global
        log /dev/log    local0
        log /dev/log    local1 notice
        chroot /var/lib/haproxy
        stats socket /run/haproxy/admin.sock mode 660 level admin
        stats timeout 30s
        user haproxy
        group haproxy
        daemon
        maxconn 2000

        # Default SSL material locations
        ca-base /etc/ssl/certs
        crt-base /etc/ssl/private

        # Default ciphers to use on SSL-enabled listening sockets.
        # For more information, see ciphers(1SSL). This list is from:
        #  https://hynek.me/articles/hardening-your-web-servers-ssl-ciphers/
        ssl-default-bind-ciphers ECDH+AESGCM:DH+AESGCM:ECDH+AES256:DH+AES256:ECDH+AES128:DH+AES:ECDH+3DES:DH+3DES:RSA+AESGCM:RSA+AES:RSA+3DES:!aNULL:!MD5:!DSS
        ssl-default-bind-options no-sslv3

defaults
        log     global
        mode    http
        option  httplog
        option  dontlognull
        timeout connect 5000
        timeout client  50000
        timeout server  50000
        errorfile 400 /etc/haproxy/errors/400.http
        errorfile 403 /etc/haproxy/errors/403.http
        errorfile 408 /etc/haproxy/errors/408.http
        errorfile 500 /etc/haproxy/errors/500.http
        errorfile 502 /etc/haproxy/errors/502.http
        errorfile 503 /etc/haproxy/errors/503.http
        errorfile 504 /etc/haproxy/errors/504.http

listen http
        bind *:80
        mode http
        stats enable
        stats uri /haproxy?stats
        stats realm Strictly\ Private
        stats auth A_Username:YourPassword
        stats auth Another_User:passwd
        server node1 159.203.25.56:80 check
        server node2 159.203.46.47:80 check

```

Reference: https://www.digitalocean.com/community/tutorials/how-to-use-haproxy-to-set-up-http-load-balancing-on-an-ubuntu-vps
