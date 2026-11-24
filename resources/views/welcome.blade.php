<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API de Eventos — Laravel</title>
    <style>
        :root {
            --bg: #0f172a;
            --surface: #1e293b;
            --surface-2: #334155;
            --border: #334155;
            --text: #f8fafc;
            --muted: #94a3b8;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --success: #10b981;
            --accent: #f59e0b;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.5;
            padding: 2rem 1rem 4rem;
        }

        .container {
            max-width: 1180px;
            margin: 0 auto;
        }

        header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
        }

        .title-group h1 {
            font-size: 1.65rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .title-group p {
            color: var(--muted);
            font-size: 0.92rem;
            margin-top: 0.25rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        }

        .badge-get {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-post {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.65rem 1.15rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.15s ease, transform 0.1s ease;
        }

        .btn:hover {
            background: var(--primary-hover);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn-secondary {
            background: var(--surface-2);
            color: var(--text);
            border: 1px solid #475569;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Resumo Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1.35rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 500;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .stat-value.confirmadas {
            color: var(--success);
        }

        .stat-value.total {
            color: #60a5fa;
        }

        /* Main Sections Grid */
        .main-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 560px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid var(--border);
        }

        .panel-title {
            font-size: 1.15rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.85rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
        }

        .form-group input {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            padding: 0.6rem 0.75rem;
            border-radius: 0.45rem;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.15s;
        }

        .form-group input:focus {
            border-color: var(--primary);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0.75rem;
            margin-top: 0.25rem;
        }

        /* Tables */
        .table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.88rem;
        }

        th, td {
            padding: 0.7rem 0.9rem;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: rgba(15, 23, 42, 0.6);
            color: var(--muted);
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .empty-row {
            text-align: center;
            color: var(--muted);
            padding: 1.5rem;
        }

        /* JSON Console */
        .console-panel {
            background: #090d16;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1.25rem 1.5rem;
        }

        .console-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .console-status {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 0.82rem;
            color: var(--success);
        }

        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 0.84rem;
            color: #e2e8f0;
            overflow-x: auto;
            max-height: 280px;
            line-height: 1.55;
        }

        .toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            background: var(--surface);
            border: 1px solid var(--success);
            color: var(--text);
            padding: 0.85rem 1.25rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            font-size: 0.9rem;
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="title-group">
                <h1>Sistema de Eventos — API em Laravel</h1>
                <p>Dupla 11: Edinei Luiz Pereira Junior &amp; Yuri Gabriel dos Santos Pereira</p>
            </div>
            <button type="button" class="btn btn-secondary" onclick="carregarTudo()">
                Atualizar Todos os Endpoints
            </button>
        </header>

        <!-- Endpoint 3: Resumo de Inscrições -->
        <section class="stats-grid" aria-label="Resumo de Inscrições">
            <div class="stat-card">
                <div class="stat-header">
                    <span>Total de Inscrições</span>
                    <span class="badge badge-get">GET /api/inscricoes/resumo</span>
                </div>
                <div class="stat-value total" id="total-inscricoes">--</div>
                <small style="color: var(--muted)">Campo JSON: <code>total_inscricoes</code></small>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span>Inscrições Confirmadas</span>
                    <span class="badge badge-get">GET /api/inscricoes/resumo</span>
                </div>
                <div class="stat-value confirmadas" id="inscricoes-confirmadas">--</div>
                <small style="color: var(--muted)">Campo JSON: <code>inscricoes_confirmadas</code></small>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span>Testar Resumo da API</span>
                    <button type="button" class="btn btn-sm" onclick="carregarResumo(true)">
                        Consultar Resumo
                    </button>
                </div>
                <div style="font-size: 0.88rem; color: var(--muted);">
                    Chama <code>InscricaoController@resumo</code> e exibe o retorno JSON no console abaixo.
                </div>
            </div>
        </section>

        <!-- Endpoints 1 e 2: Eventos e Participantes -->
        <div class="main-grid">
            <!-- Painel de Eventos -->
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <span>Eventos</span>
                        <span class="badge badge-get">GET</span>
                        <span class="badge badge-post">POST /api/eventos</span>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="carregarEventos(true)">
                        Listar JSON
                    </button>
                </div>

                <form id="form-evento" onsubmit="salvarEvento(event)">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="evento-nome">Nome do Evento</label>
                            <input type="text" id="evento-nome" name="nome" placeholder="Ex: Semana Acadêmica" required>
                        </div>
                        <div class="form-group">
                            <label for="evento-local">Local</label>
                            <input type="text" id="evento-local" name="local" placeholder="Ex: Auditório" required>
                        </div>
                        <div class="form-group">
                            <label for="evento-data">Data</label>
                            <input type="date" id="evento-data" name="data" required>
                        </div>
                    </div>
                    <div class="form-actions" style="margin-top: 0.85rem;">
                        <button type="submit" class="btn">Cadastrar Evento (POST)</button>
                    </div>
                </form>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody id="tabela-eventos">
                            <tr>
                                <td colspan="4" class="empty-row">Carregando eventos...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Painel de Participantes -->
            <section class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <span>Participantes</span>
                        <span class="badge badge-get">GET</span>
                        <span class="badge badge-post">POST /api/participantes</span>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="carregarParticipantes(true)">
                        Listar JSON
                    </button>
                </div>

                <form id="form-participante" onsubmit="salvarParticipante(event)">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="part-nome">Nome</label>
                            <input type="text" id="part-nome" name="nome" placeholder="Ex: Maria Souza" required>
                        </div>
                        <div class="form-group">
                            <label for="part-email">E-mail</label>
                            <input type="email" id="part-email" name="email" placeholder="maria@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="part-telefone">Telefone</label>
                            <input type="text" id="part-telefone" name="telefone" placeholder="(41) 99999-0000" required>
                        </div>
                    </div>
                    <div class="form-actions" style="margin-top: 0.85rem;">
                        <button type="submit" class="btn">Cadastrar Participante (POST)</button>
                    </div>
                </form>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody id="tabela-participantes">
                            <tr>
                                <td colspan="4" class="empty-row">Carregando participantes...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <!-- Console de Resposta JSON -->
        <section class="console-panel">
            <div class="console-header">
                <strong>Última Resposta JSON da API</strong>
                <span class="console-status" id="console-meta">GET /api/inscricoes/resumo — 200 OK</span>
            </div>
            <pre id="console-output">{}</pre>
        </section>
    </div>

    <div class="toast" id="toast">Operação realizada com sucesso!</div>

    <script>
        function mostrarToast(mensagem) {
            const toast = document.getElementById('toast');
            toast.textContent = mensagem;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2800);
        }

        function atualizarConsole(metodo, endpoint, status, dados) {
            document.getElementById('console-meta').textContent = `${metodo} ${endpoint} — HTTP ${status}`;
            document.getElementById('console-output').textContent = JSON.stringify(dados, null, 2);
        }

        function escaparHtml(valor) {
            return String(valor ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        async function carregarResumo(exibirNoConsole = false) {
            const resp = await fetch('/api/inscricoes/resumo', {
                headers: { 'Accept': 'application/json' }
            });
            const dados = await resp.json();

            document.getElementById('total-inscricoes').textContent = dados.total_inscricoes ?? 0;
            document.getElementById('inscricoes-confirmadas').textContent = dados.inscricoes_confirmadas ?? 0;

            if (exibirNoConsole) {
                atualizarConsole('GET', '/api/inscricoes/resumo', resp.status, dados);
            }
            return { status: resp.status, dados };
        }

        async function carregarEventos(exibirNoConsole = false) {
            const resp = await fetch('/api/eventos', {
                headers: { 'Accept': 'application/json' }
            });
            const eventos = await resp.json();
            const tbody = document.getElementById('tabela-eventos');

            if (!Array.isArray(eventos) || eventos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="empty-row">Nenhum evento cadastrado.</td></tr>';
            } else {
                tbody.innerHTML = eventos.map(ev => `
                    <tr>
                        <td>#${escaparHtml(ev.id)}</td>
                        <td><strong>${escaparHtml(ev.nome)}</strong></td>
                        <td>${escaparHtml(ev.local)}</td>
                        <td>${escaparHtml(ev.data)}</td>
                    </tr>
                `).join('');
            }

            if (exibirNoConsole) {
                atualizarConsole('GET', '/api/eventos', resp.status, eventos);
            }
        }

        async function carregarParticipantes(exibirNoConsole = false) {
            const resp = await fetch('/api/participantes', {
                headers: { 'Accept': 'application/json' }
            });
            const participantes = await resp.json();
            const tbody = document.getElementById('tabela-participantes');

            if (!Array.isArray(participantes) || participantes.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="empty-row">Nenhum participante cadastrado.</td></tr>';
            } else {
                tbody.innerHTML = participantes.map(p => `
                    <tr>
                        <td>#${escaparHtml(p.id)}</td>
                        <td><strong>${escaparHtml(p.nome)}</strong></td>
                        <td>${escaparHtml(p.email)}</td>
                        <td>${escaparHtml(p.telefone)}</td>
                    </tr>
                `).join('');
            }

            if (exibirNoConsole) {
                atualizarConsole('GET', '/api/participantes', resp.status, participantes);
            }
        }

        async function salvarEvento(event) {
            event.preventDefault();
            const payload = {
                nome: document.getElementById('evento-nome').value.trim(),
                local: document.getElementById('evento-local').value.trim(),
                data: document.getElementById('evento-data').value
            };

            const resp = await fetch('/api/eventos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const criado = await resp.json();
            atualizarConsole('POST', '/api/eventos', resp.status, criado);

            if (resp.ok) {
                document.getElementById('form-evento').reset();
                await carregarEventos(false);
                mostrarToast('Evento cadastrado com sucesso (HTTP 201)!');
            }
        }

        async function salvarParticipante(event) {
            event.preventDefault();
            const payload = {
                nome: document.getElementById('part-nome').value.trim(),
                email: document.getElementById('part-email').value.trim(),
                telefone: document.getElementById('part-telefone').value.trim()
            };

            const resp = await fetch('/api/participantes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const criado = await resp.json();
            atualizarConsole('POST', '/api/participantes', resp.status, criado);

            if (resp.ok) {
                document.getElementById('form-participante').reset();
                await carregarParticipantes(false);
                mostrarToast('Participante cadastrado com sucesso (HTTP 201)!');
            }
        }

        async function carregarTudo() {
            const resumo = await carregarResumo(true);
            await Promise.all([
                carregarEventos(false),
                carregarParticipantes(false)
            ]);
        }

        document.addEventListener('DOMContentLoaded', carregarTudo);
    </script>
</body>
</html>
