# Docker Setup for TISedu ERP

## Quick Start

### Prerequisites
- Docker Desktop installed
- Docker Compose installed

### 1. Clone and Navigate
```bash
git clone https://github.com/EASHWARAPRASADH/TISedu.git
cd TISedu
```

### 2. Start Docker Containers
```bash
docker-compose up -d --build
```

This will start:
- **App** (PHP 8.2 + Laravel) - Port 9000 (internal)
- **Nginx** (Web Server) - Port 8080
- **MySQL** (Database) - Port 3306
- **phpMyAdmin** (DB Admin) - Port 8081

### 3. Access the Application

| Service | URL |
|---------|-----|
| ERP Application | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |

### 4. Default Login
- **Email:** admin@infixedu.com
- **Password:** 123456

## Useful Commands

```bash
# Stop containers
docker-compose down

# View logs
docker-compose logs -f

# Restart
docker-compose restart

# Rebuild after code changes
docker-compose up -d --build

# Access app container
docker exec -it erpv2_app bash

# Access MySQL
docker exec -it erpv2_mysql mysql -u root -p
```

## Database

The database is automatically imported from `local_infixedu_dump.sql` on first run.

MySQL Credentials:
- **Host:** mysql
- **Database:** infixedu
- **Username:** root
- **Password:** root

## Troubleshooting

### Port already in use
If port 8080 or 3306 is in use, change them in `docker-compose.yml`:
```yaml
ports:
  - "8080:80"  # Change to "8082:80" or any free port
```

### Permission issues
```bash
docker exec -it erpv2_app bash
chown -R www-data:www-data /var/www/storage
chmod -R 775 /var/www/storage
```

### Reset everything
```bash
docker-compose down -v  # Removes volumes too
docker-compose up -d --build
```
