( function () {
	const nav = document.getElementById( 'primary-navigation' );
	const toggle = document.querySelector( '.menu-toggle' );

	if ( nav && toggle ) {
		toggle.addEventListener( 'click', function () {
			const expanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
			toggle.setAttribute( 'aria-expanded', expanded ? 'false' : 'true' );
			nav.classList.toggle( 'is-open' );
		} );
	}

	// Lottie FV Animation
	const lottieContainer = document.getElementById( 'lottie-fv' );
	if ( lottieContainer && typeof lottie !== 'undefined' ) {
		lottie.loadAnimation( {
			container: lottieContainer,
			renderer: 'svg',
			loop: true,
			autoplay: true,
			path: lottieContainer.getAttribute( 'data-json-path' ),
			assetsPath: lottieContainer.getAttribute( 'data-assets-path' ),
			rendererSettings: {
				preserveAspectRatio: 'xMidYMid slice'
			}
		} );
	}
} )();
