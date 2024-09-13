( function( wp ) {
	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/#registering-a-block
	 */
	var registerBlockType = wp.blocks.registerBlockType;
	/**
	 * Returns a new element of given type. Element is an abstraction layer atop React.
	 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/packages/packages-element/
	 */
	var el = wp.element.createElement;

	/**
	 * Retrieves the translation of text.
	 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/packages/packages-i18n/
	 */
	var __ = wp.i18n.__;

	const { isUndefined, pick, first } = window._
	const { RichText, InspectorControls, MediaUpload, MediaUploadCheck, MediaPlaceholder, InnerBlocks, FontSizePicker  } = wp.blockEditor;
	const { Fragment } = wp.element;
	const withSelect = wp.data.withSelect;

	const {
		TextControl,
		CheckboxControl,
		RadioControl,
		SelectControl,
		TextareaControl,
		ToggleControl,
		RangeControl,
		Panel,
		PanelBody,
		PanelRow,
		PanelHeader,
		FormFileUpload,
		Button,
		ColorPicker,
		DropdownMenu
	} = wp.components;
	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/#registering-a-block
	 */
	registerBlockType( 'lifeline-donation/campaigns', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'Donation Campaigns', 'lifeline-donation' ),
		description: __( 'Campaigns style 1: you can show donation button by displaying different content and banners to attract donors', 'lifeline-donation' ),
 		keywords: [__('Donation', 'lifeline-donation'), __('Lifeline', 'lifeline-donation'), __('Charity', 'lifeline-donation'), __('Non Profit', 'lifeline-donation')],
		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'lifeline-donation',

		/**
		 * Optional block extended support features.
		 */
		supports: {
			// Removes support for an HTML mode.
			html: false,
		},

		attributes: {
			source: {
				type: 'string'
			},
			number: {
				type: 'number'
			},
			order: {
				type: 'string',
			},
			orderBy: {
				type: 'string'
			},
			featured_media: {
				type: 'number'
			}
		},

		/**
		 * The edit function describes the structure of your block in the context of the editor.
		 * This represents what the editor will render when the block is used.
		 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-edit-save/#edit
		 *
		 * @param {Object} [props] Properties passed from the editor.
		 * @return {Element}       Element to render.
		 */
		edit: withSelect(function(select, props){
			const { number, order, orderBy, featured_media } = props.attributes;
			let source = (props.attributes.source) ? props.attributes.source : 'cause';
			const latestPostsQuery = pick( {
				order,
				orderby: orderBy,
				per_page: (number) ? number : 2,
				context: 'embed',
			}, ( value ) => ! isUndefined( value ) );
			return {
                posts: select( 'core' ).getEntityRecords( 'postType', source, latestPostsQuery ),
                media: select( 'core' ).getEntityRecords( 'postType', 'attachment', {per_page: 1, include: (featured_media) ? featured_media : 0} )
            };
		}) (function( props ) {

			const {
        		attributes: {
        			source,
        			number,
        		},
        		posts,
        		media
        	} = props;

        	if(posts) {
        		props.setAttributes({featured_media: posts[0].featured_media})
        	}

        	let popup_style = wpcm_data.settings.donation_popup_style;

			return [
					el(
						Fragment,{},
						el( 
							InspectorControls, {},
							el( 
								PanelBody, { title: 'Block Settings', initialOpen: true },
								el( 
									PanelRow, {},
									el( 
										SelectControl,
										{
											label: __('Choose Source', 'lifeline-donation'),
											options: [
												{value:'cause', label: __('Causes', 'lifeline-donation')},
												{value: 'project', label: __('Projects', 'lifeline-donation')}
											],
											onChange: ( value ) => {
												props.setAttributes( { source: value } );
											},
											value: props.attributes.source
										}
									)
								),
								el( 
									PanelRow, {},
									el( 
										RangeControl,
										{
											label: __('Number of Posts', 'lifeline-donation'),
											min: 2,
											max: 10,
											onChange: ( value ) => {
												props.setAttributes( { number: value } );
											},
											value: props.attributes.number
										}
									)
								),
								el( 
									PanelRow, {},
									el( 
										SelectControl,
										{
											label: __('Order', 'lifeline-donation'),
											options: [
												{value: 'desc', label: __('DESC', 'lifeline-donation')},
												{value: 'asc', label: __('ASC', 'lifeline-donation')},
											],
											onChange: ( value ) => {
												props.setAttributes( { order: value } );
											},
											value: props.attributes.order
										}
									)
								),
								el( 
									PanelRow, {},
									el( 
										SelectControl,
										{
											label: __('Order By', 'lifeline-donation'),
											options: [
												{value: 'date', label: __('Date', 'lifeline-donation')},
												{value: 'title', label: __('Title', 'lifeline-donation')},
												{value: 'author', label: __('Author', 'lifeline-donation')},
											],
											onChange: ( value ) => {
												props.setAttributes( { orderBy: value } );
											},
											value: props.attributes.orderBy
										}
									)
								)
							)
						)
					),
					el(
						'section',
						{className: 'wpcm-wrapper urgent-popup-list wp-block-lifeline-donation-campaigns'},
						(posts) ? el('div', {className: 'wpcm-cause-listng'},
							el(
								'div', {className: 'wpcm-row align-items-center'},
								el(
									'div', {className: 'wpcm-col-md-6'},
									el(
										'div', {className: 'wpcm-cause-lstng-img'},
										( media != null && media[0] != undefined && media[0].source_url ) ? el(
											'figure', {},
											el(
												'img', {src: (media) ? media[0].source_url : ''}
											)
										) : '',
										el('div', {className: 'lifeline-donation-app'},
											el('lifeline-donation-button', {':id': posts.id, dstyle: popup_style},
												el('a', 
													{ href: '#', className: 'wpcm-btn wpcm-btn-icon wpcm-btn-green2'},
													el('i', {
														className: 'flaticon-hand'
													}),
													__('Donate Now', 'lifeline-donation')
												)
											)
										)
									)
								),
								el(
									'div', {className: 'wpcm-col-md-6'},
									el(
										'div', {className: 'wpcm-cause-lsting-contnt'},
										el(
											'a', {className: 'wpcm-cause-cat', href:'#'}, __('Water')
										),
										el(
											'h2', {},
											el('a', {href: '#'}), first(posts).title.rendered
										),
										el('p', {}, 'Lorem ipsum dolor sit amet, consec tur adipiscing elit. Vivamus in magnac tellus fringilla eleifend.'),
										el(
											'span', {},
											__('Raised', 'lifeline-donation'),
											el('strong', {}, '$19000')
										),
										el(
											'div', {className: 'progress'},
											el(
												'div', 
												{
													className: 'progress-bar',
													style: {
														width: '50%'
													}
												},
												el('span', {}, '50%')
											)
										)
									)
								)
							)
						) : ''
					)
				];
		}),

		/**
		 * The save function defines the way in which the different attributes should be combined
		 * into the final markup, which is then serialized by Gutenberg into `post_content`.
		 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-edit-save/#save
		 *
		 * @return {Element}       Element to render.
		 */
		save: function(props) {
			return null;
		}
	} );
} )(
	window.wp
);
