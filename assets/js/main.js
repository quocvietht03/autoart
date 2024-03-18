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

	/*  */
	function AutoArtCarsFilter() {
		if (!$('body').hasClass('post-type-archive-car')) {
			return;
		}

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
	        $('.bt-car-filter-form').submit();
	      });
			});
    }

		if($('.bt-field-type-select').length > 0) {
			$('.bt-field-type-select select').select2();

			$('.bt-field-type-select select').on('change', function() {
	      $('.bt-car-filter-form').submit();
	    });
		}
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
