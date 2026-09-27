Fluxo:

```
Cliente envia mensagem        
↓
Controller salva no MySQL        
↓
Evento MessageSent        
↓
Broadcast pelo Reverb        
↓
Laravel Echo recebe        
↓
JS atualiza o chat instantaneamente

```

### Instalação

```
composer require laravel/reverb
```

```
php artisan reverb:install
```

```
php artisan migrate
```

No `.env`:

```
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=localREVERB_APP_KEY=local
REVERB_APP_SECRET=local
REVERB_HOST=127.0.0.1
REVERB_PORT=8080REVERB_SCHEME=http
```

Iniciar:

```
php artisan reverb:start
```

### Frontend

Instalar Echo:

```
npm install laravel-echo pusher-js
```

Sim, mesmo usando Reverb, o cliente JavaScript utiliza a biblioteca `pusher-js` porque o protocolo é compatível.