# PHP GitHub OAuth Login App en render.com (docker)

Aplicació mínima en PHP que permet l’autenticació d’usuaris mitjançant **GitHub OAuth** i mostra un panell personalitzat amb el seu nom d’usuari i opció de logout.

## Característiques

- Login OAuth amb GitHub.
- Interfície visual moderna i responsiva.
- Control de sessió per usuari.
- Desplegable fàcilment amb Docker.
- Compatible amb serveis com [Render](https://render.com).

---

## Estructura del projecte

```
 github-auth-app
├── auth.php # Gestió del flux OAuth amb GitHub
├── index.php # Pàgina principal amb sessió d’usuari
├── logout.php # Tanca la sessió de l'usuari
├── Dockerfile # Per a desplegament amb Docker
└── README.md # Aquest fitxer

```
---

## Configuració OAuth a GitHub

1. Ves a [GitHub Developer Settings](https://github.com/settings/developers) → **OAuth Apps**.
2. Crea una nova aplicació amb:
   - **Application name:** el que vulgues
   - **Homepage URL:** `https://el-teu-domini.onrender.com/`
   - **Authorization callback URL:** `https://el-teu-domini.onrender.com/auth.php`
3. Guarda:
   - `Client ID`
   - `Client Secret`

---

## Variables d'entorn necessàries

A Render o local, configura les següents variables:

- `GITHUB_CLIENT_ID` → el client ID de GitHub
- `GITHUB_CLIENT_SECRET` → el secret de GitHub
- `GITHUB_REDIRECT_URI` → URL de callback (ex: `https://el-teu-domini.onrender.com/auth.php`)

---

## Desplegament amb Docker

### 1. Dockerfile

```Dockerfile
FROM php:8.2-apache

COPY . /var/www/html/

EXPOSE 80


docker build -t github-auth-app .
docker run -p 8080:80 --env GITHUB_CLIENT_ID=... \
                      --env GITHUB_CLIENT_SECRET=... \
                      --env GITHUB_REDIRECT_URI=http://localhost:8080/auth.php \
                      github-auth-app
```
