( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	**/

	var SliderSyncingHandler = function( $scope, $ ) {
		// console.log($scope);
    var slideFor = $scope.find('.bt-slide-for-js'),
        slideNav = $scope.find('.bt-slide-nav-js');

		 slideFor.slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
			infinite: true,
			autoplay: true,
			autoplaySpeed: 5000,
		  arrows: false,
		  fade: true,
		  asNavFor: '.bt-slide-nav-js'
		});

		slideNav.slick({
			centerMode: true,
		  centerPadding: '0px',
		  slidesToShow: 3,
			asNavFor: '.bt-slide-for-js',
		  focusOnSelect: true,
			arrows: true,
			prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
			nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
			responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        centerMode: true,
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        centerMode: true,
	        slidesToShow: 1
	      }
	    }
	  ]
		});

 	};

	function lineProgressStep($scope) {
		var listStep = $scope.find('.bt-step-list-js'),
				listInfo = {top: listStep.offset().top, height: listStep.innerHeight()},
				lineProgress = $scope.find('.bt-line-progress-js'),
				currentScroll = $(window).scrollTop() + ($(window).height() / 2),
				percent = ((currentScroll - listInfo.top) / listInfo.height) * 100;

		if (percent > 0){
			if(percent > 100) {
				lineProgress.css('height', '100%');
			} else {
				lineProgress.css('height', percent.toFixed(2) + '%');
			}
		} else {
			lineProgress.css('height', '0%');
		}
	}

	var MoreStepsHandler = function( $scope, $ ) {
		// console.log($scope);
		var moreBtn = $scope.find('.bt-show-more-btn-js'),
				listStep = $scope.find('.bt-step-list-js');

		lineProgressStep($scope);
		$(window).scroll(function() {
    	lineProgressStep($scope);
    });

		if($scope.find('.bt-has-show-more').length > 0) {

			moreBtn.on('click', function(e) {
				e.preventDefault();

				$(this).parent().hide();
				listStep.children().removeClass('bt-hide-item');

				lineProgressStep($scope);
				$(window).scroll(function() {
		    	lineProgressStep($scope);
		    });
			});
		}

 	};

	var TabsHandler = function( $scope, $ ) {
		// console.log($scope);

		$scope.find('.bt-nav-item').on('click', function(e) {
			e.preventDefault();
			$(this).addClass('bt-is-active').siblings().removeClass('bt-is-active');
			$($.attr(this, 'href')).addClass('bt-is-active').siblings().removeClass('bt-is-active');
		});

 	};

	var CarsSearchHandler = function( $scope, $ ) {
		const $formSearch = $scope.find('.bt-car-search-form');
		if (!$formSearch.length) return;

		const $fieldSelect = $formSearch.find('.bt-field-type-select select')

		if($fieldSelect.length > 0) {
			$fieldSelect.select2();

			var dropdownIcon = '<svg width="14" height="8" viewBox="0 0 14 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
								'<path d="M1.23061 0.901437C0.872656 1.2594 0.872656 1.83984 1.23061 2.1978L5.71522 6.67791C6.43123 7.39328 7.59155 7.393 8.30728 6.67736L12.7901 2.1945C13.1481 1.83654 13.1481 1.2561 12.7901 0.898128C12.4321 0.540142 11.8517 0.540142 11.4937 0.898128L7.65691 4.73495C7.29895 5.093 6.71851 5.093 6.36056 4.73495L2.52696 0.901437C2.16901 0.543451 1.58867 0.543451 1.23061 0.901437Z"/>' +
							'</svg>';
			$('.select2-selection__arrow').html(dropdownIcon);
		}
	
		$formSearch.on('submit', function(event) {
			event.preventDefault();
			
			const car_make  = $(this).find('select[name="car_make"]').val();
			const car_price = $(this).find('select[name="car_price"]').val();
			const car_model = $(this).find('select[name="car_model"]').val();
			const car_year  = $(this).find('select[name="car_year"]').val();
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

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bt-testimonial-slider.default', SliderSyncingHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bt-step-list.default', MoreStepsHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bt-pricing-tabs.default', TabsHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bt-cars-search.default', CarsSearchHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bt-cars-search-style-1.default', CarsSearchHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bt-cars-search-style-2.default', CarsSearchHandler );
	} );

} )( jQuery );
