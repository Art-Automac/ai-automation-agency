<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
</main>
<footer class="rodape">
	<div class="container">
		<div class="rodape__topo">
			<div>
				<?php tm_marca(); ?>
				<p><?php echo esc_html( TM_SLOGAN ); ?></p>
			</div>
			<div>
				<h4>Links rápidos</h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/#servicos' ) ); ?>">Serviços</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#clientes' ) ); ?>">Clientes</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#como-funciona' ) ); ?>">Como Funciona</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>">Contato</a></li>
				</ul>
			</div>
			<div>
				<h4>Contato</h4>
				<ul>
					<li><a href="<?php echo esc_url( TM_WHATSAPP_LINK ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> <?php echo esc_html( TM_WHATSAPP_EXIBICAO ); ?></a></li>
					<li><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Minas Gerais — atendemos todo o Brasil</li>
				</ul>
			</div>
		</div>
		<div class="rodape__base">
			<span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Core Agency. Todos os direitos reservados.</span>
			<span>Feito no interior de Minas.</span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
