<section class="hero" id="inicio">
  <svg class="hero__malha" aria-hidden="true" width="100%" height="100%">
    <defs>
      <pattern id="tmGrade" width="56" height="56" patternUnits="userSpaceOnUse">
        <path d="M56 0H0V56" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="1"></path>
      </pattern>
      <linearGradient id="tmFade" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0%" stop-color="#fff" stop-opacity=".9"></stop>
        <stop offset="100%" stop-color="#fff" stop-opacity="0"></stop>
      </linearGradient>
      <mask id="tmMask"><rect width="100%" height="100%" fill="url(#tmFade)"></rect></mask>
    </defs>
    <rect width="100%" height="100%" fill="url(#tmGrade)" mask="url(#tmMask)"></rect>
  </svg>
  <span class="hero__brilho" aria-hidden="true"></span>
  <div class="container">
    <div class="hero__conteudo">
      <span class="eyebrow">Tecnologia · Automação · Inteligência Artificial</span>
      <h1>Seu negócio inteligente:</h1>
      <p class="hero__sub">tecnologia, automação e inteligência artificial para o seu negócio.</p>
      <p class="hero__apoio">Da automação de WhatsApp à infraestrutura em nuvem — cuidamos da tecnologia pra você focar na escala do seu negócio.</p>
      <div class="hero__botoes">
        <a class="btn btn--laranja btn--grande" href="<?php echo esc_url( TM_WHATSAPP_LINK ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Fale conosco</a>
        <a class="btn btn--fantasma btn--grande" href="#servicos">Conheça os serviços</a>
      </div>
    </div>
  </div>
</section>

<section class="credibilidade">
  <div class="container">
    <ul>
      <li><i class="fa-solid fa-robot" aria-hidden="true"></i> Atendimento 24h com IA</li>
      <li><i class="fa-solid fa-server" aria-hidden="true"></i> Infraestrutura profissional</li>
      <li><i class="fa-solid fa-sliders" aria-hidden="true"></i> Soluções sob medida</li>
      <li><i class="fa-solid fa-headset" aria-hidden="true"></i> Suporte contínuo</li>
    </ul>
  </div>
</section>

<section class="secao secao--cinza" id="problemas">
  <div class="container">
    <div class="cabecalho-secao centro revelar">
      <span class="eyebrow">O que trava seu dia</span>
      <h2>Você se identifica com algum desses problemas?</h2>
      <p>Se marcou pelo menos dois, tem coisa aí que dá pra resolver essa semana.</p>
    </div>
    <div class="grid grid--3">
      <article class="card card--problema revelar"><span class="card__icone"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></span><h3>Perde clientes por não responder rápido no WhatsApp</h3></article>
      <article class="card card--problema revelar"><span class="card__icone"><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i></span><h3>Gasta tempo com tarefas que poderiam ser automáticas</h3></article>
      <article class="card card--problema revelar"><span class="card__icone"><i class="fa-solid fa-server" aria-hidden="true"></i></span><h3>Sistemas e servidores instáveis que caem ou travam</h3></article>
      <article class="card card--problema revelar"><span class="card__icone"><i class="fa-solid fa-plug-circle-xmark" aria-hidden="true"></i></span><h3>Tem ferramentas e sistemas que não conversam entre si</h3></article>
      <article class="card card--problema revelar"><span class="card__icone"><i class="fa-solid fa-chart-pie" aria-hidden="true"></i></span><h3>Falta de visão clara e relatórios da operação em tempo real</h3></article>
      <article class="card card--problema revelar"><span class="card__icone"><i class="fa-solid fa-robot" aria-hidden="true"></i></span><h3>Gargalos no atendimento por falta de inteligência artificial</h3></article>
    </div>
  </div>
</section>

<section class="secao" id="servicos">
  <div class="container">
    <div class="cabecalho-secao revelar">
      <span class="eyebrow">Serviços</span>
      <h2>Tudo que seu negócio precisa, com um parceiro só</h2>
      <p>Você contrata resultado, não ferramenta. A gente cuida da parte técnica de ponta a ponta.</p>
    </div>
    <div class="grupo-servicos">
      <h3 class="grupo-titulo revelar">Tecnologia &amp; Inteligência Artificial</h3>
      <div class="grid grid--3">
        <article class="card revelar"><span class="card__icone"><i class="fa-solid fa-comments" aria-hidden="true"></i></span><h3>Bots de WhatsApp com IA</h3><p>Atendimento automático 24h, pedidos, agendamentos e suporte sem precisar de funcionário.</p></article>
        <article class="card revelar"><span class="card__icone"><i class="fa-solid fa-diagram-project" aria-hidden="true"></i></span><h3>Automação de processos</h3><p>Integração entre sistemas e fim das tarefas manuais repetitivas, com n8n e APIs.</p></article>
        <article class="card revelar"><span class="card__icone"><i class="fa-solid fa-cloud" aria-hidden="true"></i></span><h3>Infraestrutura cloud</h3><p>Servidores, VPS, Docker, monitoramento e manutenção de toda a sua estrutura digital.</p></article>
      </div>
    </div>
    <div class="grupo-servicos">
      <h3 class="grupo-titulo revelar">Gestão &amp; integração</h3>
      <div class="grid grid--3">
        <article class="card revelar"><span class="card__icone"><i class="fa-solid fa-link" aria-hidden="true"></i></span><h3>Integração de sistemas</h3><p>Conecta seu WhatsApp, financeiro, estoque e CRM numa operação só.</p></article>
        <article class="card revelar"><span class="card__icone"><i class="fa-solid fa-chart-pie" aria-hidden="true"></i></span><h3>Relatórios e dashboards</h3><p>Visualize os números do seu negócio em tempo real, de qualquer lugar.</p></article>
        <article class="card revelar"><span class="card__icone"><i class="fa-solid fa-compass-drafting" aria-hidden="true"></i></span><h3>Consultoria digital</h3><p>Diagnóstico completo e plano de ação pra digitalizar sua operação.</p></article>
      </div>
    </div>
  </div>
</section>

<section class="secao secao--cinza" id="como-funciona">
  <div class="container">
    <div class="cabecalho-secao centro revelar">
      <span class="eyebrow">Como funciona</span>
      <h2>Três passos e sua operação muda</h2>
    </div>
    <div class="passos">
      <article class="passo revelar"><span class="passo__num" aria-hidden="true"></span><i class="fa-solid fa-comments" aria-hidden="true"></i><h3>Você nos conta o problema</h3><p>Uma conversa no WhatsApp já basta pra entender o que está travando.</p></article>
      <article class="passo revelar"><span class="passo__num" aria-hidden="true"></span><i class="fa-solid fa-gears" aria-hidden="true"></i><h3>A gente monta a solução certa</h3><p>Nada de pacote pronto: o desenho é feito em cima da sua operação.</p></article>
      <article class="passo revelar"><span class="passo__num" aria-hidden="true"></span><i class="fa-solid fa-rocket" aria-hidden="true"></i><h3>Seu negócio começa a funcionar melhor</h3><p>Colocamos no ar, acompanhamos os números e ajustamos junto com você.</p></article>
    </div>
    <div class="centro-acao revelar">
      <a class="btn btn--laranja btn--grande" href="<?php echo esc_url( TM_WHATSAPP_LINK ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Quero começar agora</a>
    </div>
  </div>
</section>

<section class="secao" id="para-quem">
  <div class="container">
    <div class="cabecalho-secao centro revelar">
      <span class="eyebrow">Para quem é</span>
      <h2>Atendemos negócios de todos os tamanhos</h2>
    </div>
    <ul class="publico">
      <li class="revelar"><i class="fa-solid fa-store" aria-hidden="true"></i><div><strong>Comércio local</strong><span>Farmácias, restaurantes e lojas</span></div></li>
      <li class="revelar"><i class="fa-solid fa-briefcase" aria-hidden="true"></i><div><strong>Prestadores de serviço</strong><span>Clínicas, salões e escritórios</span></div></li>
      <li class="revelar"><i class="fa-solid fa-bed" aria-hidden="true"></i><div><strong>Pousadas e turismo</strong><span>Reservas, check-in e atendimento</span></div></li>
      <li class="revelar"><i class="fa-solid fa-industry" aria-hidden="true"></i><div><strong>Indústria e agronegócio</strong><span>Controle, integração e relatórios</span></div></li>
      <li class="revelar"><i class="fa-solid fa-landmark" aria-hidden="true"></i><div><strong>Órgãos públicos e prefeituras</strong><span>Atendimento ao cidadão e automação</span></div></li>
      <li class="revelar"><i class="fa-solid fa-seedling" aria-hidden="true"></i><div><strong>Startups e empresas em crescimento</strong><span>Estrutura que acompanha a escala</span></div></li>
    </ul>
  </div>
</section>

<section class="secao secao--cinza" id="sobre">
  <div class="container">
    <div class="sobre">
      <div class="revelar">
        <span class="eyebrow">Sobre a empresa</span>
        <h2>Quem está por trás da nossa agência</h2>
        <p>Nascemos no interior de Minas Gerais com uma missão simples: levar tecnologia de verdade pra negócios de qualquer tamanho, em qualquer lugar.</p>
        <p>Combinamos experiência em infraestrutura cloud, automação de processos e inteligência artificial pra ser o parceiro tecnológico completo que sua empresa precisa.</p>
      </div>
      <aside class="selo revelar">
        <i class="fa-solid fa-mountain-sun" aria-hidden="true"></i>
        <strong>Do interior de Minas pra todo o Brasil</strong>
        <span>Atendimento remoto, presença de verdade.</span>
      </aside>
    </div>
  </div>
</section>

<section class="secao" id="clientes">
  <div class="container">
    <div class="cabecalho-secao centro revelar">
      <span class="eyebrow">Casos Reais</span>
      <h2>Clientes que confiam em nosso trabalho</h2>
      <p>Infraestrutura robusta, automações de alto impacto e inteligência artificial aplicadas na prática.</p>
    </div>
    <div class="grid grid--3">
      <article class="card card--cliente revelar">
        <span class="card__icone"><i class="fa-solid fa-car-tunnel" aria-hidden="true"></i></span>
        <span class="card__tag">Lava-Rápidos</span>
        <h3>Lava Aê</h3>
        <p class="card__ramo">Sistema de atendimento e agendamentos para lava rápidos.</p>
        <div class="card__entregas">
          <h4>O que implementamos:</h4>
          <ul>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Infraestrutura Swarm</li>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Monitoramento contínuo</li>
          </ul>
        </div>
      </article>

      <article class="card card--cliente revelar">
        <span class="card__icone"><i class="fa-solid fa-calculator" aria-hidden="true"></i></span>
        <span class="card__tag">Contabilidade &amp; SaaS</span>
        <h3>Voy Solutions</h3>
        <p class="card__ramo">Sistema de contabilidade para empresas.</p>
        <div class="card__entregas">
          <h4>O que implementamos:</h4>
          <ul>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Infraestrutura Swarm</li>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Monitoramento contínuo</li>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Chatbot com IA</li>
          </ul>
        </div>
      </article>

      <article class="card card--cliente revelar">
        <span class="card__icone"><i class="fa-solid fa-wheat-awn" aria-hidden="true"></i></span>
        <span class="card__tag">Agronegócio &amp; Pecuária</span>
        <h3>Cria Certo</h3>
        <p class="card__ramo">Sistema de manejo e controle de rebanho de bovinos.</p>
        <div class="card__entregas">
          <h4>O que implementamos:</h4>
          <ul>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Infraestrutura Swarm</li>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> Monitoramento contínuo</li>
          </ul>
        </div>
      </article>
    </div>
  </div>
</section>

<section class="secao cta" id="contato">
  <svg class="cta__malha" aria-hidden="true" width="100%" height="100%"><rect width="100%" height="100%" fill="url(#tmGrade)"></rect></svg>
  <div class="container revelar">
    <h2>Pronto pra transformar seu negócio?</h2>
    <p>Fale com a gente agora e receba uma análise gratuita da sua operação.</p>
    <a class="btn btn--laranja btn--grande" href="<?php echo esc_url( TM_WHATSAPP_LINK ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Falar no WhatsApp</a>
  </div>
</section>
