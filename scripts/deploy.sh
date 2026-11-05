#!/usr/bin/env bash
set -euo pipefail

# ==============================================================================
# Script de Deploy para Docker Swarm — Core Infrastructure
# Uso: ./scripts/deploy.sh <nome-ou-caminho-da-stack>
# Exemplos:
#   ./scripts/deploy.sh traefik
#   ./scripts/deploy.sh core/n8n
#   ./scripts/deploy.sh monitoring/grafana
# ==============================================================================

show_help() {
    echo "============================================================"
    echo "🚀 Utilitário de Deploy de Stacks (Docker Swarm)"
    echo "============================================================"
    echo "Uso: $0 <caminho-ou-nome-da-stack>"
    echo ""
    echo "Stacks Core disponíveis (core/):"
    echo "  - traefik"
    echo "  - jenkins"
    echo "  - portainer"
    echo "  - postgres"
    echo "  - pgadmin"
    echo "  - mariadb"
    echo "  - redis"
    echo "  - n8n"
    echo "  - evolution"
    echo "  - chatwoot"
    echo "  - kokoro-tts"
    echo "  - wordpress"
    echo ""
    echo "Stacks de Monitoramento disponíveis (monitoring/):"
    echo "  - prometheus"
    echo "  - grafana"
    echo "  - cadvisor"
    echo "  - node-exporter"
    echo "  - postgres-exporter"
    echo "  - mariadb-exporter"
    echo "  - redis-exporter"
    echo "============================================================"
}

if [ $# -lt 1 ] || [ "$1" = "-h" ] || [ "$1" = "--help" ]; then
    show_help
    exit 0
fi

INPUT_TARGET="$1"
INPUT_TARGET="${INPUT_TARGET%/}"

TARGET=""
if [ -d "$INPUT_TARGET" ]; then
    TARGET="$INPUT_TARGET"
elif [ -d "core/${INPUT_TARGET}" ]; then
    TARGET="core/${INPUT_TARGET}"
elif [ -d "monitoring/${INPUT_TARGET}" ]; then
    TARGET="monitoring/${INPUT_TARGET}"
else
    # Verifica se passou nome de arquivo direto
    if [ -f "$INPUT_TARGET" ]; then
        TARGET="$(dirname "$INPUT_TARGET")"
    else
        echo "❌ Diretório ou stack não encontrada: ${INPUT_TARGET}"
        echo "   Verifique se o nome informado existe em core/ ou monitoring/."
        exit 1
    fi
fi

# Nome da stack no Swarm (apenas o nome final, sem diretórios pai)
STACK_NAME="${TARGET##*/}"

# Localização do arquivo compose (procura por .yaml e .yml)
COMPOSE_FILE=""
if [ -f "${TARGET}/${STACK_NAME}.yaml" ]; then
    COMPOSE_FILE="${TARGET}/${STACK_NAME}.yaml"
elif [ -f "${TARGET}/${STACK_NAME}.yml" ]; then
    COMPOSE_FILE="${TARGET}/${STACK_NAME}.yml"
elif [ -f "${TARGET}/docker-compose.yml" ]; then
    COMPOSE_FILE="${TARGET}/docker-compose.yml"
elif [ -f "${TARGET}/docker-compose.yaml" ]; then
    COMPOSE_FILE="${TARGET}/docker-compose.yaml"
elif [ -f "${TARGET}/compose.yaml" ]; then
    COMPOSE_FILE="${TARGET}/compose.yaml"
elif [ -f "${TARGET}.yaml" ]; then
    COMPOSE_FILE="${TARGET}.yaml"
elif [ -f "${TARGET}.yml" ]; then
    COMPOSE_FILE="${TARGET}.yml"
else
    echo "❌ Arquivo compose não encontrado para: ${TARGET}"
    echo "   Verificados: ${TARGET}/${STACK_NAME}.yaml, ${TARGET}/${STACK_NAME}.yml, ${TARGET}/docker-compose.yml"
    exit 1
fi

echo "============================================================"
echo "🚀 Iniciando deploy da stack: ${STACK_NAME}"
echo "📁 Diretório: ${TARGET}"
echo "📄 Manifesto: ${COMPOSE_FILE}"
echo "============================================================"

# Carrega arquivo .env se existir na pasta
ENV_FILE="${TARGET}/.env"
if [ -f "$ENV_FILE" ]; then
    echo "📄 Carregando variáveis de ambiente de ${ENV_FILE}"
    set -a
    # shellcheck disable=SC1090
    source "$ENV_FILE"
    set +a
else
    echo "ℹ️  Nenhum arquivo .env encontrado em ${TARGET} (usando variáveis já exportadas no shell/ambiente)"
fi

# Baixa as imagens declaradas no compose
echo "📥 Realizando pull das imagens..."
grep -oP 'image:\s*\K\S+' "$COMPOSE_FILE" | sort -u | while read -r raw_img; do
    # Remove aspas e valores padrão de variáveis caso existam (ex: ${IMAGE:-repo/img:tag})
    img=$(eval echo "$raw_img" 2>/dev/null || echo "$raw_img")
    if [[ "$img" != *"\$"* ]] && [ -n "$img" ]; then
        echo "   -> docker pull $img"
        docker pull "$img" || echo "   ⚠️  Aviso: Não foi possível realizar pull de $img (tentando continuar)"
    fi
done

# Executa o deploy da stack no Swarm
echo "🚀 Executando docker stack deploy..."
docker stack deploy \
    --with-registry-auth \
    --resolve-image always \
    -c "$COMPOSE_FILE" \
    "$STACK_NAME"

echo "⏳ Aguardando convergência dos serviços (até 30 tentativas)..."
sleep 5

for i in $(seq 1 30); do
    # Conta serviços que ainda não atingiram o número desejado de réplicas
    NOT_READY=$(docker stack services "$STACK_NAME" --format '{{.Replicas}}' | awk -F/ '$1 != $2 {c++} END {print c+0}')

    if [ "$NOT_READY" -eq 0 ]; then
        echo "✅ Stack ${STACK_NAME} pronta e saudável!"
        echo ""
        docker stack services "$STACK_NAME" --format 'table {{.Name}}\t{{.Replicas}}\t{{.Image}}'
        exit 0
    fi

    echo "  Tentativa $i/30: Serviços pendentes: $NOT_READY. Aguardando 10s..."
    sleep 10
done

echo "❌ Timeout: Os serviços da stack ${STACK_NAME} não convergiram em 5 minutos."
echo ""
echo "📊 Status dos serviços:"
docker stack services "$STACK_NAME" --format 'table {{.Name}}\t{{.Replicas}}\t{{.Image}}'
echo ""
echo "🔍 Diagnóstico dos containers:"
docker service ps "$STACK_NAME" --no-trunc 2>/dev/null | head -n 10 || true
exit 1
