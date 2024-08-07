!(function ($) {
	"use strict";

	/* Toggle submenu align */
	function AutoArtSubmenuAuto() {
		if ($('.bt-site-header .bt-container').length > 0) {
			var container = $('.bt-site-header .bt-container'),
				containerInfo = { left: container.offset().left, width: container.innerWidth() },
				contLeftPos = containerInfo.left,
				contRightPos = containerInfo.left + containerInfo.width;

			$('.children, .sub-menu').each(function () {
				var submenuInfo = { left: $(this).offset().left, width: $(this).innerWidth() },
					smLeftPos = submenuInfo.left,
					smRightPos = submenuInfo.left + submenuInfo.width;

				if (smLeftPos <= contLeftPos) {
					$(this).addClass('bt-align-left');
				}

				if (smRightPos >= contRightPos) {
					$(this).addClass('bt-align-right');
				}

			});
		}
	}

	/* Toggle menu mobile */
	function AutoArtToggleMenuMobile() {
		$('.bt-site-header .bt-menu-toggle').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('bt-menu-open')) {
				$(this).addClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').addClass('bt-is-active');
			} else {
				$('.bt-menu-open').removeClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').removeClass('bt-is-active');
			}
		});
	}

	/* Toggle sub menu mobile */
	function AutoArtToggleSubMenuMobile() {
		var hasChildren = $('.bt-site-header .page_item_has_children, .bt-site-header .menu-item-has-children');

		hasChildren.each(function () {
			var $btnToggle = $('<div class="bt-toggle-icon"></div>');

			$(this).append($btnToggle);

			$btnToggle.on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('bt-is-active');
				$(this).parent().children('ul').toggle();
			});
		});
	}

	/* Tabs */
	function AutoArtTabs() {
		if ($('.bt-tabs-js').length > 0) {
			$('.bt-tabs-js .bt-nav-item').on('click', function (e) {
				e.preventDefault();
				$(this).addClass('bt-is-active').siblings().removeClass('bt-is-active');
				$($.attr(this, 'href')).addClass('bt-is-active').siblings().removeClass('bt-is-active');
			});
		}
	}

	/* Gallery Carousel */
	function AutoArtGallerCarousel() {
		if ($('.js-gallery-carousel').length > 0) {
			$('.js-gallery-carousel').slick({
				slidesToShow: 2,
				slidesToScroll: 1,
				arrows: true,
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
		}
	}

	/* Gallery Slider */
	function AutoArtGallerSlider() {
		if ($('.js-gallery-slider').length > 0) {
			$('.js-gallery-slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				asNavFor: '.js-gallery-slider-nav',
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
			$('.js-gallery-slider-nav').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				asNavFor: '.js-gallery-slider-for',
				responsive: [
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 3
						}
					}
				]
			});
		}
	}

	/* Close section */
	function AutoArtCloseSection() {
		if ($('.bt-close-btn').length > 0) {
			$('.bt-close-btn').on('click', function (e) {
				e.preventDefault();

				$(this).parents('.e-parent').hide();
			});
		}
	}

	/* Select2 */
	function AutoArtSelect2() {
		if ($('select.gfield_select').length > 0) {
			$('select.gfield_select').select2();
		}
	}

	/* Set cookie */
	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	/* Get cookie */
	function getCookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	/* Car wishlist */
	function AutoArtCarWishlist() {
		if ($('.bt-car-wishlist-btn').length > 0) {
			$('.bt-car-wishlist-btn').on('click', function (e) {
				e.preventDefault();

				var post_id = $(this).data('id').toString(),
					wishlist_cookie = getCookie('carwishlistcookie');

				if (wishlist_cookie == '') {
					setCookie('carwishlistcookie', post_id, 7);
					$(this).addClass('added');
					$('.bt-carwishlistcookie').val(post_id);
				} else {
					var wishlist_arr = wishlist_cookie.split(',');

					if (wishlist_arr.includes(post_id)) {
						window.location.href = '/cars-wishlist/';
					} else {
						setCookie('carwishlistcookie', wishlist_cookie + ',' + post_id, 7);
						$(this).addClass('added');
						$('.bt-carwishlistcookie').val(wishlist_cookie + ',' + post_id);
					}
				}

				$('#bt-mini-wishlist-form').submit();
				$('.bt-cars-wishlist-form').submit();
			});
		}

		if ($('.elementor-widget-bt-cars-wishlist').length > 0) {
			$('.bt-car-remove-wishlist').on('click', function (e) {
				e.preventDefault();

				$(this).addClass('deleting');

				var car_id = $(this).data('id').toString(),
					wishlist_str = $('.bt-carwishlistcookie').val(),
					wishlist_arr = wishlist_str.split(','),
					index = wishlist_arr.indexOf(car_id);

				if (index > -1) {
					wishlist_arr.splice(index, 1);
				}

				wishlist_str = wishlist_arr.toString();
				$('.bt-carwishlistcookie').val(wishlist_str);
				setCookie('carwishlistcookie', wishlist_str, 7);
				$('#bt-mini-wishlist-form').submit();
				$('.bt-cars-wishlist-form').submit();

				$('.bt-car-wishlist-btn[data-id="' + car_id + '"]').removeClass('added');
			});

			// Ajax wishlist
			$('.bt-cars-wishlist-form').submit(function () {
				var param_ajax = {
					action: 'autoart_cars_wishlist',
					carwishlistcookie: $('.bt-carwishlistcookie').val()
				};

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: AJ_Options.ajax_url,
					data: param_ajax,
					context: this,
					beforeSend: function () {
						$('.bt-table--body').addClass('loading');
					},
					success: function (response) {
						if (response.success) {
							// console.log(response.data);
							setTimeout(function () {
								$('.bt-mini-wishlist--count').text(response.data['count']);
								$('.bt-car-list').html(response.data['items']).fadeIn('slow');
								$('.bt-table--body').removeClass('loading');

								$('.bt-car-remove-wishlist').on('click', function (e) {
									e.preventDefault();

									$(this).addClass('deleting');

									var car_id = $(this).data('id').toString(),
										wishlist_str = $('.bt-carwishlistcookie').val(),
										wishlist_arr = wishlist_str.split(','),
										index = wishlist_arr.indexOf(car_id);

									if (index > -1) {
										wishlist_arr.splice(index, 1);
									}

									wishlist_str = wishlist_arr.toString();
									$('.bt-carwishlistcookie').val(wishlist_str);
									setCookie('carwishlistcookie', wishlist_str, 7);
									$('#bt-mini-wishlist-form').submit();
									$('.bt-cars-wishlist-form').submit();

									$('.bt-car-wishlist-btn[data-id="' + car_id + '"]').removeClass('added');
								});
							}, 500);

						} else {
							console.log('error');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log('The following error occured: ' + textStatus, errorThrown);
					}
				});

				return false;
			});
		}

		if ($('.elementor-widget-bt-mini-wishlist').length > 0) {
			$('.bt-car-remove-mini-wishlist').on('click', function (e) {
				e.preventDefault();

				$(this).addClass('deleting');

				var car_id = $(this).data('id').toString(),
					wishlist_str = $('.bt-carwishlistcookie').val(),
					wishlist_arr = wishlist_str.split(','),
					index = wishlist_arr.indexOf(car_id);

				if (index > -1) {
					wishlist_arr.splice(index, 1);
				}

				wishlist_str = wishlist_arr.toString();
				$('.bt-carwishlistcookie').val(wishlist_str);
				setCookie('carwishlistcookie', wishlist_str, 7);
				$('#bt-mini-wishlist-form').submit();
				$('.bt-cars-wishlist-form').submit();

				$('.bt-car-wishlist-btn[data-id="' + car_id + '"]').removeClass('added');
			});

			// Ajax wishlist
			$('#bt-mini-wishlist-form').submit(function () {
				var param_ajax = {
					action: 'autoart_mini_wishlist',
					carwishlistcookie: $('.bt-carwishlistcookie').val()
				};

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: AJ_Options.ajax_url,
					data: param_ajax,
					context: this,
					beforeSend: function () {
						$('.bt-mini-wishlist--inner').addClass('loading');
					},
					success: function (response) {
						if (response.success) {
							// console.log(response.data);
							setTimeout(function () {
								$('.bt-mini-wishlist--count').text(response.data['count']);
								$('.bt-mini-wishlist--list').html(response.data['items']).fadeIn('slow');
								$('.bt-mini-wishlist--inner').removeClass('loading');

								$('.bt-car-remove-mini-wishlist').on('click', function (e) {
									e.preventDefault();

									$(this).addClass('deleting');

									var car_id = $(this).data('id').toString(),
										wishlist_str = $('.bt-carwishlistcookie').val(),
										wishlist_arr = wishlist_str.split(','),
										index = wishlist_arr.indexOf(car_id);

									if (index > -1) {
										wishlist_arr.splice(index, 1);
									}

									wishlist_str = wishlist_arr.toString();
									$('.bt-carwishlistcookie').val(wishlist_str);
									setCookie('carwishlistcookie', wishlist_str, 7);
									$('#bt-mini-wishlist-form').submit();
									$('.bt-cars-wishlist-form').submit();

									$('.bt-car-wishlist-btn[data-id="' + car_id + '"]').removeClass('added');
								});
							}, 500);

						} else {
							console.log('error');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log('The following error occured: ' + textStatus, errorThrown);
					}
				});

				return false;
			});
		}
	}

	/* Car compare */
	function AutoArtCarCompare() {
		if ($('.bt-car-compare-btn').length > 0) {
			$('.bt-car-compare-btn').on('click', function (e) {
				e.preventDefault();

				var post_id = $(this).data('id').toString(),
					compare_cookie = getCookie('carcomparecookie'),
					count = 0;

				if (compare_cookie == '') {
					setCookie('carcomparecookie', post_id, 7);
					$(this).addClass('added');
					count = 1;
				} else {
					var compare_arr = compare_cookie.split(',');

					if (compare_arr.includes(post_id)) {
						window.location.href = '/cars-compare/';
					} else {
						setCookie('carcomparecookie', compare_cookie + ',' + post_id, 7);
						$(this).addClass('added');

						count = compare_arr.length + 1;
					}
				}

				$('.bt-mini-compare--count').text(count);
				$('.bt-cars-compare-form').submit();
			});
		}

		if ($('.elementor-widget-bt-cars-compare').length > 0) {
			$('.bt-car-remove-compare').on('click', function (e) {
				e.preventDefault();

				$(this).addClass('deleting');

				var car_id = $(this).data('id').toString(),
					compare_str = $('.bt-carcomparecookie').val(),
					compare_arr = compare_str.split(','),
					index = compare_arr.indexOf(car_id);

				if (index > -1) {
					compare_arr.splice(index, 1);
				}

				compare_str = compare_arr.toString();
				$('.bt-carcomparecookie').val(compare_str);
				setCookie('carcomparecookie', compare_str, 7);
				$('.bt-cars-compare-form').submit();

				$('.bt-car-compare-btn[data-id="' + car_id + '"]').removeClass('added');
			});

			// Ajax compare
			$('.bt-cars-compare-form').submit(function () {
				var param_ajax = {
					action: 'autoart_cars_compare',
					carcomparecookie: $('.bt-carcomparecookie').val()
				};

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: AJ_Options.ajax_url,
					data: param_ajax,
					context: this,
					beforeSend: function () {
						$('.bt-table').addClass('loading');
					},
					success: function (response) {
						if (response.success) {
							console.log(response.data);
							setTimeout(function () {
								$('.bt-mini-compare--count').text(response.data['count']);
								$('.bt-table--body').html(response.data['items']).fadeIn('slow');
								$('.bt-table').removeClass('loading');

								$('.bt-car-remove a').on('click', function (e) {
									e.preventDefault();

									$(this).addClass('deleting');

									var car_id = $(this).data('id').toString(),
										compare_str = $('.bt-carcomparecookie').val(),
										compare_arr = compare_str.split(','),
										index = compare_arr.indexOf(car_id);

									if (index > -1) {
										compare_arr.splice(index, 1);
									}

									compare_str = compare_arr.toString();
									$('.bt-carcomparecookie').val(compare_str);
									setCookie('carcomparecookie', compare_str, 7);
									$('.bt-cars-compare-form').submit();

									$('.bt-car-compare-btn[data-id="' + car_id + '"]').removeClass('added');
								});
							}, 500);

						} else {
							console.log('error');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log('The following error occured: ' + textStatus, errorThrown);
					}
				});

				return false;
			});
		}
	}

	/* Cars sidebar toggle */
	function AutoArtCarSidebarToggle() {
		if ($('.bt-car-sidebar-toggle').length > 0) {
			$('.bt-car-sidebar-toggle').on('click', function () {
				$(this).parents('.bt-main-post-row').find('.bt-sidebar-col').addClass('active');
			});
			$('.bt-sidebar-overlay').on('click', function () {
				$(this).parents('.bt-main-post-row').find('.bt-sidebar-col').removeClass('active');
			});
		}
	}

	/* Cars filter */
	function AutoArtCarsFilter() {
		if (!$('body').hasClass('post-type-archive-car')) {
			return;
		}

		// Search by keywords
		$('.bt-car-filter-form .bt-field-type-search input').on('keyup', function (e) {
			if (e.key === 'Enter' || e.keyCode === 13) {
				$('.bt-car-filter-form .bt-car-current-page').val('');
				$('.bt-car-filter-form').submit();
			}
		});

		$('.bt-car-filter-form  .bt-field-type-search a').on('click', function () {
			$('.bt-car-filter-form .bt-car-current-page').val('');
			$('.bt-car-filter-form').submit();
		});

		// Sort order
		$('.bt-car-sort-block select').select2();
		$('.bt-car-sort-block select').on('change', function () {
			var sort_val = $(this).val();

			$('.bt-car-filter-form .bt-car-sort-order').val(sort_val);
			$('.bt-car-filter-form').submit();
		});

		// View type
		$('.bt-car-view-block .bt-view-type').on('click', function (e) {
			e.preventDefault();

			var view_type = $(this).data('view');

			if ('list' == view_type) {
				$('.bt-car-filter-form .bt-car-view-type').val(view_type);
				$('.bt-car-layout').attr('data-view', view_type);
			} else {
				$('.bt-car-filter-form .bt-car-view-type').val('');
				$('.bt-car-layout').attr('data-view', '');
			}

			$('.bt-car-view-block .bt-view-type').removeClass('active');
			$(this).addClass('active');
			$('.bt-car-filter-form').submit();
		});

		// Pagination
		$('.bt-car-pagination a').on('click', function (e) {
			e.preventDefault();

			var current_page = $(this).data('page');

			if (1 < current_page) {
				$('.bt-car-filter-form .bt-car-current-page').val(current_page);
			} else {
				$('.bt-car-filter-form .bt-car-current-page').val('');
			}

			$('.bt-car-filter-form').submit();
		});

		// Filter meta
		if ($('.bt-field-type-slider').length > 0) {
			$('.bt-field-type-slider').each(function () {
				var metaKey = $(this).data('meta-key'),
					slider = document.getElementById('bt_field_slider_' + metaKey),
					startMin = $(this).data('start-min'),
					startMax = $(this).data('start-max'),
					rangeMin = $(this).data('range-min'),
					rangeMax = $(this).data('range-max');

				noUiSlider.create(slider, {
					start: [startMin, startMax],
					step: 1,
					connect: true,
					range: {
						'min': rangeMin,
						'max': rangeMax
					}
				});

				slider.noUiSlider.on('update', function (values, handle) {
					document.getElementById('bt_min_value_' + metaKey).innerHTML = parseInt(values[0]);
					document.getElementById('bt_max_value_' + metaKey).innerHTML = parseInt(values[1]);
				});

				slider.noUiSlider.on('change', function (values, handle) {
					$('#bt_field_min_value_' + metaKey).val(parseInt(values[0]));
					$('#bt_field_max_value_' + metaKey).val(parseInt(values[1]));
					$('.bt-car-filter-form .bt-car-current-page').val('');
					$('.bt-car-filter-form').submit();
				});
			});
		}

		// Filter single tax
		if ($('.bt-field-type-select').length > 0) {
			$('.bt-field-type-select select').select2();

			$('.bt-field-type-select select').on('change', function () {
				$('.bt-car-filter-form .bt-car-current-page').val('');
				$('.bt-car-filter-form').submit();
			});
		}

		// Filter multiple tax
		if ($('.bt-field-type-multi').length > 0) {
			$('.bt-field-type-multi a').on('click', function (e) {
				e.preventDefault();

				if ($(this).parent().hasClass('checked')) {
					$(this).parent().removeClass('checked');
				} else {
					$(this).parent().addClass('checked');
				}

				var value_arr = [];

				$(this).parents('.bt-form-field').find('.bt-field-item').each(function () {
					if ($(this).hasClass('checked')) {
						value_arr.push($(this).children().data('slug'));
					}
				});

				$(this).parents('.bt-form-field').find('input').val(value_arr.toString());
				$('.bt-car-filter-form .bt-car-current-page').val('');
				$('.bt-car-filter-form').submit();
			});
		}

		// Filter reset
		if (window.location.href.includes('?')) {
			$('.bt-car-filter-form .bt-reset-btn').removeClass('disable');
		}

		$('.bt-car-filter-form .bt-reset-btn').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('disable')) {
				return;
			}

			window.history.replaceState(null, null, window.location.pathname);
			$('.bt-car-filter-form input').val('');
			$('.bt-car-filter-form .bt-field-item').removeClass('checked');
			$('.bt-car-filter-form select').select2().val('').trigger('change');
			var dropdownIcon = '<svg width="14" height="8" viewBox="0 0 14 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M1.23061 0.901437C0.872656 1.2594 0.872656 1.83984 1.23061 2.1978L5.71522 6.67791C6.43123 7.39328 7.59155 7.393 8.30728 6.67736L12.7901 2.1945C13.1481 1.83654 13.1481 1.2561 12.7901 0.898128C12.4321 0.540142 11.8517 0.540142 11.4937 0.898128L7.65691 4.73495C7.29895 5.093 6.71851 5.093 6.36056 4.73495L2.52696 0.901437C2.16901 0.543451 1.58867 0.543451 1.23061 0.901437Z"/>' +
				'</svg>';
			$('.select2-selection__arrow').html(dropdownIcon);
			$(this).addClass('disable')

			$('.bt-car-filter-form').submit();
		});

		// Ajax filter
		$('.bt-car-filter-form').submit(function () {
			var param_str = '',
				param_out = [],
				param_in = $(this).serialize().split('&');

			var param_ajax = {
				action: 'autoart_cars_filter',
			};

			param_in.forEach(function (param) {
				var param_key = param.split('=')[0],
					param_val = param.split('=')[1];

				if ('' !== param_val) {
					param_out.push(param);
					param_ajax[param_key] = param_val.replace(/%2C/g, ',');
				}
			});

			if (0 < param_out.length) {
				param_str = param_out.join('&');
			}

			if ('' !== param_str) {
				window.history.replaceState(null, null, `?${param_str}`);
				$(this).find('.bt-reset-btn').removeClass('disable');
			} else {
				window.history.replaceState(null, null, window.location.pathname);
				$(this).find('bt-reset-btn').addClass('disable');
			}

			// console.log(param_ajax);

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: AJ_Options.ajax_url,
				data: param_ajax,
				context: this,
				beforeSend: function () {
					document.querySelector('.bt-filter-scroll-pos').scrollIntoView({
						behavior: 'smooth'
					});

					$('.bt-filter-results').addClass('loading');
					$('.bt-car-layout').fadeOut('fast');
					$('.bt-car-pagination-wrap').fadeOut('fast');
				},
				success: function (response) {
					if (response.success) {
						// console.log(response.data);

						setTimeout(function () {
							$('.bt-car-results-block').html(response.data['results']).fadeIn('slow');
							$('.bt-car-layout').data(response.data['view']);
							$('.bt-car-layout').html(response.data['items']).fadeIn('slow');
							$('.bt-car-pagination-wrap').html(response.data['pagination']).fadeIn('slow');
							$('.bt-filter-results').removeClass('loading');

							// Wishlist & Compare
							AutoArtCarWishlist();
							AutoArtCarCompare();
						}, 500);

						// View type
						$('.bt-car-view-block .bt-view-type').on('click', function (e) {
							e.preventDefault();

							var view_type = $(this).data('view');

							if ('list' == view_type) {
								$('.bt-car-filter-form .bt-car-view-type').val(view_type);
								$('.bt-car-layout').attr('data-view', view_type);
							} else {
								$('.bt-car-filter-form .bt-car-view-type').val('');
								$('.bt-car-layout').attr('data-view', '');
							}

							$('.bt-car-view-block .bt-view-type').removeClass('active');
							$(this).addClass('active');
							$('.bt-car-filter-form').submit();
						});

						// Pagination
						$('.bt-car-pagination-wrap').on('click', '.bt-car-pagination a', function (e) {
							e.preventDefault();

							var current_page = $(this).data('page');

							if (1 < current_page) {
								$('.bt-car-filter-form .bt-car-current-page').val(current_page);
							} else {
								$('.bt-car-filter-form .bt-car-current-page').val('');
							}

							$('.bt-car-filter-form').submit();
						});
					} else {
						console.log('error');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('The following error occured: ' + textStatus, errorThrown);
				}
			});

			return false;
		});
	}

	/* Orbit effect */
	function AutoArtOrbitEffect() {
		if ($('.bt-orbit-enable').length > 0) {
			var html = '<div class="bt-orbit-effect">' +
				'<div class="bt-orbit-wrap">' +
				'<div class="bt-orbit red"><span></span></div>' +
				'<div class="bt-orbit blue"><span></span></div>' +
				'<div class="bt-orbit yellow"><span></span></div>' +
				'<div class="bt-orbit purple"><span></span></div>' +
				'<div class="bt-orbit green"><span></span></div>' +
				'</div>' +
				'</div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Cursor effect */
	function AutoArtCursorEffect() {
		if ($('.bt-bg-pattern-enable').length > 0) {
			var html = '<div class="bt-bg-pattern-effect"></div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Shop */
	function AutoArtShop() {
		if ($('.single-product').length > 0) {
			$('.woocommerce-product-zoom__image').zoom();

			$('.woocommerce-product-gallery__slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				asNavFor: '.woocommerce-product-gallery__slider-nav',
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
			$('.woocommerce-product-gallery__slider-nav').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				asNavFor: '.woocommerce-product-gallery__slider'
			});
		}
		if ($('.quantity input').length > 0) {
			/* Plus Qty */
			$(document).on('click', '.qty-plus', function () {
				var parent = $(this).parent();
				$('input.qty', parent).val(parseInt($('input.qty', parent).val()) + 1);
				$('input.qty', parent).trigger('change');
			});
			/* Minus Qty */
			$(document).on('click', '.qty-minus', function () {
				var parent = $(this).parent();
				if (parseInt($('input.qty', parent).val()) > 1) {
					$('input.qty', parent).val(parseInt($('input.qty', parent).val()) - 1);
					$('input.qty', parent).trigger('change');
				}
			});
		}

	}

	function AutoArtAddIconList() {
		const iconList = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">' +
			'<g clip-path="url(#clip0_72_3448)">' +
			'<path fill-rule="evenodd" clip-rule="evenodd" d="M14.8948 0.536276C14.3234 0.190064 13.6681 0.00701904 13 0.00701904C12.3319 0.00701904 11.6766 0.190064 11.1053 0.536276L2.574 5.70703C2.03639 6.03278 1.59185 6.49164 1.28329 7.0393C0.974733 7.58696 0.812585 8.20492 0.8125 8.83353V17.1665C0.812585 17.7951 0.974733 18.4131 1.28329 18.9608C1.59185 19.5084 2.03639 19.9673 2.574 20.293L11.1053 25.4638C11.6766 25.81 12.3319 25.993 13 25.993C13.6681 25.993 14.3234 25.81 14.8948 25.4638L23.426 20.293C23.9636 19.9673 24.4082 19.5084 24.7167 18.9608C25.0253 18.4131 25.1874 17.7951 25.1875 17.1665V8.83353C25.1874 8.20492 25.0253 7.58696 24.7167 7.0393C24.4082 6.49164 23.9636 6.03278 23.426 5.70703L14.8948 0.536276ZM16.6075 9.29503C16.7191 9.17528 16.8536 9.07924 17.0031 9.01263C17.1526 8.94602 17.314 8.9102 17.4777 8.90732C17.6413 8.90443 17.8038 8.93453 17.9556 8.99583C18.1074 9.05712 18.2452 9.14836 18.3609 9.26409C18.4767 9.37982 18.5679 9.51767 18.6292 9.66943C18.6905 9.82119 18.7206 9.98373 18.7177 10.1474C18.7148 10.311 18.679 10.4724 18.6124 10.6219C18.5458 10.7714 18.4497 10.906 18.33 11.0175L11.83 17.5175C11.6015 17.7458 11.2917 17.874 10.9688 17.874C10.6458 17.874 10.336 17.7458 10.1075 17.5175L6.8575 14.2675C6.64222 14.0365 6.52502 13.7309 6.53059 13.4152C6.53616 13.0994 6.66407 12.7982 6.88736 12.5749C7.11066 12.3516 7.41191 12.2237 7.72765 12.2181C8.04339 12.2125 8.34897 12.3297 8.58 12.545L10.9688 14.9338L16.6075 9.29503Z" fill="#1FBECD"/>' +
			'</g>' +
			'<defs>' +
			'<clipPath id="clip0_72_3448">' +
			'<rect width="26" height="26" fill="white"/>' +
			'</clipPath>' +
			'</defs>' +
			'</svg>';

		$('ul.wp-block-archives > li > a,  ul.wp-block-categories > li > a').append(iconList)
	}

	/* Units custom */
	function AutoArtUnitsCustom() {
		if ($('.elementor-editor-active').length > 0) {
			return;
		}

		if ($('select.select2-hidden-accessible').length > 0) {
			var dropdownIcon = '<svg width="14" height="8" viewBox="0 0 14 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M1.23061 0.901437C0.872656 1.2594 0.872656 1.83984 1.23061 2.1978L5.71522 6.67791C6.43123 7.39328 7.59155 7.393 8.30728 6.67736L12.7901 2.1945C13.1481 1.83654 13.1481 1.2561 12.7901 0.898128C12.4321 0.540142 11.8517 0.540142 11.4937 0.898128L7.65691 4.73495C7.29895 5.093 6.71851 5.093 6.36056 4.73495L2.52696 0.901437C2.16901 0.543451 1.58867 0.543451 1.23061 0.901437Z"/>' +
				'</svg>';
			$('.select2-selection__arrow').html(dropdownIcon);
		}

		if ($('.bt-post--content').length > 0 || $('.single-product').length > 0) {
			var quoteIcon = '<span class="bt-quote-icon"><svg width="38" height="38" viewBox="0 0 38 38" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M29.1329 33.0577C34.0301 33.0577 38 29.0867 38 24.1879C38 19.2907 34.0301 15.3197 29.1329 15.3197C29.1329 15.3197 29.1758 12.025 31.8525 7.28298C32.1498 6.33283 31.6198 5.321 30.669 5.02539C29.9945 4.8132 29.2846 5.01945 28.8263 5.49957C22.6717 12.2312 20.2625 20.1539 20.2625 24.1879C20.2625 29.0867 24.2323 33.0577 29.1329 33.0577Z"/>' +
				'<path d="M8.87122 33.0577C13.7684 33.0577 17.7383 29.0867 17.7383 24.1879C17.7383 19.2907 13.7684 15.3197 8.87122 15.3197C8.87122 15.3197 8.91412 12.025 11.5907 7.28298C11.8881 6.33283 11.358 5.321 10.4073 5.02539C9.73275 4.8132 9.02292 5.01945 8.56462 5.49957C2.40996 12.2312 0.000741959 20.1539 0.000741959 24.1879C0.000741959 29.0867 3.97063 33.0577 8.87122 33.0577Z"/>' +
				'</svg></span>';
			$('.bt-post--content blockquote').append(quoteIcon);

			var ulIcon = '<span class="bt-ul-icon"><svg width="26" height="26" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path fill-rule="evenodd" clip-rule="evenodd" d="M14.8948 0.536215C14.3234 0.190003 13.6681 0.00695801 13 0.00695801C12.3319 0.00695801 11.6766 0.190003 11.1053 0.536215L2.574 5.70696C2.03639 6.03272 1.59185 6.49158 1.28329 7.03924C0.974733 7.5869 0.812585 8.20486 0.8125 8.83346V17.1665C0.812585 17.7951 0.974733 18.413 1.28329 18.9607C1.59185 19.5084 2.03639 19.9672 2.574 20.293L11.1053 25.4637C11.6766 25.8099 12.3319 25.993 13 25.993C13.6681 25.993 14.3234 25.8099 14.8948 25.4637L23.426 20.293C23.9636 19.9672 24.4082 19.5084 24.7167 18.9607C25.0253 18.413 25.1874 17.7951 25.1875 17.1665V8.83346C25.1874 8.20486 25.0253 7.5869 24.7167 7.03924C24.4082 6.49158 23.9636 6.03272 23.426 5.70696L14.8948 0.536215ZM16.6075 9.29496C16.7191 9.17522 16.8536 9.07918 17.0031 9.01257C17.1526 8.94596 17.314 8.91014 17.4777 8.90725C17.6413 8.90437 17.8038 8.93447 17.9556 8.99577C18.1074 9.05706 18.2452 9.1483 18.3609 9.26403C18.4767 9.37976 18.5679 9.51761 18.6292 9.66937C18.6905 9.82112 18.7206 9.98367 18.7177 10.1473C18.7148 10.311 18.679 10.4723 18.6124 10.6218C18.5458 10.7713 18.4497 10.9059 18.33 11.0175L11.83 17.5175C11.6015 17.7457 11.2917 17.8739 10.9688 17.8739C10.6458 17.8739 10.336 17.7457 10.1075 17.5175L6.8575 14.2675C6.64222 14.0364 6.52502 13.7309 6.53059 13.4151C6.53616 13.0994 6.66407 12.7981 6.88736 12.5748C7.11066 12.3515 7.41191 12.2236 7.72765 12.2181C8.04339 12.2125 8.34897 12.3297 8.58 12.545L10.9688 14.9337L16.6075 9.29496Z"/>' +
				'</svg></span>';
			$('.bt-post--content ul li').append(ulIcon);
			$('#bt-product-additional_information .woocommerce-product-attributes-item__label').append(ulIcon);
		}

	}
	/* Scroll Cars Grid List */
	function AutoArtScrollCars(){
		var $scrollContainer = $('.elementor-element.bt-scroll-cars-grid-list > .elementor-element');
		$scrollContainer.on('scroll', function() {
			var scrollTop = $(this).scrollTop();
			var scrollHeight = $(this).prop('scrollHeight');
			var containerHeight = $(this).height();
	
			if (scrollTop + containerHeight >= scrollHeight) {
				$('.bt-scroll-cars-grid-list').removeClass('active');
			} else {
				$('.bt-scroll-cars-grid-list').addClass('active');
			}
		});
	}
	jQuery(document).ready(function ($) {
		AutoArtSubmenuAuto();
		AutoArtToggleMenuMobile();
		AutoArtToggleSubMenuMobile();
		AutoArtTabs();
		AutoArtSelect2();
		AutoArtCloseSection();
		AutoArtGallerSlider();
		AutoArtGallerCarousel();
		AutoArtCarWishlist();
		AutoArtCarCompare();
		AutoArtCarSidebarToggle();
		AutoArtCarsFilter();
		AutoArtOrbitEffect();
		AutoArtCursorEffect();
		AutoArtShop();
		AutoArtUnitsCustom();
		AutoArtAddIconList();
		AutoArtScrollCars();
	});

	jQuery(window).on('resize', function () {
		AutoArtSubmenuAuto();
	});

	jQuery(window).on('scroll', function () {

	});

})(jQuery);
