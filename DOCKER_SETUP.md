# 🚀 TISedu ERP Docker Quick-Start (Windows)

This is the recommended "Error-Free" way to run the ERP on your local Windows machine. It automatically handles ionCube, PHP extensions, and license bypass.

## 📋 Prerequisites

1.  **Docker Desktop**: Installed and running.
2.  **WSL2 Backend**: Recommended for best performance.

---

## ⚡ One-Click Start (Recommended)

1.  Open the project folder on your Windows computer.
2.  Right-click `run-docker-windows.ps1` and select **Run with PowerShell**.
3.  Wait for the process to complete.
4.  The application will automatically open in your browser at `http://localhost:8888`.

---

## 🛠 Manual Start

If you prefer using the terminal:
```powershell
docker-compose up -d --build
```

---

## 🌐 Access URLs

| Service | URL |
|---------|-----|
| **ERP Application** | [http://localhost:8888](http://localhost:8888) |
| **phpMyAdmin** | [http://localhost:8881](http://localhost:8881) |

---

## 🔑 Default Credentials

- **Email:** `admin@infixedu.com`
- **Password:** `123456`

---

## ❓ Troubleshooting

### Port already in use
If port `8888` is in use, edit `docker-compose.yml` and change the line:
```yaml
ports:
  - "8888:80"  # Change 8888 to another number like 9999
```

### Permission Issues
The `run-docker-windows.ps1` script automatically attempts to fix common permission issues. If you still see errors, try running PowerShell as **Administrator**.

### Database didn't import
On the first run, MySQL imports `local_infixedu_dump.sql`. If it fails:
1. Run `docker-compose down -v` (This deletes volumes and data).
2. Run `docker-compose up -d`.

---

## 📜 Included Features

- **PHP 8.2-FPM**: Optimized with all required extensions.
- **ionCube Loader**: Pre-installed and configured.
- **Auto-License Bypass**: Flag files are automatically generated.
- **Clean Nginx Service**: Running as a separate container for stability.
