import { addFilter } from '@wordpress/hooks';

type AdminThemeColors = {
	primary: string;
	background: string;
};

const ADMIN_THEME_COLORS = new Map< string, AdminThemeColors >( [
	[ '80s-kid', { primary: '#d13674', background: '#1b4a8c' } ],
	[ 'adderley', { primary: '#1730e5', background: '#216bce' } ],
	[ 'aubergine', { primary: '#ba5b32', background: '#4a437c' } ],
	[ 'contrast-blue', { primary: '#22466d', background: '#c5e2f5' } ],
	[ 'cruise', { primary: '#348259', background: '#36395c' } ],
	[ 'flat', { primary: '#11919e', background: '#2c3e50' } ],
	[ 'kirk', { primary: '#8b2238', background: '#5f1b29' } ],
	[ 'lawn', { primary: '#636a00', background: '#1e2a29' } ],
	[ 'modern-aubergine', { primary: '#6e5ec9', background: '#6e5ec9' } ],
	[ 'modern-evergreen', { primary: '#1e8060', background: '#1e8060' } ],
	[ 'primary', { primary: '#bf4500', background: '#35395c' } ],
	[ 'seashore', { primary: '#456a7f', background: '#f3eee5' } ],
	[ 'vinyard', { primary: '#934f69', background: '#462b36' } ],
] );

addFilter(
	'adminThemeColors',
	'ryelle/admin-color-schemes',
	( colors: AdminThemeColors, scheme: string ) => {
		return ADMIN_THEME_COLORS.get( scheme ) ?? colors;
	}
);
