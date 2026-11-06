# 🚀 AI Automation Agency — Plataforma Unificada de Infraestrutura, Automação e Observabilidade

> **Infraestrutura Enterprise para Agência de Automação, Inteligência Artificial e Mensageria Omnicanal**  
> *Docker Swarm • Traefik • Jenkins CI/CD • PostgreSQL (pgvector) • n8n • Evolution API • Chatwoot • Kokoro TTS • Prometheus • Grafana*  
> 
> 🌐 *PT-BR | [English Version](#english)*

---

## 📌 Sobre o Projeto

Este repositório unifica a **infraestrutura de serviços corporativos** e a **plataforma completa de observabilidade e monitoramento** para agências de automação e tecnologia. 

Projetada com foco em alta disponibilidade, escalabilidade horizontal, segurança em camadas e entrega contínua, esta plataforma sustenta operações de automação de processos de missão crítica, agentes neurais de voz, atendimento omnichannel via WhatsApp e web, bancos de dados relacionais e vetoriais, e telemetria de ponta a ponta.

---

## 🏗️ Arquitetura Geral da Plataforma

```text
                                  INTERNET / CLIENTES
                                           │
                                           ▼
             ┌───────────────────────────────────────────────────────────┐
             │               Traefik Reverse Proxy (HTTPS)               │
             │           (Terminação TLS Let's Encrypt Automático)       │
             └─────────────────────────────┬─────────────────────────────┘
                                           │  Rede Overlay: network_public
       ┌───────────────────────────────────┼───────────────────────────────────┐
       ▼                                   ▼                                   ▼
┌──────────────────┐             ┌──────────────────┐                ┌──────────────────┐
│  APLICAÇÕES CORE │             │  DADOS & CACHE   │                │  OBSERVABILIDADE │
├──────────────────┤             ├──────────────────┤                ├──────────────────┤
│ • Chatwoot       │             │ • PostgreSQL 17  │                │ • Prometheus     │
│   (Omnichannel)  │             │   (+ pgvector)   │                │ • Grafana 10     │
│ • Evolution API  │             │ • MariaDB 11.8   │                │ • cAdvisor       │
│   (WhatsApp v2)  │             │ • Redis 7.4      │                │ • Node Exporter  │
│ • n8n Distrib.   │             │ • pgAdmin 4      │                │ • Postgres Exp.  │
│   (Queue Mode)   │             └──────────────────┘                │ • MariaDB Exp.   │
│ • Kokoro TTS     │                                                 │ • Redis Exp.     │
│   (Voz Neural)   │             ┌──────────────────┐                └──────────────────┘
│ • WordPress      │             │ GESTÃO & CI/CD   │
│   (CMS Instit.)  │             ├──────────────────┤
└──────────────────┘             │ • Jenkins CI/CD  │
                                 │ • Portainer CE   │
                                 └──────────────────┘
```

---

## 📁 Estrutura de Diretórios Unificada

O repositório foi organizado de forma modular, separando serviços essenciais (`core/`), telemetria (`monitoring/`) e utilitários operacionais (`scripts/`):

```text
.
├── .env.example                     # Modelo master de variáveis de ambiente
├── .gitignore                       # Proteção contra vazamento de credenciais e logs
├── README.md                        # Documentação técnica e operacional
│
├── core/                            # 🚀 Serviços de Aplicação, Infraestrutura e Dados
│   ├── chatwoot/                    # Atendimento ao cliente omnichannel
│   │   ├── chatwoot.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── evolution/                   # Gateway corporativo para WhatsApp (v2)
│   │   ├── evolution.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── jenkins/                     # Servidor de automação CI/CD
│   │   ├── jenkins.yaml
│   │   ├── Dockerfile
│   │   └── .env.example
│   ├── kokoro-tts/                  # API de síntese neural de voz (Text-to-Speech)
│   │   ├── docker-compose.yml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── mariadb/                     # Banco de dados MariaDB (WordPress)
│   │   ├── mariadb.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── n8n/                         # Automação de fluxos em modo distribuído (Queue)
│   │   ├── n8n.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── pgadmin/                     # Interface de gestão web do PostgreSQL
│   │   ├── pgadmin.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── portainer/                   # Gestão visual do cluster Docker Swarm
│   │   ├── portainer.yaml
│   │   └── .env.example
│   ├── postgres/                    # PostgreSQL 17 com suporte a pgvector
│   │   ├── postgres.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── redis/                       # Cache em memória e fila BullMQ com persistência
│   │   ├── redis.yaml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── traefik/                     # Edge Proxy reverso e gerenciador SSL Let's Encrypt
│   │   ├── traefik.yaml
│   │   └── .env.example
│   └── wordpress/                   # Portal institucional com Apache e Nginx
│       ├── wordpress.yaml
│       ├── nginx.conf
│       ├── Jenkinsfile
│       ├── .env.example
│       └── theme/                   # Tema institucional customizado
│
├── monitoring/                      # 📊 Plataforma de Observabilidade e Métricas
│   ├── cadvisor/                    # Métricas de consumo e limites de containers
│   │   ├── cadvisor.yml
│   │   └── Jenkinsfile
│   ├── grafana/                     # Visualização em tempo real e dashboards operacionais
│   │   ├── grafana.yml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── mariadb-exporter/            # Coletor de métricas para MariaDB
│   │   ├── mariadb-exporter.yml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── node-exporter/               # Telemetria do host (CPU, RAM, Disco, Rede)
│   │   ├── node-exporter.yml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── postgres-exporter/           # Coletor de métricas para PostgreSQL 17
│   │   ├── postgres-exporter.yml
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   ├── prometheus/                  # Servidor Prometheus TSDB de coleta e alertas
│   │   ├── prometheus.yaml
│   │   ├── prometheus.yml           # Configuração de targets e jobs
│   │   ├── Jenkinsfile
│   │   └── .env.example
│   └── redis-exporter/              # Coletor de métricas do Redis 7
│       ├── redis-exporter.yml
│       ├── Jenkinsfile
│       └── .env.example
│
└── scripts/                         # 🛠️ Scripts de Automação e Operação
    ├── deploy.sh                    # Utilitário unificado de deploy com auto-resolução
    └── backup.sh                    # Backup automatizado de bancos e volumes com expurgo
```

---

## 🧩 Stacks e Serviços Detalhados

### 1. Borda, Roteamento e CI/CD (`core/`)
* **Traefik v2.11:** Roteador de entrada de alta performance. Redireciona HTTP para HTTPS nativamente, obtém e renova certificados SSL TLS via Let's Encrypt (ACME) e distribui o tráfego baseado em regras de `Host` e `PathPrefix`.
* **Jenkins:** Orquestrador central de CI/CD. Executa pipelines declarativas (`Jenkinsfile`) com injeção segura de credenciais em memória e validação ativa de saúde.
* **Portainer CE:** Painel de governança visual para Swarm, com agente global nos nós do cluster.

### 2. Camada de Aplicações de Negócio
* **n8n (Queue Mode Distribuído):**
  * `n8n_editor`: Interface visual de criação e depuração de automações.
  * `n8n_webhook`: Processador dedicado para absorver alto volume de webhooks externos.
  * `n8n_worker`: Executores distribuídos que processam tarefas em background via BullMQ/Redis.
* **Evolution API v2:** API corporativa para envio e recebimento de mensagens WhatsApp com suporte a múltiplas instâncias, Webhooks granulares e integração nativa com o Chatwoot.
* **Chatwoot:** Plataforma omnichannel de suporte ao cliente unificando canais de WhatsApp, Webchat e e-mail.
* **Kokoro TTS:** Microsserviço de Text-to-Speech neural rodando inferência ONNX em CPU com baixa latência e autenticação de borda via Traefik Basic-Auth.
* **WordPress:** Site institucional rodando em Apache/PHP 8.3 integrado a Nginx para compressão e entrega otimizada de assets estáticos.

### 3. Camada de Dados e Cache
* **PostgreSQL 17 + pgvector:** Banco relacional primário com suporte nativo a vetores (embeddings para IA e RAG). Opera de forma 100% privada na rede overlay sem expor portas ao host.
* **pgAdmin 4:** Console de administração para gestão de bancos de dados isolada em stack dedicada.
* **MariaDB 11.8:** Instância dedicada ao WordPress com isolamento de privilégios.
* **Redis 7.4:** Cache de baixa latência e fila de mensageria com autenticação e dupla persistência (RDB + AOF).

### 4. Camada de Observabilidade (`monitoring/`)
* **Prometheus:** Coleta periódica de métricas (pull model) via rede overlay com retenção de 7 dias. Monitora automaticamente instâncias do n8n, containers, hosts e bancos.
* **Grafana 10:** Interface de visualização analítica conectada ao Prometheus e Traefik.
* **Exporters Especializados:**
  * `cAdvisor`: Métricas de containers Docker por nó (CPU, memória e I/O).
  * `node-exporter`: Métricas a nível de sistema operacional nos hosts do cluster.
  * `postgres-exporter`, `mariadb-exporter`, `redis-exporter`: Telemetria profunda de queries, conexões, buffers e taxas de hit.

---

## 🔒 Segurança e Sanitização de Credenciais

Este repositório foi totalmente sanitizado para publicação em código aberto:
1. **Nenhuma credencial ou chave em disco:** Senhas, tokens de API, hashes e chaves privadas nunca são commitados. Utilize os arquivos `.env.example` locais e exporte as variáveis no ambiente ou através do **Jenkins Credentials Store**.
2. **Isolamento de Bancos e Filas:** Nenhum banco de dados (Postgres, MariaDB, Redis) expõe portas públicas (ex: 5432, 3306, 6379) no host. Toda a comunicação ocorre exclusivamente pela rede interna criptografada `network_public`.
3. **Firewall para Node Exporter:** Caso utilize `node-exporter` em modo host (`port 9100`), restrinja a porta no firewall (UFW ou Security Groups da cloud) para permitir tráfego apenas a partir do nó do Prometheus.
4. **Deploy Seguro em Memória:** Os pipelines do Jenkins criam o arquivo `.env` dinamicamente em tempo de execução e garantem sua deleção na cláusula `post { always { ... } }`.

---

## 🚀 Guia de Implantação do Zero (Bootstrap)

### 1. Inicializar o Docker Swarm e a Rede Overlay
Execute no servidor que atuará como nó **Manager**:

```bash
# Atualizar sistema e instalar Docker (caso não instalado)
sudo apt-get update && sudo apt-get install -y curl git nano
curl -fsSL https://get.docker.com | bash
sudo usermod -aG docker $USER

# Inicializar o cluster Docker Swarm
docker swarm init --advertise-addr <IP_PRIVADO_MANAGER>

# Criar a rede overlay externa necessária para todos os serviços
docker network create --driver overlay --attachable network_public
```

Caso utilize nós adicionais (Workers), conecte-os com o comando gerado no manager:
```bash
docker swarm join --token <WORKER_JOIN_TOKEN> <IP_MANAGER>:2377
```

### 2. Clonar o Repositório e Configurar Variáveis Base
```bash
git clone https://github.com/Art-Automac/ai-automation-agency.git
cd ai-automation-agency
```

### 3. Subir a Infraestrutura Base (Traefik, Jenkins e Portainer)
Configure os arquivos `.env` para cada serviço inicial:

```bash
# 1. Traefik (Proxy Reverso & SSL)
cp core/traefik/.env.example core/traefik/.env
nano core/traefik/.env
./scripts/deploy.sh core/traefik

# 2. Portainer (Gestão do Cluster)
cp core/portainer/.env.example core/portainer/.env
nano core/portainer/.env
./scripts/deploy.sh core/portainer

# 3. Jenkins (CI/CD)
cp core/jenkins/.env.example core/jenkins/.env
nano core/jenkins/.env
./scripts/deploy.sh core/jenkins
```

Para obter a senha inicial de administrador do Jenkins:
```bash
docker exec $(docker ps -q -f name=jenkins) cat /var/jenkins_home/secrets/initialAdminPassword
```

### 4. Subir a Camada de Dados e Cache
```bash
./scripts/deploy.sh postgres
./scripts/deploy.sh redis
./scripts/deploy.sh mariadb
./scripts/deploy.sh pgadmin
```

### 5. Subir as Aplicações e a Observabilidade
```bash
# Aplicações
./scripts/deploy.sh n8n
./scripts/deploy.sh evolution
./scripts/deploy.sh chatwoot
./scripts/deploy.sh kokoro-tts
./scripts/deploy.sh wordpress

# Monitoramento
./scripts/deploy.sh cadvisor
./scripts/deploy.sh prometheus
./scripts/deploy.sh grafana
./scripts/deploy.sh redis-exporter
./scripts/deploy.sh postgres-exporter
./scripts/deploy.sh mariadb-exporter
```

---

## 🛠️ Utilitário de Deploy (`scripts/deploy.sh`)

O script [`scripts/deploy.sh`](file:///home/arthurzao/core-infrastructure/scripts/deploy.sh) suporta resolução inteligente de diretórios. Você pode passar apenas o nome da stack ou o caminho completo:

```bash
# Exemplos equivalentes:
./scripts/deploy.sh n8n
./scripts/deploy.sh core/n8n

# Deploy de serviços de monitoramento:
./scripts/deploy.sh grafana
./scripts/deploy.sh monitoring/grafana

# Visualizar todas as stacks disponíveis:
./scripts/deploy.sh --help
```

---

## 📦 Rotina de Backup Automatizado (`scripts/backup.sh`)

O script [`scripts/backup.sh`](file:///home/arthurzao/core-infrastructure/scripts/backup.sh) gera cópias compactadas e consistentes com expurgo automático após 7 dias:
* **PostgreSQL:** `pg_dumpall` consistente compactado em `.sql.gz`.
* **MariaDB:** `mariadb-dump` de todos os bancos compactado em `.sql.gz`.
* **Volumes Persistentes:** Arquivos de dados do n8n, Evolution API, Chatwoot e WordPress.

Para configurar a execução diária às 03:00 da manhã via `crontab`:
```bash
0 3 * * * /bin/bash /caminho/para/ai-automation-agency/scripts/backup.sh >> /var/log/backup.log 2>&1
```

---

## 📋 Mapeamento de Credenciais no Jenkins

Ao configurar os pipelines declarativos no Jenkins, crie as credenciais correspondentes no menu **Manage Jenkins > Credentials**:

| ID da Credencial no Jenkins | Tipo | Finalidade / Serviço |
|---|---|---|
| `postgres-user` | Secret Text | Usuário root/admin do PostgreSQL |
| `postgres-password` | Secret Text | Senha do PostgreSQL |
| `postgres-db` | Secret Text | Nome do banco padrão (ex: `postgres`) |
| `mysql-user` | Secret Text | Usuário da aplicação no MariaDB |
| `mysql-password` | Secret Text | Senha do MariaDB da aplicação |
| `mysql-root-password` | Secret Text | Senha de root do MariaDB |
| `redis-password` | Secret Text | Senha de autenticação do Redis |
| `n8n-encryption-key` | Secret Text | Chave de criptografia de credenciais do n8n |
| `evolution-api-key` | Secret Text | Chave mestra global da Evolution API |
| `chatwoot-secret-key` | Secret Text | Rails secret base key do Chatwoot |
| `kokoro-api-key-secret`| Secret Text | Chave Bearer de autorização do Kokoro |
| `grafana-user` | Secret Text | Usuário administrador do Grafana |
| `grafana-password` | Secret Text | Senha de administrador do Grafana |

---

<a name="english"></a>
## 🇬🇧 English Summary

### Overview
This repository contains the enterprise, production-ready infrastructure and observability platform tailored for AI Automation and Omnichannel Marketing agencies.

### Technology Stack
* **Orchestration:** Docker Swarm (Manager/Worker topology) with native rolling updates.
* **Edge Ingress & TLS:** Traefik v2.11 with automated Let's Encrypt certificates.
* **CI/CD:** Jenkins Declarative Pipelines with in-memory secret injection and 30-attempt health checks.
* **Applications:** n8n (distributed Queue Mode), Evolution API v2 (WhatsApp), Chatwoot (Customer engagement), Kokoro TTS (Neural voice synthesis), WordPress.
* **Storage & Relational:** PostgreSQL 17 (+ pgvector), MariaDB 11.8, Redis 7.4 (AOF/RDB).
* **Observability:** Prometheus, Grafana 10, cAdvisor, Node Exporter, and dedicated DB exporters.

### Getting Started
1. Initialize Docker Swarm and create the overlay network:
   ```bash
   docker swarm init
   docker network create --driver overlay --attachable network_public
   ```
2. Deploy the core edge router:
   ```bash
   cp core/traefik/.env.example core/traefik/.env
   ./scripts/deploy.sh core/traefik
   ```
3. Deploy stacks sequentially with `./scripts/deploy.sh <stack_name>`.
4. All sensitive values (passwords, tokens, domains, internal network routes) are abstracted into `.env.example` templates and Jenkins Credential Store bindings.

---

*Mantido com padrões de excelência para Agências de Automação e IA 🇧🇷*
