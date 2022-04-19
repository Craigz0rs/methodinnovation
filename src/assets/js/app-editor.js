wp.domReady( function() {
  
	wp.blocks.unregisterBlockStyle(
		'core/button',
		[ 'default', 'outline', 'squared', 'fill' ]
	);

	wp.blocks.registerBlockStyle(
		'core/button',
		[
			{
				name: 'default',
				label: 'Default',
				isDefault: true
			}
		]
	);

	wp.blocks.registerBlockStyle(
		'core/group',
		[
			{
				name: 'default',
				label: 'Default',
				isDefault: true,
			},
			{
				name: 'testimonial',
				lable: 'Testimonial'
			}
		]
	);

	wp.blocks.registerBlockStyle(
		'core/cover',
		[
			{
				name: 'default',
				label: 'Default',
				isDefault: true,
			},
			{
				name: 'hero',
				label: 'Page Hero'
			}
		]
	);

	wp.blocks.registerBlockStyle(
		'core/media-text',
		[
			{
				name: 'default',
				label: 'Default',
				isDefault: true,
			},
			{
				name: 'logo-overlay',
				label: 'Logo Overlay'
			},
			{
				name: 'contact',
				label: 'Contact'
			}
		]
	);
  
} );
  
wp.hooks.addFilter(
  'blocks.registerBlockType',
  'epiqk/alter-core-blocks',
  function( settings ) {
    
    if ( settings.name === 'core/button' ) {
      // console.dir( settings );
    }
    
    return settings;
    
  }
);