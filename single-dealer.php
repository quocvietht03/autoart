<?php
/*
 * Single Dealer
 */

get_header();
get_template_part( 'framework/templates/site', 'titlebar');

$d_avatar = get_field('avatar', get_the_ID());
$d_location = get_field('location', get_the_ID());
$map_iframe = get_field('map_iframe', get_the_ID());
$d_phone = get_field('phone', get_the_ID());
$d_email = get_field('email', get_the_ID());
$d_message_link = get_field('message_link', get_the_ID());
$d_whatsapp_link = get_field('whatsapp_link', get_the_ID());

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
    <div class="bt-container">
	    <?php while ( have_posts() ) : the_post(); ?>
	      <div class="bt-post">
					<div class="bt-post--main">
						<div class="bt-main-posts-ss">
							<div class="bt-post--thumbnail">
				        <div class="bt-cover-image">
				          <?php
				            if (has_post_thumbnail()){
				              the_post_thumbnail('full');
				            }
				          ?>
				        </div>
				      </div>

							<h3 class="bt-post--title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>

							<div class="bt-post--meta">
								<?php if(!empty($d_location)) { ?>
									<div class="bt-post--meta-col">
										<div class="bt-post--meta-item">
											<div class="bt-meta-item">
												<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M24.537 17.822C24.38 17.925 24.202 18 24 18H6C5.448 18 5 17.553 5 17V9C5 8.448 5.448 8 6 8H24C24.213 8 24.399 8.081 24.561 8.194L26.963 12.984L24.537 17.822ZM17 28C17 29.104 16.104 30 15 30H13C11.896 30 11 29.104 11 28V20H17V28ZM11 4C11 2.896 11.896 2 13 2H15C16.104 2 17 2.896 17 4V6H11V4ZM28.717 12.224L25.737 6.28201C25.524 6.06901 25.241 5.982 24.962 6H19V4C19 1.791 17.209 0 15 0H13C10.791 0 9 1.791 9 4V6H5C3.896 6 3 6.896 3 8V18C3 19.104 3.896 20 5 20H9V28C9 30.209 10.791 32 13 32H15C17.209 32 19 30.209 19 28V20H25V19.976C25.266 19.982 25.534 19.89 25.737 19.688L28.717 13.745C28.942 13.325 28.972 13.188 29.002 12.984C29.016 12.711 28.927 12.604 28.717 12.224Z"/>
												</svg>
												<?php
													echo '<span class="bt-label">' . esc_html__('Location:', 'autoart') . '</span>';
													echo '<span class="bt-value">' . $d_location . '</span>';
												?>
											</div>
										</div>
									</div>
								<?php } ?>

								<?php if(!empty($d_phone)) { ?>
									<div class="bt-post--meta-col">
										<div class="bt-post--meta-item">
											<div class="bt-meta-item">
												<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path d="M18 2.66669C18 2.66669 21.1113 2.94953 25.0711 6.90933C29.0308 10.8691 29.3137 13.9804 29.3137 13.9804"/>
													<path d="M17.4883 8.83521C17.4883 8.83521 18.8083 9.21234 20.7881 11.1922C22.768 13.1721 23.1452 14.4921 23.1452 14.4921"/>
													<path d="M19.4063 22.1798L20.0136 21.5405L18.5635 20.1631L17.9561 20.8025L19.4063 22.1798ZM22.0119 21.2713L24.5592 22.7375L25.5569 21.0042L23.0096 19.5379L22.0119 21.2713ZM25.0508 25.7774L23.1567 27.7715L24.6068 29.1489L26.5009 27.1547L25.0508 25.7774ZM22.0171 28.4105C20.1037 28.5994 15.1113 28.4382 9.69246 22.7331L8.24235 24.1105C14.1481 30.3282 19.7817 30.6409 22.2135 30.4009L22.0171 28.4105ZM9.69246 22.7331C4.5243 17.2919 3.65739 12.7023 3.54934 10.6892L1.55222 10.7964C1.68455 13.262 2.73146 18.3086 8.24235 24.1105L9.69246 22.7331ZM11.5263 13.8836L11.9087 13.481L10.4585 12.1037L10.0761 12.5063L11.5263 13.8836ZM12.2091 8.46835L10.5278 6.09037L8.89474 7.24499L10.5761 9.62296L12.2091 8.46835ZM4.83714 5.5777L2.74434 7.78102L4.19444 9.15839L6.28724 6.95507L4.83714 5.5777ZM10.8012 13.195C10.0761 12.5063 10.0752 12.5072 10.0743 12.5082C10.074 12.5086 10.073 12.5096 10.0724 12.5102C10.0711 12.5116 10.0698 12.513 10.0685 12.5144C10.0659 12.5172 10.0632 12.5201 10.0604 12.5232C10.0548 12.5294 10.0489 12.536 10.0426 12.5432C10.0302 12.5575 10.0165 12.5739 10.0018 12.5925C9.9725 12.6295 9.93934 12.675 9.90455 12.7294C9.8348 12.8384 9.75915 12.9819 9.69508 13.162C9.56482 13.5281 9.49383 14.0129 9.58253 14.6183C9.75681 15.8078 10.5362 17.4074 12.5727 19.5514L14.0228 18.1741C12.1193 16.1699 11.6504 14.9357 11.5614 14.3283C11.5185 14.0353 11.5621 13.881 11.5793 13.8325C11.589 13.8052 11.5954 13.7976 11.5892 13.8074C11.5862 13.812 11.5802 13.8209 11.5701 13.8336C11.565 13.84 11.559 13.8474 11.5517 13.8557C11.5481 13.8599 11.5442 13.8643 11.5399 13.8689C11.5378 13.8713 11.5356 13.8737 11.5333 13.8761C11.5322 13.8773 11.531 13.8786 11.5299 13.8798C11.5293 13.8805 11.5284 13.8814 11.5281 13.8817C11.5272 13.8827 11.5263 13.8836 10.8012 13.195ZM12.5727 19.5514C14.6032 21.6891 16.1367 22.5295 17.3067 22.7195C17.9071 22.817 18.3931 22.7391 18.7611 22.5941C18.9409 22.5231 19.0832 22.4398 19.19 22.3641C19.2433 22.3262 19.2877 22.2903 19.3235 22.259C19.3415 22.2433 19.3572 22.2286 19.3709 22.2153C19.3779 22.2087 19.3843 22.2023 19.3901 22.1965C19.3931 22.1935 19.3959 22.1906 19.3985 22.1878C19.3999 22.1865 19.4012 22.1851 19.4025 22.1838C19.4032 22.1831 19.4041 22.1821 19.4044 22.1818C19.4053 22.1807 19.4063 22.1798 18.6812 21.4911C17.9561 20.8025 17.9571 20.8015 17.958 20.8006C17.9583 20.8002 17.9592 20.7993 17.9597 20.7986C17.9609 20.7974 17.9621 20.7962 17.9633 20.795C17.9657 20.7926 17.968 20.7902 17.9701 20.7879C17.9747 20.7835 17.9789 20.7793 17.9829 20.7754C17.9909 20.7677 17.9983 20.761 18.0047 20.7554C18.0173 20.7442 18.0268 20.737 18.0329 20.7327C18.0455 20.7238 18.0441 20.7269 18.0272 20.7335C18.0015 20.7437 17.8803 20.7865 17.6273 20.7454C17.0905 20.6582 15.9324 20.1845 14.0228 18.1741L12.5727 19.5514ZM10.5278 6.09037C9.17634 4.17893 6.47204 3.85645 4.83714 5.5777L6.28724 6.95507C6.98436 6.22114 8.2116 6.27879 8.89474 7.24499L10.5278 6.09037ZM3.54934 10.6892C3.52076 10.1568 3.75259 9.62358 4.19444 9.15839L2.74434 7.78102C2.02987 8.53322 1.48683 9.57814 1.55222 10.7964L3.54934 10.6892ZM23.1567 27.7715C22.7847 28.1633 22.3955 28.3731 22.0171 28.4105L22.2135 30.4009C23.2096 30.3025 24.0157 29.7713 24.6068 29.1489L23.1567 27.7715ZM11.9087 13.481C13.1988 12.1228 13.2901 9.99723 12.2091 8.46835L10.5761 9.62296C11.1389 10.4191 11.0526 11.4782 10.4585 12.1037L11.9087 13.481ZM24.5592 22.7375C25.6536 23.3675 25.8679 24.9173 25.0508 25.7774L26.5009 27.1547C28.2408 25.3229 27.7341 22.2574 25.5569 21.0042L24.5592 22.7375ZM20.0136 21.5405C20.5275 20.9994 21.3283 20.8778 22.0119 21.2713L23.0096 19.5379C21.5449 18.6949 19.7284 18.9366 18.5635 20.1631L20.0136 21.5405Z"/>
												</svg>
												<?php
						              echo '<span class="bt-label">' . esc_html__('Phone:', 'autoart') . '</span>';
						              echo '<span class="bt-value">' . $d_phone . '</span>';
						            ?>
											</div>
										</div>
									</div>
								<?php } ?>

								<?php if(!empty($d_email)) { ?>
									<div class="bt-post--meta-col">
										<div class="bt-post--meta-item">
											<div class="bt-meta-item">
												<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
												  <path d="M5.33203 12.0001L13.5987 18.2C15.021 19.2667 16.9764 19.2667 18.3987 18.2L26.6654 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												  <path d="M4 12.2358C4 11.2673 4.52504 10.375 5.37161 9.90468L14.7049 4.71949C15.5104 4.27205 16.4896 4.27205 17.2951 4.71949L26.6284 9.90468C27.4749 10.375 28 11.2673 28 12.2358V22.6667C28 24.1395 26.8061 25.3334 25.3333 25.3334H6.66667C5.19391 25.3334 4 24.1395 4 22.6667V12.2358Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
												</svg>
												<?php
						              echo '<span class="bt-label">' . esc_html__('Email:', 'autoart') . '</span>';
						              echo '<span class="bt-value">' . $d_email . '</span>';
						            ?>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>

							<div class="bt-post--content">
								<?php the_content(); ?>
							</div>
						</div>

						<?php get_template_part( 'framework/templates/car', 'by-dealer-posts'); ?>

						<div class="bt-review-ss">
							<?php
								if(comments_open() || get_comments_number()) {
									comments_template();
								}
							?>
						</div>
					</div>

					<div class="bt-post--sidebar">
						<div class="bt-sidebar-wrap">
				      <div class="bt-sidebar-block bt-contact-block">
								<?php echo do_shortcode('[gravityform id="2" title="true" description="true" ajax="true"]'); ?>
							</div>

							<div class="bt-sidebar-block bt-location-block">
								<h3 class="bt-block-heading">
									<?php echo esc_html__('Dealer Location', 'autoart'); ?>
								</h3>
								<?php if(!empty($d_location)) { ?>
									<div class="bt-location-text">
										<svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M24.537 17.822C24.38 17.925 24.202 18 24 18H6C5.448 18 5 17.553 5 17V9C5 8.448 5.448 8 6 8H24C24.213 8 24.399 8.081 24.561 8.194L26.963 12.984L24.537 17.822ZM17 28C17 29.104 16.104 30 15 30H13C11.896 30 11 29.104 11 28V20H17V28ZM11 4C11 2.896 11.896 2 13 2H15C16.104 2 17 2.896 17 4V6H11V4ZM28.717 12.224L25.737 6.28201C25.524 6.06901 25.241 5.982 24.962 6H19V4C19 1.791 17.209 0 15 0H13C10.791 0 9 1.791 9 4V6H5C3.896 6 3 6.896 3 8V18C3 19.104 3.896 20 5 20H9V28C9 30.209 10.791 32 13 32H15C17.209 32 19 30.209 19 28V20H25V19.976C25.266 19.982 25.534 19.89 25.737 19.688L28.717 13.745C28.942 13.325 28.972 13.188 29.002 12.984C29.016 12.711 28.927 12.604 28.717 12.224Z"/>
										</svg>
										<?php echo '<span>' . $d_location . '</span>'; ?>
									</div>
								<?php } ?>

								<?php if(!empty($map_iframe)) { ?>
			            <div class="bt-location-map">
			              <?php echo '<div class="bt-cover-iframe">' . $map_iframe . '</div>'; ?>
			            </div>
			          <?php } ?>
							</div>
						</div>
					</div>
				</div>
	    <?php endwhile; ?>
    </div>
	</div>
	<?php
	if (function_exists('get_field')) {
		$banner = get_field('dealer_banner_contact', 'options');
		if (!empty($banner)) {
			$id_template = $banner->ID;
			echo do_shortcode('[elementor-template id="' . $id_template . '"]');
		}
	}
	?>
</main><!-- #main -->

<?php get_footer(); ?>
