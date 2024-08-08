(function ($) {
	/**
	   * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	**/


	function lineProgressStep($scope) {
		var listStep = $scope.find('.bt-step-list-js'),
			listInfo = { top: listStep.offset().top, height: listStep.innerHeight() },
			lineProgress = $scope.find('.bt-line-progress-js'),
			currentScroll = $(window).scrollTop() + ($(window).height() / 2),
			percent = ((currentScroll - listInfo.top) / listInfo.height) * 100;

		if (percent > 0) {
			if (percent > 100) {
				lineProgress.css('height', '100%');
			} else {
				lineProgress.css('height', percent.toFixed(2) + '%');
			}
		} else {
			lineProgress.css('height', '0%');
		}
	}

	var MoreStepsHandler = function ($scope, $) {
		// console.log($scope);
		var moreBtn = $scope.find('.bt-show-more-btn-js'),
			listStep = $scope.find('.bt-step-list-js');

		lineProgressStep($scope);
		$(window).scroll(function () {
			lineProgressStep($scope);
		});

		if ($scope.find('.bt-has-show-more').length > 0) {

			moreBtn.on('click', function (e) {
				e.preventDefault();

				$(this).parent().hide();
				listStep.children().removeClass('bt-hide-item');

				lineProgressStep($scope);
				$(window).scroll(function () {
					lineProgressStep($scope);
				});
			});
		}

	};


	var CarsQuickCompareHandler = function ($scope, $) {
		// console.log($scope);

		$scope.find('.bt-quick-compare-btn').on('click', function (e) {
			e.preventDefault();
			$(this).parents('.bt-cars-quick-compare').addClass('bt-is-active');
		});

		$scope.find('.bt-close-popup').on('click', function (e) {
			e.preventDefault();
			$(this).parents('.bt-cars-quick-compare').removeClass('bt-is-active');
		});

	};

	var CarsSearchHandler = function ($scope, $) {
		const $formSearch = $scope.find('.bt-car-search-form');
		if (!$formSearch.length) return;

		const $fieldSelect = $formSearch.find('.bt-field-type-select select')

		if ($fieldSelect.length > 0) {
			$fieldSelect.select2();

			var dropdownIcon = '<svg width="14" height="8" viewBox="0 0 14 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M1.23061 0.901437C0.872656 1.2594 0.872656 1.83984 1.23061 2.1978L5.71522 6.67791C6.43123 7.39328 7.59155 7.393 8.30728 6.67736L12.7901 2.1945C13.1481 1.83654 13.1481 1.2561 12.7901 0.898128C12.4321 0.540142 11.8517 0.540142 11.4937 0.898128L7.65691 4.73495C7.29895 5.093 6.71851 5.093 6.36056 4.73495L2.52696 0.901437C2.16901 0.543451 1.58867 0.543451 1.23061 0.901437Z"/>' +
				'</svg>';
			$('.select2-selection__arrow').html(dropdownIcon);
		}

		$formSearch.on('submit', function (event) {
			event.preventDefault();

			const car_make = $(this).find('select[name="car_make"]').val();
			const car_price = $(this).find('select[name="car_price"]').val();
			const car_model = $(this).find('select[name="car_model"]').val();
			const car_year = $(this).find('select[name="car_year"]').val();
			const car_condition = $(this).find("input[name='car_condition']:checked").val();

			let url = '/cars?';

			if (car_make) {
				url += 'car_make=' + car_make + '&';
			}

			if (car_price) {
				url += 'car_price=' + car_price + '&';
			}

			if (car_model) {
				url += 'car_model=' + car_model + '&';
			}

			if (car_year) {
				url += 'car_year=' + car_year + '&';
			}

			if (car_condition) {
				url += 'car_condition=' + car_condition + '&';
			}

			url = url.slice(0, -1);

			window.location.href = url;
		})
	}

	var FaqHandler = function ($scope, $) {
		const $titleFaq = $scope.find('.bt-item-title');
		if ($titleFaq.length > 0) {
			$titleFaq.on('click', function (e) {
				e.preventDefault();
				if ($(this).hasClass('active')) {
					$(this).parent().find('.bt-item-content').slideUp();
					$(this).removeClass('active');
				} else {
					$(this).parent().find('.bt-item-content').slideDown();
					$(this).addClass('active');
				}
			});
		}
	};
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
	var CarsGridListHandler = function ($scope, $) {
		const $carsgridlist = $scope.find('.bt-cars-grid-list-template');
		// Sort order
		$carsgridlist.find('.bt-car-sort-block select').select2();
		$carsgridlist.find('.bt-car-sort-block select').on('change', function () {
			$carsgridlist.find('.bt-car-filter-form-sortview').submit();
		});
		// View type
		$carsgridlist.find('.bt-car-view-block .bt-view-type').on('click', function (e) {
			e.preventDefault();
			var view_type = $(this).data('view');

			if ('list' == view_type) {
				$carsgridlist.find('.bt-car-view-type').val(view_type);
				$carsgridlist.find('.bt-car-layout').attr('data-view', view_type);
			} else {
				$carsgridlist.find('.bt-car-filter-form-sortview .bt-car-view-type').val('');
				$carsgridlist.find('.bt-car-layout').attr('data-view', '');
			}

			$carsgridlist.find('.bt-car-view-block .bt-view-type').removeClass('active');
			$(this).addClass('active');
			$carsgridlist.find('.bt-car-filter-form-sortview').submit();
		});
		// Pagination
		$carsgridlist.find('.bt-car-pagination a').on('click', function (e) {
			e.preventDefault();

			var current_page = $(this).data('page');

			if (1 < current_page) {
				$carsgridlist.find('.bt-car-current-page').val(current_page);
			} else {
				$carsgridlist.find('.bt-car-current-page').val('');
			}

			$carsgridlist.find('.bt-car-filter-form-sortview').submit();
		});
		// Ajax filter
		$carsgridlist.find('.bt-car-filter-form-sortview').submit(function () {

			var param_str = '',
				param_out = [],
				param_in = $(this).serialize().split('&');

			var param_ajax = {
				action: 'autoart_cars_grid_list_filter',
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
			} else {
				window.history.replaceState(null, null, window.location.pathname);
			}

			// console.log(param_ajax);

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: AJ_Options.ajax_url,
				data: param_ajax,
				context: this,
				beforeSend: function () {
					$carsgridlist.find('.bt-filter-results').addClass('loading');
					$carsgridlist.find('.bt-car-layout').fadeOut('fast');
					$carsgridlist.find('.bt-car-pagination-wrap').fadeOut('fast');
				},
				success: function (response) {
					if (response.success) {
						document.querySelector('.bt-filter-scroll-pos').scrollIntoView({
							behavior: 'smooth'
						});
						setTimeout(function () {
							$carsgridlist.find('.bt-car-results-block').html(response.data['results']).fadeIn('slow');
							$carsgridlist.find('.bt-car-layout').data(response.data['view']);
							$carsgridlist.find('.bt-car-layout').html(response.data['items']).fadeIn('slow');
							$carsgridlist.find('.bt-car-pagination-wrap').html(response.data['pagination']).fadeIn('slow');
							$carsgridlist.find('.bt-filter-results').removeClass('loading');

							// Wishlist & Compare
							AutoArtCarWishlist();
							AutoArtCarCompare();
						}, 500);

						// View type
						$carsgridlist.find('.bt-car-view-block .bt-view-type').on('click', function (e) {
							e.preventDefault();

							var view_type = $(this).data('view');

							if ('list' == view_type) {
								$carsgridlist.find('.bt-car-view-type').val(view_type);
								$carsgridlist.find('.bt-car-layout').attr('data-view', view_type);
							} else {
								$carsgridlist.find('.bt-car-view-type').val('');
								$carsgridlist.find('.bt-car-layout').attr('data-view', '');
							}

							$carsgridlist.find('.bt-car-view-block .bt-view-type').removeClass('active');
							$carsgridlist.find(this).addClass('active');
							$carsgridlist.find('.bt-car-filter-form-sortview').submit();
						});

						// Pagination
						$carsgridlist.find('.bt-car-pagination-wrap').on('click', '.bt-car-pagination a', function (e) {
							e.preventDefault();

							var current_page = $(this).data('page');

							if (1 < current_page) {
								$carsgridlist.find('.bt-car-current-page').val(current_page);
							} else {
								$carsgridlist.find('.bt-car-current-page').val('');
							}

							$carsgridlist.find('.bt-car-filter-form-sortview').submit();
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

	};
	// Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-step-list.default', MoreStepsHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-cars-quick-compare.default', CarsQuickCompareHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-cars-search.default', CarsSearchHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-cars-search-style-1.default', CarsSearchHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-cars-search-style-2.default', CarsSearchHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-list-faq.default', FaqHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-cars-grid-list.default', CarsGridListHandler);
	});

})(jQuery);
