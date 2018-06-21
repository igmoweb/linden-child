<?php

add_action( 'admin_menu', 'linden_child_register_docs_page', 20 );
function linden_child_register_docs_page() {
	add_theme_page( 'Documentación', 'Documentación', 'edit_theme_options', 'linden-child-docs', 'linden_child_render_docs_page' );
	remove_submenu_page( 'themes.php', 'start-page.php' );
}

function linden_child_render_docs_page() {
	$customize_url = wp_customize_url();
	$admin_url = trailingslashit( admin_url() );
	$template_url = trailingslashit( get_stylesheet_directory_uri() );
	$site_url = trailingslashit( get_site_url() );
	?>
	<div class="wrap">
		<h1><?php echo get_admin_page_title(); ?></h1>
		<ol class="linden-docs-index">
			<li><a href="#pagina-inicio">Configurar página de inicio</a></li>
			<li><a href="#contenido-pie">Contenido del pie de página</a></li>
			<li><a href="#pagina-contacto">Página de contacto</a></li>
			<li>
				<a href="#proyectos">Cómo añadir proyectos</a>
				<ul>
					<li><a href="#tipos-de-proyecto">Tipos de proyecto</a></li>
					<li><a href="#diferencias-video-imagen">Diferencias entre proyectos de imagen o vídeo</a></li>
				</ul>
			</li>
			<li>
				<a href="#clientes">Cómo añadir clientes</a>
			</li>
			<li>
				<a href="#menus">Menús</a>
				<ul>
					<li><a href="#menu-principal">Menú Principal</a></li>
					<li><a href="#menu-social">Menú Social</a></li>
				</ul>
			</li>
		</ol>

		<div class="linden-docs-content">
			<div class="linden-docs-section">
				<h2 id="pagina-inicio">Configurar página de inicio</h2>

				<p>Menu: <code><a target="_blank" href="<?php echo esc_url( $customize_url ); ?>">Apariencia > Personalizar</a></code></p>
				<p>Haz click en <code>Opciones del Tema</code> y sube un vídeo y una imagen de portada. La imagen sólo se mostrará mientras el vídeo carga, no es obligatoria.</p>
			</div>
			<div class="linden-docs-section">
				<h2 id="contenido-pie">Contenido del pie de página</h2>

				<p>El pie de página se muestra en todas las páginas excepto en la portada.</p>
				<p>
					<img src="<?php echo esc_url( $template_url . 'images/footer-screenshot.png' ); ?>" alt="">
				</p>
				<p>
					Se compone de varias partes:
				</p>
				<ul>
					<li><strong>Nombre del sitio</strong>: Configurable en <a href="<?php echo esc_url( $admin_url . 'options-general.php' ); ?>" target="_blank">Ajustes Generales</a></li>
					<li><strong>Descripción del sitio</strong>: Configurable en <a href="<?php echo esc_url( $admin_url . 'options-general.php' ); ?>" target="_blank">Ajustes Generales</a></li>
					<li><strong>Email del administrador</strong>: Configurable en <a href="<?php echo esc_url( $admin_url . 'options-general.php' ); ?>" target="_blank">Ajustes Generales</a></li>
					<li><strong>Teléfono</strong>: Configurable en <a href="<?php echo esc_url( $admin_url . 'options-general.php' ); ?>" target="_blank">Ajustes Generales</a></li>
					<li><strong>Menú social</strong>: Ver <a href="#menu-social">Menú social</a></li>
				</ul>
			</div>
			<div class="linden-docs-section">
				<h2 id="pagina-contacto">Página de contacto</h2>
				<p>
					La página de contacto es una página normal que puedes crear en <code><a target="_blank" href="<?php echo $admin_url . 'edit.php?post_type=page'; ?>">Páginas</a></code> pero que sólo tiene la particularidad de que hay que seleccionar como plantilla de página <i>Contact</i>
					<img src="<?php echo esc_url( $template_url . 'images/pagina-contacto.png' ); ?>" alt="">
				</p>
				<p>
					Además la imagen destacada de la página debe ser lo más cuadrada posible. De otra forma puede que no se muestre correctamente.
				</p>
				<p>
					Para añadir la página al menú de navegación, ver <code><a href="#menu-principal">Menú Principal</a></code>
				</p>
			</div>

			<div class="linden-docs-section">
				<h2 id="proyectos">Cómo añadir proyectos</h2>
				<p>
					Asegúrate de que el tipo portfolio está activado en <a href="<?php echo esc_url( $admin_url . 'admin.php?page=jetpack#/settings' ); ?>" target="_blank">los ajustes de Jetpack</a>. Una vez ahí, busca <i>portfolios</i> y actívalos
				</p>
				<p>
					<img src="<?php echo esc_url( $template_url . 'images/portfolios-screenshot.png' ); ?>" alt="">
				</p>
				<p>
					Una vez activados podrás acceder a <code><a href="<?php echo esc_url( $admin_url . 'edit.php?post_type=jetpack-portfolio' ); ?>" target="_blank">Portfolio</a></code> y crear proyectos.
				</p>
				<p>
					Para acceder a la lista de proyectos, ver <a href="#menu-principal">Menú Principal</a>
				</p>

				<h3 id="tipos-de-proyecto">Tipos de proyecto</h3>
				<p>Los proyectos se pueden categorizar usando <code><a href="<?php echo $admin_url . 'edit-tags.php?taxonomy=jetpack-portfolio-type&post_type=jetpack-portfolio' ?>" target="_blank">Tipos de proyecto</a></code></p>
				<p>Una vez creados unos Tipos de Proyectos podrás asignar proyectos a dichas categorías para luego mostrarlas en el Menú Principa (ver
					<a href="#menu-principal">Menú Principal</a>)</p>
				<p><strong>Es importante categorizar todos los proyectos</strong>. En otro caso puede que no salgan todos en los listados.</p>

				<h3 id="diferencias-video-imagen">Diferencias entre proyectos de imagen o vídeo</h3>
				<h4>Proyectos sólo con imagen</h4>
				<p>Si el proyecto consta sólo de imágenes pero no incluye ningún vídeo, los estilos varían pero es necesario ajustar algunas cosas:</p>
				<ol>
					<li>
						Una vez creado el proyecto con título y contenido, selecciona <i>Imagen</i> en la caja <i>Formato</i>
						<img src="<?php echo esc_url( $template_url . 'images/formato-screenshot.png' ); ?>" alt="">
					</li>
					<li>
						Selecciona una imagen destacada para el proyecto
						<img src="<?php echo esc_url( $template_url . 'images/imagen-destacada-screenshot.png' ); ?>" alt="">
					</li>
				</ol>
				<h4>Proyectos con vídeo de Vimeo</h4>
				<p>Si el proyecto incluye un vídeo también es necesario ajustar algunos campos:</p>
				<ol>
					<li>
						Una vez creado el proyecto con título y contenido, selecciona <i>Estandar</i> en la caja <i>Formato</i>
						<img src="<?php echo esc_url( $template_url . 'images/formato-2-screenshot.png' ); ?>" alt="">
					</li>
					<li>
						Selecciona una imagen destacada para el proyecto. Ésta sólo se verá en el listado de proyectos.
						<img src="<?php echo esc_url( $template_url . 'images/imagen-destacada-screenshot.png' ); ?>" alt="">
					</li>
					<li>
						Pega la URL del vídeo de Vimeo
						<img src="<?php echo esc_url( $template_url . 'images/vimeo-screenshot.png' ); ?>" alt="">
					</li>
				</ol>

			</div>
			<div class="linden-docs-section">
				<h2 id="clientes">Cómo añadir clientes</h2>
				<p>
					Añadir clientes es parecido a añadir proyectos. Simplemente crea nuevos clientes en <a target="_blank" href="<?php echo esc_url( $admin_url . 'edit.php?post_type=cliente' ) ?>">Clientes</a>.
					Cada cliente debe incluir un título y una imagen destacada.
				</p>
				<p>El listado de clientes aparecerá en <a target="_blank" href="<?php echo esc_url( $site_url . '/clientes' ) ?>"><?php echo esc_url( $site_url . 'clientes' ) ?></a></p>
				<p>Para añadirlo al menú, ver <code><a href="#menu-principal">Menú Principal</a></code></p>
			</div>
			<div class="linden-docs-section">
				<h2 id="menus">Menús</h2>
				<p>Para editar los menús ir a <a href="<?php echo esc_url( $customize_url ); ?>">Personalizar</a> y luego hacer click en menús.</p>
				<h3 id="menu-principal">Menú Principal</h3>
				<p>Este es el menú de arriba y del centro en el caso de la portada.</p>
				<ol>
					<li>
						Haz click en el menú que estéfijado en <i>Primary Menú</i>. Si no hay ninguno puedes crear uno nuevo y asignarlo a la  ubicación <i>Primary Menú</i>
						<img src="<?php echo esc_url( $template_url . 'images/menu-1-screenshot.png' ); ?>" alt="">
					</li>
					<li>
						Para añadir <strong>Tipos de proyectos al menú:</strong>
						<img src="<?php echo esc_url( $template_url . 'images/tipo-proyecto-menu.gif' ); ?>" alt="">
					</li>
					<li>
						Para añadir <strong>Clientes al menú:</strong>
						<img src="<?php echo esc_url( $template_url . 'images/clientes-menu.gif' ); ?>" alt="">
					</li>
					<li>
						De la misma forma se pueden <strong>añadir páginas</strong>
						<img src="<?php echo esc_url( $template_url . 'images/paginas-menu.gif' ); ?>" alt="">
					</li>
				</ol>
				<p>Una vez terminado, hacer click en publicar.</p>

				<h3 id="menu-social">Menu Social</h3>
				<p>Es muy parecido al menú principal pero los elementos a añadir son distintos.</p>
				<ol>
					<li>
						Antes de nada, hay que crear otro nuevo menú y asegurarse de que está marcado para la ubicación "Menú Social". (El GIF está partido en 2 por motivos de seguridad)
						<img src="<?php echo esc_url( $template_url . 'images/crear-menu-social-1.gif' ); ?>" alt="">
						<img src="<?php echo esc_url( $template_url . 'images/crear-menu-social-2.gif' ); ?>" alt="">
					</li>
					<li>
						Ahora añadimos un elemento de tipo <i>Enlace personalizado</i> en el menú pero poniendo la URL de la red social. Éste se reemplazará por un icono en el pie de página.
						<img src="<?php echo esc_url( $template_url . 'images/crear-menu-social-3.gif' ); ?>" alt="">
					</li>
				</ol>
			</div>
		</div>
	</div>

	<style>
		ol.linden-docs-index > li {
			line-height: 28px;
			font-size:16px;
		}

		ol.linden-docs-index li > ul {
			margin-left:2rem;
			margin-top: 6px;
			list-style: circle;
		}

		.linden-docs-section ul {
			margin-left:2rem;
			list-style: disc;
		}

		.linden-docs-content .linden-docs-section {
			background: white;
			padding: 20px;
			margin-bottom: 40px;
			border: 1px solid lightgrey;
		}

		.linden-docs-content .linden-docs-section > h2 {
			text-align: center;
			font-size: 20px;
			margin: -20px -20px 0 -20px;
			line-height: 26px;
			padding: 10px;
			border-bottom: 1px solid lightgrey;
		}

		.linden-docs-content .linden-docs-section > h3 {
			margin: 2rem 0;
		}

		.linden-docs-content img {
			border:1px solid lightgrey;
			display: block;
			margin: 25px auto;
			max-width:100%;
		}
	</style>
	<?php
}
