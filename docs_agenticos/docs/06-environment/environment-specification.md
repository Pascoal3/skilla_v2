# Especificação de Ambientes — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

Este documento descreve como configurar, executar e manter os ambientes de **Desenvolvimento (Local)**, **Staging** e **Produção** do Skilla.

---

## 1. Variáveis de Ambiente (`.env`)

### Obrigatórias (Todos Ambientes)

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `APP_NAME` | Nome da aplicação | `"Skilla"` | `"Skilla"` |
| `APP_ENV` | Ambiente | `local` | `production` |
| `APP_KEY` | Chave criptografia (32 chars base64) | `base64:...` | `base64:...` |
| `APP_DEBUG` | Debug mode | `true` | `false` |
| `APP_URL` | URL base | `http://localhost` | `https://skilla.ao` |
| `APP_TIMEZONE` | Fuso horário | `Africa/Luanda` | `Africa/Luanda` |
| `APP_LOCALE` | Locale | `pt_AO` | `pt_AO` |

### Banco de Dados

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `DB_CONNECTION` | Driver | `mysql` | `mysql` |
| `DB_HOST` | Host MySQL | `127.0.0.1` | `db.skilla.internal` |
| `DB_PORT` | Porta | `3306` | `3306` |
| `DB_DATABASE` | Nome database | `skilla` | `skilla_prod` |
| `DB_USERNAME` | Usuário | `skilla` | `skilla_prod` |
| `DB_PASSWORD` | Senha | `secret` | `********` (Vault) |
| `DB_SSL_MODE` | SSL | `false` | `true` |

### Redis

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `REDIS_HOST` | Host Redis | `127.0.0.1` | `redis.skilla.internal` |
| `REDIS_PASSWORD` | Senha | `null` | `********` (Vault) |
| `REDIS_PORT` | Porta | `6379` | `6379` |
| `REDIS_DB` | Database index | `0` | `0` |
| `REDIS_CLIENT` | Cliente | `phpredis` | `phpredis` |

### JWT (tymon/jwt-auth)

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `JWT_SECRET` | Chave secreta JWT (diferente de APP_KEY) | `base64:...` | `********` (Vault) |
| `JWT_TTL` | Access token TTL (minutos) | `1440` (24h) | `1440` |
| `JWT_REFRESH_TTL` | Refresh token TTL (minutos) | `20160` (14d) | `20160` |
| `JWT_COOKIE` | Nome cookie | `jwt_token` | `jwt_token` |
| `JWT_COOKIE_SECURE` | Secure cookie | `false` | `true` |
| `JWT_COOKIE_SAME_SITE` | SameSite | `lax` | `lax` |

### Reverb (WebSocket)

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `REVERB_APP_ID` | App ID | `skilla` | `skilla` |
| `REVERB_APP_KEY` | App Key | `local-key` | `prod-key` (Vault) |
| `REVERB_APP_SECRET` | App Secret | `local-secret` | `********` (Vault) |
| `REVERB_HOST` | Host bind | `0.0.0.0` | `0.0.0.0` |
| `REVERB_PORT` | Porta | `8080` | `8080` |
| `REVERB_SCHEME` | Esquema interno | `http` | `http` |

### Mail (Futuro)

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `MAIL_MAILER` | Driver | `log` | `smtp` |
| `MAIL_HOST` | Host SMTP | `mailpit` | `smtp.sendgrid.net` |
| `MAIL_PORT` | Porta | `1025` | `587` |
| `MAIL_USERNAME` | Usuário | `null` | `apikey` |
| `MAIL_PASSWORD` | Senha | `null` | `********` (Vault) |
| `MAIL_ENCRYPTION` | TLS/SSL | `null` | `tls` |
| `MAIL_FROM_ADDRESS` | Remetente | `noreply@skilla.local` | `noreply@skilla.ao` |
| `MAIL_FROM_NAME` | Nome remetente | `"Skilla"` | `"Skilla"` |

### Storage (Futuro S3/MinIO)

| Variável | Descrição | Exemplo Dev | Exemplo Prod |
|----------|-----------|-------------|--------------|
| `FILESYSTEM_DISK` | Disk default | `local` | `s3` |
| `AWS_ACCESS_KEY_ID` | Access Key | `minioadmin` | `********` (Vault) |
| `AWS_SECRET_ACCESS_KEY` | Secret Key | `minioadmin` | `********` (Vault) |
| `AWS_DEFAULT_REGION` | Região | `us-east-1` | `af-south-1` |
| `AWS_BUCKET` | Bucket | `skilla-local` | `skilla-prod` |
| `AWS_ENDPOINT` | Endpoint S3 | `http://minio:9000` | `https://s3.af-south-1.amazonaws.com` |
| `AWS_USE_PATH_STYLE_ENDPOINT` | Path style | `true` | `false` |

### Skilla Config (config/skilla.php)

| Variável | Descrição | Valor Padrão |
|----------|-----------|--------------|
| `comissao_percentual` | Comissão plataforma | `0.10` |
| `pacotes_creditos` | Array pacotes | Ver config |
| `limites.min_recarga` | Mín recarga Kz | `500` |
| `limites.min_saque` | Mín saque Kz | `1000` |
| `boost.custo_creditos` | Custo boost | `50` |
| `boost.duracao_dias` | Duração boost | `30` |
| `job.expiracao_dias` | Auto-expiração | `30` |
| `job.max_propostas` | Max propostas/job | `15` |

---

## 2. Docker Compose (Desenvolvimento Local)

### `docker-compose.yml`

```yaml
version: '3.8'

services:
  # Aplicação PHP-FPM + Nginx
  app:
    build:
      context: .
      dockerfile: Dockerfile
      target: development
    container_name: skilla-app
    volumes:
      - .:/var/www/html
      - ./storage:/var/www/html/storage
      - ./bootstrap/cache:/var/www/html/bootstrap/cache
    environment:
      - APP_ENV=local
      - DB_HOST=db
      - REDIS_HOST=redis
      - REVERB_HOST=reverb
    ports:
      - "8000:80"
      - "5173:5173" # Vite HMR
    depends_on:
      - db
      - redis
      - reverb
    networks:
      - skilla-network

  # MySQL 8.0
  db:
    image: mysql:8.0
    container_name: skilla-db
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: skilla
      MYSQL_USER: skilla
      MYSQL_PASSWORD: secret
    ports:
      - "3306:3306"
    volumes:
      - db-data:/var/lib/mysql
      - ./docker/mysql/init.sql:/docker-entrypoint-initdb.d/init.sql
    command: --default-authentication-plugin=mysql_native_password --require_secure_transport=OFF
    networks:
      - skilla-network
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      interval: 10s
      timeout: 5s
      retries: 5

  # Redis 7
  redis:
    image: redis:7-alpine
    container_name: skilla-redis
    ports:
      - "6379:6379"
    volumes:
      - redis-data:/data
    networks:
      - skilla-network
    healthcheck:
      test: ["CMD", "redis-cli", "ping"]
      interval: 10s
      timeout: 5s
      retries: 5

  # Laravel Reverb
  reverb:
    build:
      context: .
      dockerfile: Dockerfile.reverb
    container_name: skilla-reverb
    environment:
      - REVERB_APP_ID=skilla
      - REVERB_APP_KEY=local-key
      - REVERB_APP_SECRET=local-secret
      - REVERB_HOST=0.0.0.0
      - REVERB_PORT=8080
      - REVERB_SCHEME=http
    ports:
      - "8080:8080"
    depends_on:
      - redis
    networks:
      - skilla-network
    healthcheck:
      test: ["CMD", "wget", "-q", "--spider", "http://localhost:8080/health"]
      interval: 10s
      timeout: 5s
      retries: 5

  # MinIO (S3 Local) - Opcional
  minio:
    image: minio/minio:latest
    container_name: skilla-minio
    command: server /data --console-address ":9001"
    environment:
      MINIO_ROOT_USER: minioadmin
      MINIO_ROOT_PASSWORD: minioadmin
    ports:
      - "9000:9000"
      - "9001:9001"
    volumes:
      - minio-data:/data
    networks:
      - skilla-network

  # Mailpit (Email Testing)
  mailpit:
    image: axllent/mailpit:latest
    container_name: skilla-mailpit
    ports:
      - "1025:1025" # SMTP
      - "8025:8025" # Web UI
    networks:
      - skilla-network

volumes:
  db-data:
  redis-data:
  minio-data:

networks:
  skilla-network:
    driver: bridge
```

### `Dockerfile` (Multi-stage)

```dockerfile
# Base
FROM php:8.3-fpm-alpine AS base

# Dependências sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    linux-headers \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    postgresql-dev \
    mysql-client \
    redis \
    nodejs \
    npm

# Extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    zip \
    intl \
    bcmath \
    gd \
    opcache \
    pcntl \
    sockets

# Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node/Vite
WORKDIR /var/www/html

# Development Stage
FROM base AS development

# Configurações dev
COPY docker/php/php.ini-development /usr/local/etc/php/php.ini
COPY docker/nginx/nginx.dev.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.dev.conf /etc/supervisor/conf.d/supervisord.conf

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Entry point
COPY docker/entrypoint.dev.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

EXPOSE 80 5173 8080
```

```dockerfile
# Dockerfile.reverb
FROM php:8.3-cli-alpine

RUN apk add --no-cache \
    $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/reverb/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
CMD ["php", "artisan", "reverb:start", "--host=0.0.0.0", "--port=8080"]
```

### Comandos Úteis Dev

```bash
# Subir tudo
docker-compose up -d --build

# Logs
docker-compose logs -f app
docker-compose logs -f reverb

# Shell no container
docker-compose exec app bash
docker-compose exec db mysql -u skilla -psecret skilla

# Comandos Laravel
docker-compose exec app php artisan migrate:fresh --seed
docker-compose exec app php artisan test
docker-compose exec app php artisan queue:work
docker-compose exec app php artisan reverb:start

# Frontend
docker-compose exec app npm run dev
docker-compose exec app npm run build

# Parar
docker-compose down -v
```

---

## 3. Staging (Homologação)

### Infraestrutura
- **VM Ubuntu 22.04/24.04 LTS** (2 vCPU, 4GB RAM, 50GB SSD)
- **Domínio**: `staging.skilla.ao`
- **SSL**: Let's Encrypt (Certbot) + Cloudflare Proxy
- **Deploy**: GitHub Actions → SSH → Deploy Script

### Serviços (Systemd via Supervisor)

```ini
# /etc/supervisor/conf.d/skilla.conf
[program:skilla-web]
command=php-fpm8.3 -F
directory=/var/www/skilla
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/skilla/web.log

[program:skilla-reverb]
command=php artisan reverb:start --host=0.0.0.0 --port=8080
directory=/var/www/skilla
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/skilla/reverb.log

[program:skilla-queue]
command=php artisan queue:work --sleep=3 --tries=3 --timeout=60
directory=/var/www/skilla
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/skilla/queue.log
numprocs=2
process_name=%(program_name)s_%(process_num)02d

[program:skilla-scheduler]
command=php artisan schedule:work
directory=/var/www/skilla
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/skilla/scheduler.log
```

### Nginx (Staging/Prod)

```nginx
# /etc/nginx/sites-available/skilla
upstream php_fpm {
    server unix:/run/php/php8.3-fpm.sock;
}

server {
    listen 80;
    server_name staging.skilla.ao;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name staging.skilla.ao;

    ssl_certificate /etc/letsencrypt/live/staging.skilla.ao/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/staging.skilla.ao/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    root /var/www/skilla/public;
    index index.php;

    # Security Headers
    add_header X-Frame-Options "DENY" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; connect-src 'self' wss://staging.skilla.ao; frame-ancestors 'none';" always;

    # Gzip
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;

    # Static assets caching
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }

    # Main
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP
    location ~ \.php$ {
        fastcgi_pass php_fpm;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    # Reverb WebSocket
    location /app/ {
        proxy_pass http://127.0.0.1:8080;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_read_timeout 86400;
    }

    # Deny access to sensitive files
    location ~ /\.(env|git) { deny all; }
    location ~ /storage/ { deny all; }
    location ~ /bootstrap/cache/ { deny all; }
}
```

### Deploy Script (`deploy.sh`)

```bash
#!/bin/bash
set -e

APP_DIR="/var/www/skilla"
REPO="git@github.com:org/skilla.git"
BRANCH="staging"

cd $APP_DIR

echo "🔄 Pulling latest code..."
git fetch origin
git reset --hard origin/$BRANCH

echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
npm ci --production
npm run build

echo "🔧 Running migrations..."
php artisan migrate --force --no-interaction

echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔄 Restarting services..."
sudo supervisorctl restart skilla-web skilla-reverb skilla-queue skilla-scheduler

echo "✅ Deploy completed!"
```

---

## 4. Produção

### Infraestrutura Recomendada
- **Load Balancer**: Cloudflare (DNS + WAF + DDoS + SSL) → Nginx (2+ VMs)
- **App Servers**: 2+ VMs Ubuntu 24.04 (4 vCPU, 8GB RAM, 100GB SSD) - Auto Scaling Group
- **Database**: MySQL 8.0 Managed (AWS RDS / Azure Database / DigitalOcean Managed) - Multi-AZ, Read Replicas
- **Redis**: Managed (AWS ElastiCache / Azure Cache / Upstash) - Cluster Mode
- **Storage**: S3 Compatible (AWS S3 / Wasabi / MinIO Cluster) - Versioning + Lifecycle
- **CDN**: Cloudflare (Assets estáticos, Imagens públicas)
- **Monitoring**: Prometheus + Grafana + Loki (Self-hosted ou Grafana Cloud)
- **Secrets**: HashiCorp Vault / AWS Secrets Manager / 1Password
- **Backup**: Daily MySQL dump → S3 (criptografado) + Point-in-time Recovery (RDS)

### High Availability
- **App**: Mínimo 2 instâncias behind Load Balancer
- **Reverb**: 2+ processos com Redis Pub/Sub + Sticky Sessions (Cookie) ou Consistent Hashing
- **Queue**: Múltiplos workers + Horizon para monitoramento
- **Scheduler**: Apenas 1 instância (lock distribuído via Redis/DB)

### SSL/TLS
- **Cloudflare**: Full (Strict) mode
- **Certificados**: Let's Encrypt (auto-renewal via Certbot) ou Cloudflare Origin CA
- **HSTS**: `max-age=31536000; includeSubDomains; preload`

### Rate Limiting (Nginx + Cloudflare)
```nginx
# Nginx
limit_req_zone $binary_remote_addr zone=api:10m rate=60r/s;
limit_req_zone $binary_remote_addr zone=login:10m rate=5r/m;
limit_req_zone $binary_remote_addr zone=ws:10m rate=30r/m;

server {
    location /api/ {
        limit_req zone=api burst=20 nodelay;
    }
    location /login {
        limit_req zone=login burst=3 nodelay;
    }
    location /app/ {
        limit_req zone=ws burst=50 nodelay;
    }
}
```

---

## 5. Observabilidade

### Logs
- **Formato**: JSON (Laravel Octane/Pail compatible)
- **Campos**: `timestamp`, `level`, `message`, `context{request_id, user_id, duration_ms, memory_mb, sql_count, url, method, ip}`
- **Rotação**: Daily, compress, retenção 30 dias (hot) + 1 ano (cold/S3)
- **Agregação**: Loki + Promtail → Grafana

### Métricas (Prometheus)
```yaml
# Métricas customizadas Laravel
- http_requests_total{method,route,status}
- http_request_duration_seconds_bucket{method,route}
- queue_jobs_processed_total{job,status}
- queue_jobs_failed_total{job}
- ws_connections_active
- ws_messages_total{direction}
- wallet_balance_total{user_id}
- escrow_transactions_total{status}
- dispute_total{status}
```

### Alertas (Prometheus Alertmanager)
| Alerta | Condição | Severidade | Canal |
|--------|----------|------------|-------|
| `HighErrorRate` | `rate(http_requests_total{status=~"5.."}[5m]) > 0.01` | Critical | PagerDuty/Slack |
| `QueueLag` | `queue_jobs_waiting > 100` | Warning | Slack |
| `WSConnectionsHigh` | `ws_connections_active > 8000` | Warning | Slack |
| `DiskSpace` | `disk_usage_percent > 80` | Warning | Slack |
| `DBConnections` | `mysql_threads_connected > 150` | Critical | PagerDuty |
| `ReconciliationFail` | `wallet_reconciliation_divergence > 0.01` | Critical | PagerDuty + Email |

### Health Checks
```bash
# HTTP
GET /up → 200 OK { "status": "ok", "database": "connected", "redis": "connected", "reverb": "connected" }

# WebSocket
wss://skilla.ao/app/{key} → 101 Switching Protocols

# Database
mysqladmin ping -h localhost -u skilla -p$PASS

# Redis
redis-cli ping → PONG

# Reverb
curl -f http://localhost:8080/health → 200 OK
```

---

## 6. Backup & Disaster Recovery

### Backup Diário (Automatizado)
```bash
#!/bin/bash
# /usr/local/bin/backup-skilla.sh
set -e

DATE=$(date +%Y%m%d_%H%M%S)
BUCKET="s3://skilla-backups/prod/mysql"
ENCRYPT_KEY="gpg-key-id"

mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASS \
    --single-transaction --routines --triggers --events \
    $DB_NAME | gzip | gpg --encrypt --recipient $ENCRYPT_KEY | \
    aws s3 cp - $BUCKET/skilla_$DATE.sql.gz.gpg

# Verificar upload
aws s3 ls $BUCKET/skilla_$DATE.sql.gz.gpg

# Retenção: 30 dias
aws s3api put-bucket-lifecycle-configuration --bucket skilla-backups --lifecycle-configuration '{
  "Rules": [{ "ID": "ExpireOldBackups", "Status": "Enabled", "Expiration": { "Days": 30 } }]
}'
```

### Restore Procedure (Testado Mensalmente)
```bash
# 1. Baixar backup
aws s3 cp s3://skilla-backups/prod/mysql/skilla_20260926_030000.sql.gz.gpg backup.sql.gz.gpg

# 2. Descriptografar
gpg --decrypt backup.sql.gz.gpg | gunzip > backup.sql

# 3. Restaurar (em DB vazio)
mysql -h $DB_HOST -u $DB_USER -p$DB_PASS skilla_restore < backup.sql

# 4. Verificar integridade
mysql -h $DB_HOST -u $DB_USER -p$DB_PASS -e "SELECT COUNT(*) FROM skilla_restore.perfis;"
mysql -h $DB_HOST -u $DB_USER -p$DB_PASS -e "CALL wallet_reconcile_check();"
```

### RTO/RPO
| Métrica | Target |
|---------|--------|
| **RPO** (Recovery Point Objective) | 24h (backup diário) |
| **RTO** (Recovery Time Objective) | 2h (restore + DNS switch) |

---

## 7. Segredos & Configuração Sensível

### Gerenciamento
- **Nunca** commitar `.env` ou secrets no Git
- **Desenvolvimento**: `.env.local` (gitignored) + `1Password` CLI para secrets compartilhados
- **Staging/Prod**: HashiCorp Vault / AWS Secrets Manager / Azure Key Vault
- **Injeção**: CI/CD injeta secrets no deploy; runtime lê de `/run/secrets/` ou variáveis de ambiente

### Rotação
| Segredo | Frequência | Responsável |
|---------|------------|-------------|
| `APP_KEY` | Anual | DevOps Lead |
| `JWT_SECRET` | Semestral | DevOps Lead |
| `DB_PASSWORD` | Trimestral | DBA |
| `REDIS_PASSWORD` | Trimestral | DevOps |
| `REVERB_APP_SECRET` | Semestral | DevOps |
| `MAIL_PASSWORD` | Conforme provedor | DevOps |
| `AWS_SECRET_ACCESS_KEY` | Conforme política IAM | DevOps |

---

## 8. CI/CD Pipeline (GitHub Actions)

```yaml
# .github/workflows/ci.yml
name: CI

on:
  push:
    branches: [main, develop, staging]
  pull_request:
    branches: [main, develop]

jobs:
  lint:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with: { php-version: '8.3', extensions: mbstring, pdo_mysql, redis, zip, intl, bcmath, gd }
      - run: composer install --prefer-dist --no-progress
      - run: ./vendor/bin/pint --test
      - run: ./vendor/bin/phpstan analyse --level=5 --memory-limit=512M
      - run: npm ci && npm run lint

  test:
    runs-on: ubuntu-latest
    services:
      mysql:
        image: mysql:8.0
        env: { MYSQL_ROOT_PASSWORD: root, MYSQL_DATABASE: skilla_test }
        ports: [3306:3306]
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=5
      redis:
        image: redis:7-alpine
        ports: [6379:6379]
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with: { php-version: '8.3', extensions: mbstring, pdo_mysql, redis, zip, intl, bcmath, gd, coverage: pcov }
      - run: composer install --prefer-dist --no-progress
      - run: cp .env.ci .env
      - run: php artisan key:generate
      - run: php artisan migrate --force
      - run: php artisan test --parallel --coverage --min=70

  build:
    needs: [lint, test]
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: docker/build-push-action@v5
        with:
          context: .
          push: true
          tags: ghcr.io/org/skilla:${{ github.sha }}
          cache-from: type=gha
          cache-to: type=gha,mode=max

  deploy-staging:
    needs: build
    if: github.ref == 'refs/heads/staging'
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Deploy to Staging
        run: |
          ssh staging@staging.skilla.ao "cd /var/www/skilla && ./deploy.sh"
        env:
          SSH_PRIVATE_KEY: ${{ secrets.STAGING_SSH_KEY }}

  deploy-production:
    needs: build
    if: github.ref == 'refs/heads/main' && github.event_name == 'release'
    runs-on: ubuntu-latest
    environment: production
    steps:
      - uses: actions/checkout@v4
      - name: Deploy to Production
        run: |
          # Blue-Green deploy via Load Balancer
          # 1. Deploy to inactive target group
          # 2. Health checks
          # 3. Switch traffic
          # 4. Monitor 10min
          # 5. Decommission old
        env:
          AWS_ACCESS_KEY_ID: ${{ secrets.AWS_ACCESS_KEY_ID }}
          AWS_SECRET_ACCESS_KEY: ${{ secrets.AWS_SECRET_ACCESS_KEY }}
```

---

## Related docs
- [TRD.md](../02-architeture/TRD.md)
- [dev-plan.md](../02-architeture/dev-plan.md)
- [tech-stack.md](../02-architeture/tech-stack.md)
- [security-guidelines.md](../02-architeture/security-guidelines.md)
- [../07-maintenance/changelog.md](../07-maintenance/changelog.md)