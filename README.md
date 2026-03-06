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

## ✅ Funcionalidades concluídas

> 📌 **Lembrete:** registre cada conclusão com um commit descritivo.

- Modelo de dados e ER definido; migrações criadas.
- Importação XLSX de alunos operacional, com `StudentsImport` e arquivo inicial.
- Cadastro de alunos com validação GitHub e senha imutável.
- Seeder de professor implementado.
- Autenticação com abas para aluno/professor funcionando.
- Marca textual (`DevQuest`) adotada em todas as telas.
- Dashboard e navegação concluídos (sidebar direita, off‑canvas, responsivo).
- Dashboard e navegação refinados com contraste melhorado (itens cinza corrigidos).
- Lógica de pontuação configurável, com painel para ajustes.
- CRUD de atividades completo, incluindo visibilidade, rascunho, escopo e penalidades.
- Controle de QR Code por turma; presenças gravam tópico e material.
- Histórico de submissões e commits integrado.
- Ranking, níveis e badges implementados com destaque a top3.
- Configurações administrativas funcionando.
- Internacionalização removida, fuso/locale fixos.
- Modo escuro funcional com persistência via `localStorage`.

## 🛠️ Pendências e prioridades

### Alta prioridade
1. Escrever testes automáticos (unitários + integração) para fluxos críticos.
2. Organizar commits/limpar alterações não comitadas (`git status`).
3. Finalizar Docker‑compose e documentação para porta 2026.

### Média prioridade
1. Implementar integração com Waha (se necessário).
2. Adicionar suporte a upload de material na aula (PDF, links).
3. Refinar responsividade e UI (overlays, iconografia e microinterações).

### Baixa prioridade
1. Desenvolver relatórios extras e notificações.
2. Refatorar componentes Blade em `<x-*`> para reuso.
3. Otimizar performance e limpar código legado.

> 🔍 **Nota:** itens estão ordenados por urgência; foco inicial nos testes e estabilidade.
  - Aplicar estilos responsivos e a paleta de cores definida.
  > ⚙️ Para gerar assets e evitar `ViteManifestNotFoundException`, execute `npm install && npm run build` dentro do container (já foi feito).
- [ ] **Docker-compose com porta 2026**
  - Garantir que todos os containers rodem com mapeamento adequado.
- [ ] **Testes automatizados**
  - Escrever testes unitários e de integração para funcionalidades críticas.



---

> Projeto: **DevQuest**  
> Slogan: *A ferramenta de maldade do professor*  

O checklist acima pode ser atualizado conforme o desenvolvimento avança.