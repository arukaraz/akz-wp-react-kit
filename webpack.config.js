const defaultConfig = require('@wordpress/scripts/config/webpack.config.js');
const path = require('path');

module.exports = {
  ...defaultConfig,
  entry: {
    admin: path.resolve(__dirname, 'src/admin.tsx'),
    public: path.resolve(__dirname, 'src/public.ts'),
  },
  resolve: {
    ...defaultConfig.resolve,
    extensions: ['.ts', '.tsx', '.js', '.jsx', '.scss', '.mjs'],
  },
  module: {
    ...defaultConfig.module,
    rules: [
      ...defaultConfig.module.rules,
      {
        test: /\.js$/,
        include: /node_modules\/mui-color-input/,
        resolve: {
          fullySpecified: false,
        },
      },
    ],
  },
};
