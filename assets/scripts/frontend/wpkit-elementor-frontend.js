class wpkitElementorHandler {
	constructor() {
		this.initSettings();
		this.initElements();
		this.boundEvents();
	}

	initSettings() {
		this.settings = {
			selectors: {
				menuToggle: '.site-header .site-navigation-toggle',
				menuToggleContainer: '.site-header .site-navigation-toggle-container',
				dropdownMenu: '.site-header .site-navigation-dropdown',
				searchFormToggle: '.site-header .header-search-toggle-container .search-form__toggle',
				searchFormToggleContainer: '.site-header .header-search-toggle-container',
				searchFormOverlay: '.search-overlay',
				searchFormClose: '.search-overlay .close-search',
			}
		}
	}

	initElements() {
		this.elements = {
			window,
			menuToggle: document.querySelector( this.settings.selectors.menuToggle ),
			menuToggleContainer: document.querySelector( this.settings.selectors.menuToggleContainer ),
			dropdownMenu: document.querySelector( this.settings.selectors.dropdownMenu ),
			searchFormToggle: document.querySelector( this.settings.selectors.searchFormToggle ),
			searchFormToggleContainer: document.querySelector( this.settings.selectors.searchFormToggleContainer ),
			searchFormOverlay: document.querySelector( this.settings.selectors.searchFormOverlay ),
			searchFormClose: document.querySelector( this.settings.selectors.searchFormClose ),
		}
	}

	boundEvents() {
		if ( this.elements.menuToggleContainer && ! this.elements.menuToggleContainer?.classList.contains( 'hide' ) ) {
			this.elements.menuToggle.addEventListener( 'click', () => this.menuToggleHandle() );
			this.elements.menuToggle.addEventListener( 'keyup', ( event ) => {
				const ENTER_KEY = 13;
				const SPACE_KEY = 32;
				const ESC_KEY = 27;

				if ( ENTER_KEY === event.keyCode || SPACE_KEY === event.keyCode || ESC_KEY === event.keyCode ) {
					event.currentTarget.click();
				}
			} );

			this.elements.dropdownMenu.querySelectorAll( '.menu-item-has-children > a' ).forEach( ( anchorEl ) => anchorEl.addEventListener( 'click', ( event ) => this.menuChildrenHandle( event ) ) );
		}

		// Search form events.
		if ( this.elements.searchFormToggleContainer && ! this.elements.searchFormToggleContainer.classList.contains( 'hide' ) ) {
			this.elements.searchFormToggle.addEventListener( 'click', this.searchFormOverlayHandle.bind( this ) );
			this.elements.searchFormClose.addEventListener( 'click', this.searchFormCloseHandle.bind( this ) );
		}

	}

	closeMenuItems() {
		this.elements.menuToggleContainer.classList.remove( 'is-active' );
		this.elements.window.removeEventListener( 'resize', () => this.closeMenuItems() );
	}

	menuToggleHandle() {
		const isDropdownVisible = ! this.elements.menuToggleContainer.classList.contains( 'is-active' );

		this.elements.menuToggle.setAttribute( 'aria-expanded', isDropdownVisible );
		this.elements.dropdownMenu.setAttribute( 'aria-hidden', ! isDropdownVisible );
		this.elements.menuToggleContainer.classList.toggle( 'is-active', isDropdownVisible );
		this.elements.menuToggle.classList.toggle( 'is-active', isDropdownVisible );

		// Always close all sub active items.
		this.elements.dropdownMenu.querySelectorAll( '.is-active' ).forEach( item => item.classList.remove( 'is-active' ) );

		if ( isDropdownVisible ) {
			this.elements.window.addEventListener( 'resize', () => this.closeMenuItems() );
		} else {
			this.elements.window.removeEventListener( 'resize', () => this.closeMenuItems() );
		}
	}

	menuChildrenHandle( event ) {
		const anchor = event.currentTarget;
		const parentLi = anchor.parentElement;

		if ( ! parentLi?.classList ) {
			return;
		}

		parentLi.classList.toggle( 'is-active' );
	}

	searchFormOverlayHandle() {
		const isOverlayVisible = ! this.elements.searchFormOverlay.classList.toggle( 'is-visible' );

		this.elements.searchFormToggle.setAttribute( 'aria-expanded', ! isOverlayVisible );
		this.elements.searchFormOverlay.classList.toggle( 'is-visible', ! isOverlayVisible );
		this.elements.searchFormOverlay.setAttribute( 'aria-hidden', isOverlayVisible );
	}

	searchFormCloseHandle() {
		const isOverlayVisible = ! this.elements.searchFormOverlay.classList.toggle( 'is-visible' );

		this.elements.searchFormToggle.setAttribute( 'aria-expanded', ! isOverlayVisible );
		this.elements.searchFormOverlay.classList.remove( 'is-visible', isOverlayVisible );
		this.elements.searchFormOverlay.setAttribute( 'aria-hidden', isOverlayVisible );
	}

}

document.addEventListener( 'DOMContentLoaded', () => {
	new wpkitElementorHandler();
} );
