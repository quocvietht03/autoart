!(function($){
	"use strict";

  /* Toggle submenu align */
	function AutoArtSubmenuAuto() {
		if($('.bt-site-header .bt-container').length > 0) {
	    var container = $('.bt-site-header .bt-container'),
	        containerInfo = {left: container.offset().left, width: container.innerWidth()},
	        contLeftPos = containerInfo.left,
	        contRightPos = containerInfo.left + containerInfo.width;

	    $('.children, .sub-menu').each(function(){
	      var submenuInfo = {left: $(this).offset().left, width: $(this).innerWidth()},
	          smLeftPos = submenuInfo.left,
	          smRightPos = submenuInfo.left + submenuInfo.width;

	      if(smLeftPos <= contLeftPos) {
	        $(this).addClass('bt-align-left');
	      }

	      if(smRightPos >= contRightPos) {
	        $(this).addClass('bt-align-right');
	      }

	    });
		}
	}

	/* Toggle menu mobile */
	function AutoArtToggleMenuMobile() {
		$('.bt-site-header .bt-menu-toggle').on('click', function(e) {
			e.preventDefault();

      if($(this).hasClass('bt-menu-open')) {
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

		hasChildren.each( function() {
			var $btnToggle = $('<div class="bt-toggle-icon"></div>');

			$( this ).append($btnToggle);

			$btnToggle.on( 'click', function(e) {
				e.preventDefault();
				$( this ).toggleClass('bt-is-active');
				$( this ).parent().children('ul').toggle();
			} );
		} );
	}

	/* Tabs */
	function AutoArtTabs() {
		$('.bt-tabs-js .bt-nav-item').on('click', function(e) {
			e.preventDefault();
			$(this).addClass('bt-is-active').siblings().removeClass('bt-is-active');
			$($.attr(this, 'href')).addClass('bt-is-active').siblings().removeClass('bt-is-active');
		});
	}

	/* Close section */
	function AutoArtCloseSection() {
		if($('.bt-close-btn').length > 0) {
			$('.bt-close-btn').on('click', function(e) {
				e.preventDefault();

				$(this).parents('.e-parent').hide();
			});
		}
	}

	/* Set cookie */
	function setCookie(cname, cvalue, exdays) {
	  const d = new Date();
	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	  let expires = "expires="+ d.toUTCString();
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	/* Get cookie */
	function getCookie(cname) {
	  let name = cname + "=";
	  let decodedCookie = decodeURIComponent(document.cookie);
	  let ca = decodedCookie.split(';');
	  for(let i = 0; i <ca.length; i++) {
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
		if($('.bt-car-wishlist-btn').length > 0) {
			// setCookie('carwishlistcookie', '', 7);

			$('.bt-car-wishlist-btn').on('click', function(e) {
				e.preventDefault();

				var post_id = $(this).data('id').toString(),
						wishlist_cookie = getCookie('carwishlistcookie');

				if (wishlist_cookie == '' ) {
					setCookie('carwishlistcookie', post_id, 7);
					$(this).addClass('added');
				} else {
					var wishlist_arr = wishlist_cookie.split(',');

					if(wishlist_arr.includes(post_id)) {
						var wishlist_str = wishlist_arr.filter(function(e) { return e !== post_id });

						setCookie('carwishlistcookie', wishlist_str, 7);
						$(this).removeClass('added');
					} else {
						setCookie('carwishlistcookie', wishlist_cookie + ',' + post_id, 7);
						$(this).addClass('added');
					}
				}
			});
		}
	}

	/* Car compare */
	function AutoArtCarCompare() {
		if($('.bt-car-compare-btn').length > 0) {
			// setCookie('carwishlistcookie', '', 7);

			$('.bt-car-compare-btn').on('click', function(e) {
				e.preventDefault();

				var post_id = $(this).data('id').toString(),
						compare_cookie = getCookie('carcomparecookie');

				if (compare_cookie == '' ) {
					setCookie('carcomparecookie', post_id, 7);
					$(this).addClass('added');
				} else {
					var compare_arr = compare_cookie.split(',');

					if(compare_arr.includes(post_id)) {
						var compare_str = compare_arr.filter(function(e) { return e !== post_id });

						setCookie('carcomparecookie', compare_str, 7);
						$(this).removeClass('added');
					} else {
						setCookie('carcomparecookie', compare_cookie + ',' + post_id, 7);
						$(this).addClass('added');
					}
				}
			});
		}
	}

	/* Cars sidebar toggle */
	function AutoArtCarSidebarToggle() {
		if($('.bt-car-sidebar-toggle').length > 0) {
			$('.bt-car-sidebar-toggle').on('click', function() {
				$(this).parents('.bt-main-post-row').find('.bt-sidebar-col').addClass('active');
			});
			$('.bt-sidebar-overlay').on('click', function() {
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

    $('.bt-car-filter-form  .bt-field-type-search a').on('click', function() {
			$('.bt-car-filter-form .bt-car-current-page').val('');
			$('.bt-car-filter-form').submit();
    });

		// Sort order
		$('.bt-car-sort-block select').select2();
    $('.bt-car-sort-block select').on('change', function() {
      var sort_val = $(this).val();

      $('.bt-car-filter-form .bt-car-sort-order').val(sort_val);
      $('.bt-car-filter-form').submit();
    });

    // View type
		$('.bt-car-view-block .bt-view-type').on('click', function(e) {
			e.preventDefault();

			var view_type = $(this).data('view');

			if('list' == view_type) {
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
		$('.bt-car-pagination a').on('click', function(e) {
			e.preventDefault();

			var current_page = $(this).data('page');

			if(1 < current_page) {
				$('.bt-car-filter-form .bt-car-current-page').val(current_page);
			} else {
				$('.bt-car-filter-form .bt-car-current-page').val('');
			}

			$('.bt-car-filter-form').submit();
		});

		// Filter meta
		if($('.bt-field-type-slider').length > 0) {
			$('.bt-field-type-slider').each(function(){
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

	      slider.noUiSlider.on('update', function(values, handle) {
					document.getElementById('bt_min_value_' + metaKey).innerHTML = parseInt(values[0]);
        	document.getElementById('bt_max_value_' + metaKey).innerHTML = parseInt(values[1]);
	      });

	      slider.noUiSlider.on('change', function(values, handle) {
	        $('#bt_field_min_value_' + metaKey).val(parseInt(values[0]));
	        $('#bt_field_max_value_' + metaKey).val(parseInt(values[1]));
					$('.bt-car-filter-form .bt-car-current-page').val('');
	        $('.bt-car-filter-form').submit();
	      });
			});
    }

		// Filter single tax
		if($('.bt-field-type-select').length > 0) {
			$('.bt-field-type-select select').select2();

			$('.bt-field-type-select select').on('change', function() {
				$('.bt-car-filter-form .bt-car-current-page').val('');
	      $('.bt-car-filter-form').submit();
	    });
		}

		// Filter multiple tax
		if($('.bt-field-type-multi').length > 0) {
			$('.bt-field-type-multi a').on('click', function(e) {
				e.preventDefault();

				if($(this).parent().hasClass('checked')) {
					$(this).parent().removeClass('checked');
				} else {
					$(this).parent().addClass('checked');
				}

				var value_arr = [];

				$(this).parents('.bt-form-field').find('.bt-field-item').each(function() {
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
    if(window.location.href.includes('?')){
      $('.bt-car-filter-form .bt-reset-btn').removeClass('disable');
    }

    $('.bt-car-filter-form .bt-reset-btn').on('click', function(e) {
      e.preventDefault();

			if($(this).hasClass('disable')) {
				return;
			}

			window.history.replaceState(null, null, window.location.pathname);
			$('.bt-car-filter-form input').val('');
			$('.bt-car-filter-form .bt-field-item').removeClass('checked');
      $('.bt-car-filter-form select').select2().val('').trigger('change');
			$(this).addClass('disable')

      $('.bt-car-filter-form').submit();
    });

		// Ajax filter
		$('.bt-car-filter-form').submit(function() {
      var param_str = '',
          param_out = [],
          param_in = $(this).serialize().split('&');

      var param_ajax = {
            action: 'autoart_cars_filter',
          };

      param_in.forEach(function(param){
        var param_key = param.split('=')[0],
            param_val = param.split('=')[1];

				if('' !== param_val) {
					param_out.push(param);
					param_ajax[param_key] = param_val.replace(/%2C/g, ',');
				}
      });

      if(0 < param_out.length) {
        param_str = param_out.join('&');
      }

      if('' !== param_str) {
        window.history.replaceState(null, null, `?${param_str}`);
        $(this).find('.bt-reset-btn').removeClass('disable');
      } else {
        window.history.replaceState(null, null, window.location.pathname);
        $(this).find('bt-reset-btn').addClass('disable');
      }

      console.log(param_ajax);

      $.ajax({
          type: 'POST',
          dataType: 'json',
          url: AJ_Options.ajax_url,
          data: param_ajax,
          context: this,
          beforeSend: function(){
            document.querySelector('.bt-filter-scroll-pos').scrollIntoView({
              behavior: 'smooth'
            });

            $('.bt-filter-results').addClass('loading');
            $('.bt-car-layout').fadeOut('fast');
            $('.bt-car-pagination-wrap').fadeOut('fast');
          },
          success: function(response) {
            if(response.success) {
              console.log(response.data);
							$('.bt-car-results-block').html(response.data['results']).fadeIn('slow');
							$('.bt-car-layout').data(response.data['view']);
              $('.bt-car-layout').html(response.data['items']).fadeIn('slow');
              $('.bt-car-pagination-wrap').html(response.data['pagination']).fadeIn('slow');

              $('.bt-filter-results').removeClass('loading');

							// View type
							$('.bt-car-view-block .bt-view-type').on('click', function(e) {
								e.preventDefault();

								var view_type = $(this).data('view');

								if('list' == view_type) {
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
              $('.bt-car-pagination a').on('click', function(e) {
                e.preventDefault();

                var current_page = $(this).data('page');

                if(1 < current_page) {
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
          error: function( jqXHR, textStatus, errorThrown ){
            console.log( 'The following error occured: ' + textStatus, errorThrown );
          }
      });

      return false;
		});
	}

	/* Orbit effect */
	function AutoArtOrbitEffect() {
		if($('.bt-orbit-enable').length > 0) {
			var html = '<div class="bt-orbit-effect">'+
				'<div class="bt-orbit-wrap">'+
					'<div class="bt-orbit red"><span></span></div>'+
					'<div class="bt-orbit blue"><span></span></div>'+
					'<div class="bt-orbit yellow"><span></span></div>'+
					'<div class="bt-orbit purple"><span></span></div>'+
					'<div class="bt-orbit green"><span></span></div>'+
				'</div>'+
			'</div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Cursor effect */
	function AutoArtCursorEffect() {
		if($('.bt-bg-pattern-enable').length > 0) {
			var html = '<div class="bt-bg-pattern-effect"></div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Buble effect */
	function AutoArtBubleEffect() {
		if($('.bt-bg-buble-enable').length > 0) {
			var html = '<div class="bt-bg-buble-effect">'+
						'<div class="bt-bubles-beblow"></div>'+
						'<div class="bt-bubles-above"></div>'
					'</div>';

			$('.bt-social-mcn-ss').append(html);

			for(let i = 0; i < 40; i++) {
				$('.bt-bubles-beblow').append('<span class="buble"></span>');
				$('.bt-bubles-above').append('<span class="buble"></span>');
			}
		}
	}

	/* Shop */
	function AutoArtShop() {
		if($('.single-product').length > 0) {
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
		if($('.quantity input').length > 0) {
			/* Plus Qty */
			$(document).on('click', '.qty-plus', function() {
			  var parent = $(this).parent();
			  $('input.qty', parent).val( parseInt($('input.qty', parent).val()) + 1);
				$('input.qty', parent).trigger('change');
			});
			/* Minus Qty */
			$(document).on('click', '.qty-minus', function() {
			  var parent = $(this).parent();
			  if( parseInt($('input.qty', parent).val()) > 1) {
		      $('input.qty', parent).val( parseInt($('input.qty', parent).val()) - 1);
					$('input.qty', parent).trigger('change');
			  }
			});
		}

	}

	jQuery(document).ready(function($) {
    AutoArtSubmenuAuto();
    AutoArtToggleMenuMobile();
    AutoArtToggleSubMenuMobile();
		AutoArtTabs();
		AutoArtCloseSection();
		AutoArtCarWishlist();
		AutoArtCarCompare();
		AutoArtCarSidebarToggle();
		AutoArtCarsFilter();
		AutoArtOrbitEffect();
		AutoArtCursorEffect();
		AutoArtBubleEffect();

		AutoArtShop();

	});

	jQuery(window).on('resize', function() {
    AutoArtSubmenuAuto();
	});

	jQuery(window).on('scroll', function() {

	});

})(jQuery);
