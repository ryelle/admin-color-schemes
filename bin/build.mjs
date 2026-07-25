import fs from 'node:fs';
import fsp from 'node:fs/promises';
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
const watchMode = process.argv.includes( '--watch' );

async function fetchFromSvn( { svnUrl, destDir } ) {
	await fsp.mkdir( path.dirname( destDir ), { recursive: true } );
	// export gives you a clean directory without .svn metadata
	await execa`svn export --force --depth=files ${ svnUrl } ${ destDir }`;
}

async function buildTheme( inFile ) {
	const rel = path.relative( srcDir, inFile );
	const outFile = path.join(
		distDir,
		rel.replace( /\.(scss|sass)$/, '.css' )
	);
	const folder = path.join( srcDir, path.dirname( rel ) );

	const cssContent = await fsp.readFile( inFile, { encoding: 'utf8' } );
	const globalContent = await fsp.readFile(
		path.join( srcDir, '_back-compat.scss' ),
		{ encoding: 'utf8' }
	);
	const sassResult = await sass.compileStringAsync(
		`${ cssContent }\n\n${ globalContent }\n`,
		{
			style: 'compressed',
			sourceMap: false,
			loadPaths: [ vendorDir, folder ],
		}
	);

	const postcssResult = await postcss( [
		autoprefixer,
		// @todo rtlcss
	] ).process( sassResult.css, {
		from: inFile,
		to: outFile,
		map: false,
	} );

	await fsp.mkdir( path.dirname( outFile ), { recursive: true } );
	await fsp.writeFile( outFile, postcssResult.css, 'utf8' );
}

async function getEntrypoints() {
	const entries = await fg( [ '**/*.{scss,sass}' ], {
		cwd: srcDir,
		absolute: true,
	} );

	return entries.filter(
		( entry ) => ! path.basename( entry ).startsWith( '_' )
	);
}

async function buildAllThemes() {
	const entrypoints = await getEntrypoints();
	await Promise.all( entrypoints.map( buildTheme ) );
}

function watchThemes() {
	let buildTimer;
	let isBuilding = false;
	let needsRebuild = false;

	const rebuild = async () => {
		if ( isBuilding ) {
			needsRebuild = true;
			return;
		}

		isBuilding = true;

		try {
			await buildAllThemes();
			console.log( 'Styles rebuilt.' );
		} catch ( error ) {
			console.error( error );
		} finally {
			isBuilding = false;

			if ( needsRebuild ) {
				needsRebuild = false;
				void rebuild();
			}
		}
	};

	const scheduleRebuild = ( eventType, filename ) => {
		if ( ! filename || ! /\.(scss|sass)$/.test( filename ) ) {
			return;
		}

		clearTimeout( buildTimer );
		buildTimer = setTimeout( () => {
			console.log( `Detected ${ eventType } in ${ filename }.` );
			void rebuild();
		}, 100 );
	};

	fs.watch( srcDir, { recursive: true }, scheduleRebuild );
	console.log( 'Watching src for style changes...' );
}

async function main() {
	await fsp.mkdir( distDir, { recursive: true } );
	await fsp.mkdir( vendorDir, { recursive: true } );

	await fetchFromSvn( {
		svnUrl: 'https://develop.svn.wordpress.org/trunk/src/wp-admin/css/colors/',
		destDir: path.join( vendorDir ),
	} );

	await buildAllThemes();

	if ( watchMode ) {
		watchThemes();
	}
}

main().catch( ( err ) => {
	console.error( err );
	process.exit( 1 );
} );
