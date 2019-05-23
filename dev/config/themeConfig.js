'use strict';

module.exports = {
	theme: {
		slug: 'lsx_blocks_theme',
		name: 'LSX Blocks Theme',
		author: 'lightspeed'
	},
	dev: {
		browserSync: {
			live: true,
			proxyURL: 'lsx-blocks-theme.test:8888',
			bypassPort: '8181'
		},
		browserslist: [ // See https://github.com/browserslist/browserslist
			'> 1%',
			'last 2 versions'
		],
		debug: {
			styles: false, // Render verbose CSS for debugging.
			scripts: false // Render verbose JS for debugging.
		}
	},
	export: {
		compress: true
	}
};
