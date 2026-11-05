#!/usr/bin/env bash
set -euo pipefail

BACKUP_DIR="${BACKUP_DIR:-/backups}"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
WORKER="${WORKER_NODE:-worker1}"
mkdir -p "$BACKUP_DIR"

echo "=== Backup iniciado: $TIMESTAMP ==="

# --- Postgres (pg_dump) — roda no manager1 ---
echo "📦 Postgres..."
PGCONTAINER=$(docker ps --filter "name=postgres_postgres" --format '{{.ID}}' | head -1)
if [ -n "$PGCONTAINER" ]; then
    docker exec "$PGCONTAINER" pg_dumpall -U postgres 2>/dev/null | gzip > "$BACKUP_DIR/postgres_all_${TIMESTAMP}.sql.gz" || true
    if [ -s "$BACKUP_DIR/postgres_all_${TIMESTAMP}.sql.gz" ]; then
        echo "  ✅ postgres_all_${TIMESTAMP}.sql.gz"
    else
        rm -f "$BACKUP_DIR/postgres_all_${TIMESTAMP}.sql.gz"
        echo "  ⚠️  Falha ao gerar backup do postgres, pulando"
    fi
else
    echo "  ⚠️  Container postgres não encontrado, pulando"
fi

# --- MariaDB (mariadb-dump) — roda no worker1 ---
echo "📦 MariaDB..."
ssh "$WORKER" '
    MARIACONTAINER=$(docker ps --filter "name=mariadb_mariadb" -q | head -1)
    if [ -z "$MARIACONTAINER" ]; then
        MARIACONTAINER=$(docker ps --filter "name=wordpress_mariadb" -q | head -1)
    fi
    if [ -n "$MARIACONTAINER" ]; then
        docker exec "$MARIACONTAINER" sh -c "mariadb-dump -u root -p\$MYSQL_ROOT_PASSWORD --all-databases 2>/dev/null"
    fi
' 2>/dev/null | gzip > "$BACKUP_DIR/mariadb_all_${TIMESTAMP}.sql.gz" || true
if [ -s "$BACKUP_DIR/mariadb_all_${TIMESTAMP}.sql.gz" ]; then
    echo "  ✅ mariadb_all_${TIMESTAMP}.sql.gz"
else
    rm -f "$BACKUP_DIR/mariadb_all_${TIMESTAMP}.sql.gz"
    echo "  ⚠️  Container mariadb não encontrado ou dump falhou no $WORKER, pulando"
fi

# --- n8n data (volume tar) — worker1 ---
echo "📦 n8n data..."
ssh "$WORKER" "
    if docker volume inspect n8n_n8n_data >/dev/null 2>&1; then
        docker run --rm -v n8n_n8n_data:/data alpine tar czf - -C /data . 2>/dev/null
    fi
" > "$BACKUP_DIR/n8n_data_${TIMESTAMP}.tar.gz" 2>/dev/null || true
if [ -s "$BACKUP_DIR/n8n_data_${TIMESTAMP}.tar.gz" ]; then
    echo "  ✅ n8n_data_${TIMESTAMP}.tar.gz"
else
    rm -f "$BACKUP_DIR/n8n_data_${TIMESTAMP}.tar.gz"
    echo "  ⚠️  Volume n8n_n8n_data não existe ou está vazio no $WORKER, pulando"
fi

# --- Evolution instances (volume tar) — worker1 ---
echo "📦 Evolution instances..."
ssh "$WORKER" "
    if docker volume inspect evolution_evolution_instances >/dev/null 2>&1; then
        docker run --rm -v evolution_evolution_instances:/data alpine tar czf - -C /data . 2>/dev/null
    fi
" > "$BACKUP_DIR/evolution_instances_${TIMESTAMP}.tar.gz" 2>/dev/null || true
if [ -s "$BACKUP_DIR/evolution_instances_${TIMESTAMP}.tar.gz" ]; then
    echo "  ✅ evolution_instances_${TIMESTAMP}.tar.gz"
else
    rm -f "$BACKUP_DIR/evolution_instances_${TIMESTAMP}.tar.gz"
    echo "  ⚠️  Volume evolution_evolution_instances não existe ou está vazio no $WORKER, pulando"
fi

# --- Chatwoot storage (volume tar) — worker1 ---
echo "📦 Chatwoot storage..."
ssh "$WORKER" "
    if docker volume inspect chatwoot_chatwoot_data >/dev/null 2>&1; then
        docker run --rm -v chatwoot_chatwoot_data:/data alpine tar czf - -C /data . 2>/dev/null
    fi
" > "$BACKUP_DIR/chatwoot_data_${TIMESTAMP}.tar.gz" 2>/dev/null || true
if [ -s "$BACKUP_DIR/chatwoot_data_${TIMESTAMP}.tar.gz" ]; then
    echo "  ✅ chatwoot_data_${TIMESTAMP}.tar.gz"
else
    rm -f "$BACKUP_DIR/chatwoot_data_${TIMESTAMP}.tar.gz"
    echo "  ⚠️  Volume chatwoot_chatwoot_data não existe ou está vazio no $WORKER, pulando"
fi

# --- WordPress storage (volume tar) — worker1 ---
echo "📦 WordPress data..."
ssh "$WORKER" "
    if docker volume inspect wordpress_wordpress_data >/dev/null 2>&1; then
        docker run --rm -v wordpress_wordpress_data:/data alpine tar czf - -C /data . 2>/dev/null
    fi
" > "$BACKUP_DIR/wordpress_data_${TIMESTAMP}.tar.gz" 2>/dev/null || true
if [ -s "$BACKUP_DIR/wordpress_data_${TIMESTAMP}.tar.gz" ]; then
    echo "  ✅ wordpress_data_${TIMESTAMP}.tar.gz"
else
    rm -f "$BACKUP_DIR/wordpress_data_${TIMESTAMP}.tar.gz"
fi

# --- Limpeza (manter últimos 7 dias) ---
echo "🧹 Removendo backups com mais de 7 dias..."
find "$BACKUP_DIR" -name "*.gz" -mtime +7 -delete

echo "=== Backup concluído ==="
ls -lh "$BACKUP_DIR"/*${TIMESTAMP}* 2>/dev/null || true
