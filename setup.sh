#!/bin/bash

# ────────────────────────────────────────────────
#  Laravel RBAC System – Quick Setup Script
# ────────────────────────────────────────────────

set -e

GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo ""
echo -e "${BLUE}╔══════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║       Laravel RBAC System Setup          ║${NC}"
echo -e "${BLUE}╚══════════════════════════════════════════╝${NC}"
echo ""

# ── Step 1: Check PHP ──────────────────────────
echo -e "${YELLOW}[1/7] Checking PHP version...${NC}"
php_ver=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
echo -e "     PHP version: ${GREEN}$php_ver${NC}"

# ── Step 2: Install dependencies ───────────────
echo -e "${YELLOW}[2/7] Installing Composer dependencies...${NC}"
composer install --no-interaction --prefer-dist
echo -e "     ${GREEN}✓ Dependencies installed${NC}"

# ── Step 3: Copy .env ──────────────────────────
echo -e "${YELLOW}[3/7] Setting up environment file...${NC}"
if [ ! -f ".env" ]; then
    cp .env.example .env
    echo -e "     ${GREEN}✓ .env file created${NC}"
else
    echo -e "     ${GREEN}✓ .env already exists${NC}"
fi

# ── Step 4: Generate app key ───────────────────
echo -e "${YELLOW}[4/7] Generating application key...${NC}"
php artisan key:generate
echo -e "     ${GREEN}✓ App key generated${NC}"

# ── Step 5: Prompt DB credentials ─────────────
echo ""
echo -e "${BLUE}── Database Configuration ──${NC}"
read -p "  DB Host [127.0.0.1]: " db_host
db_host=${db_host:-127.0.0.1}

read -p "  DB Port [3306]: " db_port
db_port=${db_port:-3306}

read -p "  DB Name [laravel_rbac]: " db_name
db_name=${db_name:-laravel_rbac}

read -p "  DB Username [root]: " db_user
db_user=${db_user:-root}

read -sp "  DB Password: " db_pass
echo ""

# Update .env
sed -i "s/DB_HOST=.*/DB_HOST=$db_host/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$db_port/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$db_name/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$db_user/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$db_pass/" .env

echo -e "     ${GREEN}✓ Database configured${NC}"

# ── Step 6: Migrate & Seed ─────────────────────
echo -e "${YELLOW}[5/7] Running migrations...${NC}"
php artisan migrate --force
echo -e "     ${GREEN}✓ Migrations complete${NC}"

echo -e "${YELLOW}[6/7] Seeding database (Admin account)...${NC}"
php artisan db:seed --force
echo -e "     ${GREEN}✓ Admin account seeded${NC}"

# ── Step 7: Cache ──────────────────────────────
echo -e "${YELLOW}[7/7] Optimizing application...${NC}"
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo -e "     ${GREEN}✓ Cache cleared${NC}"

# ── Done! ──────────────────────────────────────
echo ""
echo -e "${GREEN}╔══════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║           Setup Complete! 🎉              ║${NC}"
echo -e "${GREEN}╚══════════════════════════════════════════╝${NC}"
echo ""
echo -e "  ${BLUE}Admin Credentials:${NC}"
echo -e "  User ID  : ${GREEN}ADM-000001${NC}"
echo -e "  Email    : ${GREEN}admin@rbac.com${NC}"
echo -e "  Password : ${GREEN}Admin@12345${NC}"
echo ""
echo -e "  ${YELLOW}Start the server with:${NC} php artisan serve"
echo -e "  ${YELLOW}Then visit:${NC}           http://localhost:8000"
echo ""
