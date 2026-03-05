# DevQuest

**A ferramenta de maldade do professor**

Um sistema de gerenciamento de aulas com gamificação para turmas de Programação Web II (Desenvolvimento de Sistemas - 2º ano). Projetado em PHP com Laravel, MySQL, Tailwind e conteinerização.

## 🧠 Escopo geral

> 🖼️ **Branding & identidade visual**
> - O arquivo `logo.png` localizado na raiz do projeto será o logotipo padrão da aplicação. Ele deve aparecer:
>   * no header global,
>   * em destaque na área de login,
>   * na tabela de pontuação onde os alunos veem seus níveis/badges.
> - Às cores e tipografia já definidas juntam-se a conceituação do logo sob o tema *"Mestre do Código"*:
>   - Escudo pixelado 8/16-bit com cálice+tag HTML </> e espada pixelada;
>   - Tipografia robusta, com serifa geométrica para *DevQuest*; subtítulo limpo para o slogan;
>   - Paleta de Roxo Profundo, Verde Terminal e Laranja Queimado para reforçar a atmosfera RPG/fantasia.


- Cadastro de alunos (via XLSX) e professores

> 📁 **Base de alunos**: o arquivo Excel `2o. - Ano.xlsx` já está no projeto e contém lista de estudantes divididos em Turma A e Turma B. O sistema deverá respeitar essa separação ao criar turmas, atividades e relatórios.
- Autenticação: RM + senha gerada a partir de CPF, nascimento e telefone (imutável)
- Validação de usuário GitHub no cadastro
- Divisão em 2 turmas (Turma A e Turma B)
- Registro de presença, conteúdos e ocorrências em aula
- Sistema de pontuação configurável:
  - +1 ponto por presença
  - +2 ponto por atividade entregue no prazo
  - -2 por não entrega
  - -3 por não entrega após fechamento (totalizando -5 de desconto)
  - +1 por bonificação em aula
  - -1 por ocorrências negativas
  - penalidades extras para entregas 15–30d e >30d
- Atividades com data de início, prazo e penalidades graduais (até 15 dias, até 30 dias, >30 dias)
- Entregas por links/commits GitHub; data do commit usada para cálculo de pontuação
- Visualização de histórico de commits ao avaliar (data + mensagem)
- Painel de configuração: pontuações, limites, turmas, conteúdos
- Login único com abas para professor e aluno
- Integração com serviço Waha e infraestrutura via Docker (porta 2026)
- Sistema baseado em níveis com badges e rankings

## 📋 Estrutura de Pontuação (modelo simples)

| Pontos | Nível | Badge               |
|--------|-------|---------------------|
| 100    | Nível 1 | Explorador         |
| 200    | Nível 2 | Aprendiz           |
| 300    | Nível 3 | Programador        |
| 400    | Nível 4 | Mestre das Funções |
| 500    | Nível 5 | Caçador de Bugs    |
| 600    | Nível 6 | Arquiteto          |
| 700    | Nível 7 | Mestre DevQuest    |

### 🏅 Badges Especiais

- 🧠 **Lógico Supremo** – 10 exercícios sem erro
- ⚡ **Speed Coder** – resolver desafio em tempo recorde
- 🐛 **Bug Slayer** – corrigir 20 erros
- 🏆 **Top da Turma** – primeiro lugar no ranking

## 🎨 Paleta de cores

### 1. Paleta de cores do DevQuest

> 🛠️ **Recomendação imediata**: após cada alteração de checklist finalize com um `git commit` e `git push` para manter histórico e permitir seeing progress no container.


| Elemento         | Cor            | Hex      |
|------------------|----------------|----------|
| Cor principal    | Azul Dev       | #1E88E5  |
| Cor secundária   | Roxo XP        | #7B1FA2  |
| Sucesso          | Verde          | #2E7D32  |
| Atenção          | Laranja        | #F9A825  |
| Erro / atraso    | Vermelho       | #C62828  |
| Texto padrão     | Cinza escuro   | #333333  |
| Fundo padrão     | Cinza claro    | #F5F5F5  |

### 2. Cores do Ranking (Top 3)

| Posição          | Cor            | Hex      |
|------------------|----------------|----------|
| 🥇 1º lugar       | Dourado        | #FFD700  |
| 🥈 2º lugar       | Prata          | #C0C0C0  |
| 🥉 3º lugar       | Bronze         | #CD7F32  |
| Demais           | Cinza neutro   | #E0E0E0  |

## ✅ Checklist de Desenvolvimento

> 📌 **Importante:** sempre que um item do checklist for concluído, faça um commit no repositório `https://github.com/hidalgojunior/devquest.git` descrevendo a tarefa finalizada. Isso ajuda a manter histórico claro e rastreável.
>
- [x] **Definir modelo de dados e ER**
  - Mapear entidades (Aluno, Turma, Presença, Atividade, Occorrência, Commit, Configuração, etc.)
  - Desenhar diagrama de relacionamento e atributos necessários.
- [ ] **Configurar ambiente Laravel + MySQL + Docker**
  - Inicializar projeto Laravel.
  - Criar `docker-compose` com serviços PHP, MySQL e, se necessário, Redis/queue.
  - Garantir exposição da porta 2026 no host.
- [ ] **Criar migrações para entidades principais**
  - Implementar migrations para cada tabela do modelo de dados.
  - Incluir chaves estrangeiras e índices.
- [x] **Implementar importação XLSX de alunos**
  - Adicionar upload e parser para arquivos Excel.  
  - Validar dados e persistir registros na base.  
  ✅ Instalada biblioteca maatwebsite/excel e criada implementação `StudentsImport` + comando `php artisan app:import-students {path}` para popular usuários a partir de `2o. - Ano.xlsx` (arquivo renomeado para `alunos.xlsx`).
  > Note: foi adicionada migration para tornar `users.email` *nullable* e remover índice único, permitindo importação sem e-mails.

- [x] **Usar `logo.png` em layouts**
  - Mover o arquivo para `public/images` (ou equivalente) e referenciar em `layouts/app.blade.php`.
  - Exibir no header, formulários de login e tabelas de pontuação.  
  ✅ Logo copiado para `public/images` e layout básico com header já exibindo a imagem.

> 💡 A permissão de armazenamento deve ser corrigida para evitar erros 500 (`tempnam()` no Blade); execute `php artisan optimize:clear` e garanta `storage/` e `bootstrap/cache` graváveis.
- [ ] **Implementar cadastro de alunos e validação GitHub**
  - Formulário para inserção individual e verificação automática do usuário GitHub.
  - Integração com API GitHub ou OAuth para confirmar identidade.

- [x] **Criar interface de upload XLSX**
  - Página protegida onde professores podem selecionar arquivo e enviar.
  - Rota `students/import` adicionada e controller responsável.
  ✅ Upload funcional e feedback de sucesso.

- [x] **Criar seeder de usuário professor**
  - Gera conta `professor@devquest.test` / senha `secret` com role teacher.
- [ ] **Configurar geração de senha imutável**
  - Gerar senha a partir de CPF, data de nascimento e telefone.
  - Armazenar de forma segura (hash) e impedir edições futuras.
- [x] **Autenticação e abas de login**
  - Tela única com abas para professor e aluno.  
  - Gerenciar roles e redirecionamentos após o login.  
  ✅ LoginController simples criado; rotas `/login`, `/logout`, `/dashboard` definidos. View com abas funcional e redirecionamento após auth.
- [ ] **Página de registro e histórico de presença**
  - Interface para marcação de presença por data.
  - Relatórios de faltas e presenças por aluno/turma.
- [ ] **Painel de atividades com prazos e penalidades**
  - CRUD de atividades com campos de data, descrição e regras.
  - Cálculo automático de penalidades 15d/30d/fechamento.
- [ ] **Lógica de cálculo de pontuação configurável**
  - Implementar serviço que aplica regras e valores paramétricos.
  - Interface para ajuste das pontuações.
- [ ] **Visualização de commits para avaliação**
  - Buscar commits do GitHub relacionados à atividade.
  - Exibir lista com data e mensagem para o professor.
- [ ] **Painel de administração (configurações gerais)**
  - Área para ajustar pesos, limites de isenção e controle de turmas.
- [ ] **Gamificação com níveis, badges e ranking**
  - Calcular XP, atribuir níveis e exibir badges.
  - Ranking com cores especiais para top 3.
- [ ] **Integração com Waha**
  - Preparar endpoints ou mecanismos de comunicação com o serviço.
- [ ] **Interface usando Tailwind**
  - Aplicar estilos responsivos e a paleta de cores definida.
- [ ] **Docker-compose com porta 2026**
  - Garantir que todos os containers rodem com mapeamento adequado.
- [ ] **Testes automatizados**
  - Escrever testes unitários e de integração para funcionalidades críticas.



---

> Projeto: **DevQuest**  
> Slogan: *A ferramenta de maldade do professor*  

O checklist acima pode ser atualizado conforme o desenvolvimento avança.