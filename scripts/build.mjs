import fs from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

import autoprefixer from 'autoprefixer';
import { execa } from 'execa';
import fg from 'fast-glob';
import postcss from 'postcss';
import * as sass from 'sass';

const __filename = fileURLToPath( import.meta.url );
const __dirname = path.dirname( __filename );

const root = path.resolve( __dirname, '..' );
const srcDir = path.join( root, 'src' );
const distDir = path.join( root, 'dist' );
const vendorDir = path.join( root, 'vendor' );

async function fetchFromSvn( { svnUrl, destDir } ) {
	await fs.mkdir( path.dirname( destDir ), { recursive: true } );
	// export gives you a clean directory without .svn metadata
	await execa`svn export --force --depth=files ${ svnUrl } ${ destDir }`;
}

async function buildTheme( inFile ) {
	const rel = path.relative( srcDir, inFile );
	const outFile = path.join(
		distDir,
		rel.replace( /\.(scss|sass)$/, '.css' )
	);

	const sassResult = sass.compile( inFile, {
		style: 'compressed',
		sourceMap: false,
		loadPaths: [ vendorDir ],
	} );

	const postcssResult = await postcss( [
		autoprefixer,
		// @todo rtlcss
	] ).process( sassResult.css, {
		from: inFile,
		to: outFile,
		map: false,
	} );

	await fs.mkdir( path.dirname( outFile ), { recursive: true } );
	await fs.writeFile( outFile, postcssResult.css, 'utf8' );
}

async function main() {
	await fs.mkdir( distDir, { recursive: true } );
	await fs.mkdir( vendorDir, { recursive: true } );

	await fetchFromSvn( {
		svnUrl: 'https://develop.svn.wordpress.org/trunk/src/wp-admin/css/colors/',
		destDir: path.join( vendorDir ),
	} );

	// Find all entrypoints; skip partials like _tokens.scss
	const entries = await fg( [ '**/*.{scss,sass}' ], {
		cwd: srcDir,
		absolute: true,
	} );
	const entrypoints = entries.filter(
		( p ) => ! path.basename( p ).startsWith( '_' )
	);

	await Promise.all( entrypoints.map( buildTheme ) );
}

main().catch( ( err ) => {
	console.error( err );
	process.exit( 1 );
} );
