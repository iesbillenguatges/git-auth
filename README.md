
---

## 🔧 Configuració OAuth a GitHub

1. Ves a [GitHub Developer Settings](https://github.com/settings/developers) → **OAuth Apps**.
2. Crea una nova aplicació amb:
   - **Application name:** el que vulgues
   - **Homepage URL:** `https://el-teu-domini.onrender.com/`
   - **Authorization callback URL:** `https://el-teu-domini.onrender.com/auth.php`
3. Guarda:
   - `Client ID`
   - `Client Secret`

---

## 🌍 Variables d'entorn necessàries

A Render o local, configura les següents variables:

- `GITHUB_CLIENT_ID` → el client ID de GitHub
- `GITHUB_CLIENT_SECRET` → el secret de GitHub
- `GITHUB_REDIRECT_URI` → URL de callback (ex: `https://el-teu-domini.onrender.com/auth.php`)

---

## 🐳 Desplegament amb Docker

### 1. Dockerfile

```Dockerfile
FROM php:8.2-apache

RUN docker-php-ext-install pdo

COPY . /var/www/html/

EXPOSE 80


docker build -t github-auth-app .
docker run -p 8080:80 --env GITHUB_CLIENT_ID=... \
                      --env GITHUB_CLIENT_SECRET=... \
                      --env GITHUB_REDIRECT_URI=http://localhost:8080/auth.php \
                      github-auth-app
```
