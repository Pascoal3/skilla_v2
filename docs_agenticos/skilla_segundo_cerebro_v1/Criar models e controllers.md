### Passo 1: Modelos e Migrações

Vou adicionar a flag `-m` em todos, para que o Laravel já crie o arquivo de migração do banco de dados automaticamente.

Bash

```
php artisan make:model Profile -m
php artisan make:model Job -m
php artisan make:model Proposal -m
php artisan make:model Contract -m
php artisan make:model Skill -m
php artisan make:model Conversation -m
php artisan make:model Message -m
php artisan make:model Review -m
php artisan make:model Notification -m
```

---

### Passo 2: Controllers (API e Web)

O Laravel permite criar controllers dentro de subpastas apenas passando o caminho no nome.

**Controllers de API:**

Bash

```
php artisan make:controller Api/AuthController
php artisan make:controller Api/JobController
php artisan make:controller Api/ChatController
```

**Controllers de Web (Blade):**

Bash

```
php artisan make:controller Web/OnboardingController
php artisan make:controller Web/DashboardController
php artisan make:controller Web/JobWebController
```

---

### Passo 3: Validações (Form Requests)

Esses arquivos servem para tirar a lógica de `if($request->all()...)` de dentro do controller e colocar em arquivos organizados.

Bash

```
php artisan make:request RegisterRequest
php artisan make:request CreateJobRequest
```

---

### Passo 4: Middleware (Segurança de Role)

Este será o filtro que impede que um Freelancer acesse a página de "Postar Job" do Cliente.

Bash

```
php artisan make:middleware CheckRole
```

_Lembre-se de registrar este middleware no arquivo `app/Http/Kernel.php` (ou `bootstrap/app.php` no Laravel 11)._

---

### Passo 5: Pastas Customizadas (Services e Repositories)

O Laravel não tem um comando `php artisan make:service`. Você deve criar as pastas e os arquivos manualmente.

**Via terminal (Linux/Mac/Git Bash):**

Bash

```
# Criar pastas
mkdir -p app/Services
mkdir -p app/Repositories

# Criar arquivos vazios dos Services
touch app/Services/AuthService.php
touch app/Services/JobService.php
touch app/Services/PaymentService.php
touch app/Services/NotificationService.php

# Criar arquivos vazios dos Repositories
touch app/Repositories/ProfileRepository.php
```

**Se estiver no Windows (PowerShell) ou preferir fazer pelo VS Code:**

1. Clique com o botão direito na pasta `app` →→ Nova Pasta →→ `Services`.
2. Clique com o botão direito na pasta `app` →→ Nova Pasta →→ `Repositories`.
3. Dentro delas, crie os arquivos `.php` mencionados acima.

---

### 💡 Dica de Ouro: Como preencher esses arquivos?

Como você está usando a arquitetura de **Services**, o seu Controller **não deve** conter a lógica de negócio.

**Exemplo de como deve ficar a estrutura de um código seu:**

1. **O Request (`RegisterRequest`)**: Valida se o email é único e a senha é forte.
2. **O Controller (`AuthController`)**: Recebe a requisição e chama o Service.
3. **O Service (`AuthService`)**: Faz a lógica de criar o usuário, criar o perfil vinculado e disparar o email de boas-vindas.

**Exemplo rápido no `AuthController.php`:**

PHP

```
public function register(RegisterRequest $request, AuthService $authService) 
{
    // O Request já validou os dados automaticamente aqui
    $user = $authService->createUser($request->validated());
    
    return response()->json(['message' => 'Conta criada!', 'user' => $user], 201);
}
```

**Exemplo rápido no `AuthService.php`:**

PHP

```
namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class AuthService {
    public function createUser(array $data) {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Profile::create([
            'user_id' => $user->id,
            'full_name' => $data['full_name'],
        ]);

        return $user;
    }
}
```

### Checklist Final de Pastas

Seu projeto agora deve estar assim:

- `app/Http/Controllers/Api/` →→ ✅ OK
- `app/Http/Controllers/Web/` →→ ✅ OK
- `app/Http/Requests/` →→ ✅ OK
- `app/Http/Middleware/` →→ ✅ OK
- `app/Models/` →→ ✅ OK
- `app/Services/` →→ ✅ OK
- `app/Repositories/` →→ ✅ OK