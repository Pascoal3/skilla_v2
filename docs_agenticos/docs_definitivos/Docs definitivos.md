Quero criar um projeto com memória, para isso quero que tenha esses docs a baixo, precisa ficar na pasta que já está dentro do projeto da skilla: skilla_v2\docs_agenticos, quero um prompt para que o opencode, que tem acesso total ao projeto (pasta) analise o projeto inteiro e a pasta do segundo cérebro da skilla: skilla_v2\docs_agenticos\skilla_segundo_cerebro_v1 no modo read-only, no segundo cérebro contém todas as info do projeto até agora, descrição, diagramas e tudo mais, quero que o opencode crie os docs agenticos para que a skilla seja um projeto com memória, preciso do prompt, na pasta docs_agenticos/docs já tem o documentation_guide e o README que explicam como o projeto com memórica funciona, regras de formatação e etc. Quero que ele leia e entenda o projeto e crie os docs apresentados abaixo para a skilla:

-  PRD
- TRD 
- MVP escope 
- User flow
- ADR
- UI plan
- Dev plan
- Architecture Document
- Tech stack
- Coding standards 
- API specification
- Database Schema
- Banco de dados DBML
- Roadmap
- Changelog 
- Security Guidelines 
- Regras de negócio 
- Business Logic Security 
- Data Mapping
- Data Dictionary
- Screen Mapping
- Screen Specification
- Component Library
- Environment Specification
- Documentation Guide

A estrutura do LLM wiki:

README.md
documentation_guide.md

00-validation/
    └── market-reasearch.md
    └── benchmark.md
    └── opportunities.md

01-product/
    └── PRD.md
    └── MVP-scope.md
    └── functional-requirements.md
    └── non-functional-requirements.md
    └── business-rules.md
    └── business-logic-security.md
    └── user-flow.md
    └── use-cases.md

02-architeture/
    └── TRD.md
    └── architeture-document.md
    └── tech-stack.md
    └── dev-plan.md
    └── coding-standards.md
    └── security-guidelines.md
    └── ADRs/
        └── 0001-use-x.md
        └── 0002-use-y.md
        └── 0001-use-z.md


03-data/
    └── database-schema.md
    └── database-dbml.md
    └── data-mapping.md
    └── data-dictionary.md

04-api/
    └── api-specification.md

05-design/
    └── ui-plan.md
    └── screen-mapping.md
    └── screen-specification.md
    └── component-library.md

06-environment/
    └── environment-specification.md

07-maintenance/
    └── changelog.md







