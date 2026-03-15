const replace = require('replace-in-file');
const glob = require('glob');
const path = require('path');
const fs = require('fs');
const { promisify } = require('util');
const renameAsync = promisify(fs.rename);

const filePath = path.join(process.cwd(), '**/*.{js,php,ts,tsx,scss,json,yml}');

const files = glob.sync(filePath, {
    ignore: ['**/node_modules/**', '**/build/**'],
});

const options = {
    files: files,
    from: [
        /akz-wp-react-kit/g,
        /akz_wp_react_kit/g,
        /AKZ_WP_REACT_KIT/g,
        /AKZ-WP-REACT-KIT/g,
        /Akz-Wp-React-Kit/g,
        /Akz_Wp_React_Kit/g,
        /AkzWpReactKit/g,
        /\.akzwprk/g,
    ],
    to: [
        'your-amazing-plugin-name',/******************** replace with your plugin details */
        'your_amazing_plugin_name',
        'YOUR_AMAZING_PLUGIN_NAME',
        'YOUR-AMAZING-PLUGIN-NAME',
        'Your-Amazing-Plugin-Name',
        'Your_Amazing_Plugin_Name',
        'YourAmazingPluginName',
        '.yourprefix',/******************** replace with your CSS prefix */
    ],
    verbose: true,
    dry: false,
};

const renamedResults = [];
async function renamePHPFiles() {
    const renamePromises = files
        .filter((file) => file.endsWith('.php'))
        .filter((file) => /akz-wp-react-kit/.test(file))
        .map(async (file) => {
            const dir = path.dirname(file);
            const baseName = path.basename(file);
            const newBaseName = baseName.replace(
                /akz-wp-react-kit/gi,
                'your-amazing-plugin-name'/******************** replace with your plugin details */
            );
            const newFileName = path.join(dir, newBaseName);

            try {
                const baseNameOriginalFile = path.basename(file);
                const baseNameNewFile = path.basename(newFileName);
                if (baseNameOriginalFile !== baseNameNewFile) {
                    await renameAsync(file, newFileName);
                    renamedResults.push({
                        from: file,
                        to: newFileName,
                    });
                }
            } catch (error) {
                console.error(`Error renaming ${file}:`, error);
            }
        });

    await Promise.all(renamePromises);
}

async function main() {
    try {
        const results = await replace(options);
        console.log('Replacement results:', results);
        await renamePHPFiles();
        console.log('');
        console.log('File renamed results:', renamedResults);

    } catch (error) {
        console.error('Error occurred:', error);
    }
}

main();
