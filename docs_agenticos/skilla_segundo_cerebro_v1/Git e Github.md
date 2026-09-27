```
echo "# skilla_plataforma_freelance_angolana" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/Pascoal3/skilla_plataforma_freelance_angolana.git
git push -u origin main
```

e

```
git remote add origin https://github.com/Pascoal3/skilla_plataforma_freelance_angolana.git
git branch -M main
git push -u origin main
```


# Como atualizar o projeto depois

Sempre que fizer mudanças:

```
git add .

git commit -m "Atualização"

git push
```

---

# Comandos úteis

## Ver status

```
git status
```

---

## Ver branches

```
git branch
```

---

## Ver repositório conectado

```
git remote -v
```

---

# Dica importante para projetos Laravel

Antes de enviar um projeto Laravel, cria um `.gitignore`.

Normalmente o Laravel já vem com ele.

Ele evita enviar:

- `vendor/`
- `.env`
- cache
- node_modules

NUNCA envie o `.env`.

---

# Fluxo completo resumido

```
git initgit add .git commit -m "Primeiro commit"git branch -M maingit remote add origin LINK_DO_REPOSITORIOgit push -u origin main
```