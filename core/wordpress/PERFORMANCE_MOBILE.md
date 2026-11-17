# Recomendações de Performance Mobile (Google PageSpeed / Lighthouse)

> **Documento de Referência Técnica para a Remodelagem do Site**  
> *Data de registro:* 17/11/2026  
> *Foco:* Otimização para dispositivos móveis (Core Web Vitals - LCP, INP, CLS).

---

## 1. Diagnóstico Identificado pelo Google

O site apresenta ótimo carregamento em desktops, porém no ambiente mobile (onde a CPU e a rede móvel 4G/5G são mais restritas) foi detectado gargalo de processamento decorrente de **JavaScript e CSS não utilizados**.

### A. "Reduza o JavaScript não usado" (Unused JavaScript)
- **Problema:** Plugins e bibliotecas externas carregam scripts pesados em todas as páginas, mesmo quando os recursos desses plugins não são acionados na página inicial ou em telas mobile.
- **Impacto no Mobile:** O processador do smartphone gasta ciclos excessivos parseando e executando JavaScript antes de renderizar o conteúdo ou liberar a tela para toques (aumentando o *Interaction to Next Paint* - INP).

### B. "Reduza o CSS não usado" (Unused CSS)
- **Problema:** Folhas de estilo globais volumosas que bloqueiam a renderização da primeira dobra (*First Contentful Paint* - FCP e *Largest Contentful Paint* - LCP).

---

## 2. Checklist de Ação para a Futura Remodelagem

Quando iniciarmos a reformulação da interface e estrutura do tema, aplicar a seguinte arquitetura:

1. **Auditoria de Plugins via Chrome DevTools Coverage:**
   - Abrir DevTools (`Ctrl + Shift + I` ou `F12`) > Menu de 3 pontos > *More tools* > *Coverage*.
   - Recarregar a página gravando o carregamento para mapear com precisão quais plugins adicionam linhas vermelhas (código não executado).

2. **Desativação de Plugins Redundantes:**
   - Eliminar plugins visuais pesados (page builders que injetam dezenas de dependências) em favor de blocos nativos Gutenberg ou componentes CSS/HTML limpos.

3. **Carregamento Condicional de Assets (`wp_dequeue_script` / `wp_dequeue_style`):**
   - Configurar o `functions.php` para só carregar scripts de formulários, sliders ou widgets nas páginas onde eles realmente existem:
     ```php
     add_action( 'wp_enqueue_scripts', function() {
         if ( ! is_page('contato') ) {
             wp_dequeue_script( 'contact-form-7' );
             wp_dequeue_style( 'contact-form-7' );
         }
     }, 99 );
     ```

4. **Adiar JavaScript Não Crítico (`defer` ou `async`):**
   - Todos os scripts não essenciais para a primeira dobra devem possuir atributo `defer` para não bloquear o parser do DOM no celular.

5. **CSS Crítico Inline & Minificação:**
   - Extrair o CSS da primeira dobra (above-the-fold) para inline no `<head>` e carregar o restante de forma assíncrona.
