# AK WP React Kit

A starter template to build React-powered WordPress plugins.

## STACK

- **MUI material**

- **Tanstack/react query**

- **@wordpress/api-fetch**

- **Typescript**

- **Production Build**

- **REST API Integration**

## GETTING STARTED

### 1. Installation

- Clone the repository to /wp-content/plugins/:

  ```sh
  git clone https://github.com/arukaraz/akz-wp-react-kit.git
  ```

  Or download and upload the plugin files to /wp-content/plugins/akz-wp-react-kit.

- Rename the folder name `akz-wp-react-kit` to your plugin folder.
- Install dependencies

 ```sh
  npm install
  ```


### 2. Renaming the Plugin

You must change the plugin folder and file names. Furthermore, adjust the constants, variables, classes, text domain, and functions inside the plugin to match your plugin’s name. For example, if your plugin is called `my-cool-plugin`, then:

#### i. Renaming using command

Go to the .bin directory within the plugin folder and open the initial-rename.js file. Apply the following modifications:

- `your-amazing-plugin-name`
- `your_amazing_plugin_name`
- `YOUR_AMAZING_PLUGIN_NAME`
- `YOUR-AMAZING-PLUGIN-NAME`
- `Your-Amazing-Plugin-Name`
- `Your_Amazing_Plugin_Name`
- `YourAmazingPluginName`

With:

- `my-cool-plugin`
- `my_cool_plugin`
- `MY_COOL_PLUGIN`
- `MY-COOL-PLUGIN`
- `My-Cool-Plugin`
- `My_Cool_Plugin`
- `MyCoolPlugin`


Now Run `npm run initial-rename`

#### ii. OR Manual rename

- Rename the folder from `your-amazing-plugin-name` to `my-cool-plugin`.
- Rename all files from `your-amazing-plugin-name` to `my-cool-plugin` (PHP, JS, and CSS).
- Change `your_amazing_plugin_name` to `my_cool_plugin`.
- Change `your-amazing-plugin-name` to `my-cool-plugin`.
- Change `Your_Amazing_Plugin_Name` to `My_Cool_Plugin`.
- Change `YOUR_AMAZING_PLUGIN_NAME` to `MY_COOL_PLUGIN`.

### 4. Activate the Plugin:

You can now safely enable the plugin. Turn it on from the Plugins section in the WordPress admin panel.

Navigate to the WordPress Dashboard => My Cool Plugin to see the default landing page and plugin settings.

### 5. You are set!

Now that this is your own plugin, feel free to customize it using your preferred code editor and thoroughly test everything. You have the flexibility to add, edit, remove, or update any files, folders, or code within the plugin. However, it’s crucial to understand the changes you are making. Follow these steps to start development:

1. Navigate to the plugin directory `/wp-content/plugins/my-cool-plugin`, and open a terminal app.
2. Run the `npm run start` command to initialize the React JS development server. This will automatically update the changes you made on the /src folder to the /build folder, where WP is taking the files from.
3. Run the `npm run deploy` command to create a ready-to-deploy folder. This folder contains all necessary files for deploying your plugin to a live WordPress site.


## License

- GPLv2 or later
