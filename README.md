# API de Eventos — Laravel (Dupla 11)

API simples em Laravel desenvolvida para organizar **eventos**, **participantes** e **inscrições** (sem Docker, utilizando SQLite localmente).

## Integrantes
- Edinei Luiz Pereira Junior
- Yuri Gabriel dos Santos Pereira

## Estrutura do Projeto

- **Migrations** (`database/migrations/`):
  - `eventos`: `id`, `nome`, `local`, `data`, `timestamps`
  - `participantes`: `id`, `nome`, `email`, `telefone`, `timestamps`
  - `inscricoes`: `id`, `nome_participante`, `evento`, `status`, `timestamps`
- **Models** (`app/Models/`):
  - `Evento`
  - `Participante`
  - `Inscricao` (com `protected $table = 'inscricoes';`)
- **Controllers** (`app/Http/Controllers/`):
  - `EventoController` (`index`, `store`)
  - `ParticipanteController` (`index`, `store`)
  - `InscricaoController` (`resumo`)
- **Rotas** (`routes/api.php`):
  - `GET /api/eventos` — listar eventos
  - `POST /api/eventos` — inserir evento
  - `GET /api/participantes` — listar participantes
  - `POST /api/participantes` — inserir participante
  - `GET /api/inscricoes/resumo` — retornar `total_inscricoes` e `inscricoes_confirmadas`

## Como executar localmente (sem Docker)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

A API ficará disponível em `http://127.0.0.1:8000`.

## Exemplos de requisições (Postman / Insomnia / Thunder Client)

### 1. Inserir Evento (`POST /api/eventos`)
```json
{
  "nome": "Semana de Tecnologia",
  "local": "Auditório Principal",
  "data": "2026-11-24"
}
```

### 2. Listar Eventos (`GET /api/eventos`)
Retorna a lista em JSON de todos os eventos cadastrados.

### 3. Inserir Participante (`POST /api/participantes`)
```json
{
  "nome": "Edinei Junior",
  "email": "edinei@example.com",
  "telefone": "(41) 99999-1111"
}
```

### 4. Listar Participantes (`GET /api/participantes`)
Retorna a lista em JSON de todos os participantes cadastrados.

### 5. Resumo das Inscrições (`GET /api/inscricoes/resumo`)
Retorno esperado:
```json
{
  "total_inscricoes": 5,
  "inscricoes_confirmadas": 3
}
```

## Testes automatizados

```bash
php artisan test
```
