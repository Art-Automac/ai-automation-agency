(function(){
  'use strict';
  var cab=document.querySelector('.cabecalho');
  function aoRolar(){if(cab)cab.classList.toggle('rolando',window.scrollY>10);}
  window.addEventListener('scroll',aoRolar,{passive:true});aoRolar();
  var bt=document.querySelector('.abre-menu'),mn=document.querySelector('.menu');
  if(bt&&mn){bt.addEventListener('click',function(){var a=mn.classList.toggle('aberto');bt.setAttribute('aria-expanded',a?'true':'false');});mn.addEventListener('click',function(e){if(e.target.tagName==='A'){mn.classList.remove('aberto');bt.setAttribute('aria-expanded','false');}});}
  var alvos=document.querySelectorAll('.revelar');
  if(!('IntersectionObserver' in window)){alvos.forEach(function(el){el.classList.add('visivel');});return;}
  var obs=new IntersectionObserver(function(ent){ent.forEach(function(e){if(e.isIntersecting){e.target.classList.add('visivel');obs.unobserve(e.target);}});},{threshold:.12,rootMargin:'0px 0px -60px 0px'});
  alvos.forEach(function(el,i){el.style.transitionDelay=(Math.min(i%6,5)*70)+'ms';obs.observe(el);});
})();
