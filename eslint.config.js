const eslintPluginTypescript = require('@typescript-eslint/eslint-plugin');
const react = require('eslint-plugin-react');

module.exports = [
  {
    files: ['*.js', '*.jsx', '*.ts', '*.tsx'],

    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
      globals: {
        Atomics: 'readonly',
        SharedArrayBuffer: 'readonly',
      },
      parser: '@typescript-eslint/parser',
      parserOptions: {
        jsx: true, 
      },
    },

    plugins: {
      react,
      '@typescript-eslint': eslintPluginTypescript,
    },

    rules: {
      'no-unused-vars': 'warn',
      'no-console': 'off',
      'no-undef': 'error',
      'semi': ['error', 'always'],
      'quotes': ['error', 'single'],
      'react/react-in-jsx-scope': 'off',
      '@typescript-eslint/no-unused-vars': 'error',
      '@typescript-eslint/explicit-module-boundary-types': 'off',
    },
  },
  {
    files: ['*.jsx', '*.tsx'],

    settings: {
      react: {
        version: 'detect',
      },
    },
  },
];
